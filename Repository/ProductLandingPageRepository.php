<?php
declare(strict_types=1);

namespace Lemundo\ProductLandingPage\Repository;

use Lemundo\ProductLandingPage\Api\ProductLandingPageRepositoryInterface;
use Lemundo\ProductLandingPage\Api\ProductDetailBySkuServiceInterface;
use Lemundo\ProductLandingPage\Api\ProductsByCategoryIdServiceInterface;
use Lemundo\ProductLandingPage\Api\ProductsByUrlPathServiceInterface;
use Lemundo\ProductLandingPage\Api\ProductsServiceInterface;
use Lemundo\ProductLandingPage\Config\DefaultConfig;
use Magento\Catalog\Model\Product;
use Magento\Framework\Pricing\PriceCurrencyInterface;
use Magento\Tax\Api\TaxCalculationInterface;

class ProductLandingPageRepository implements ProductLandingPageRepositoryInterface
{
    private ProductDetailBySkuServiceInterface $productDetailBySkuService;

    private ProductsByCategoryIdServiceInterface $productsListingByCategoryIdService;

    private ProductsByUrlPathServiceInterface $productsListingByUrlPathService;

    private ProductsServiceInterface $productsListingService;

    private TaxCalculationInterface $taxCalculation;

    private PriceCurrencyInterface $priceCurrency;

    private DefaultConfig $config;

    private \Magento\Catalog\Api\Data\ProductSearchResultsInterfaceFactory $searchResultsFactory;

    private bool $isPriceCalculationWithTax;

    public function __construct(
        ProductDetailBySkuServiceInterface $productDetailBySkuService,
        ProductsByCategoryIdServiceInterface $productsListingByCategoryIdService,
        ProductsByUrlPathServiceInterface $productsListingByUrlPathService,
        ProductsServiceInterface $productsListingService,
        TaxCalculationInterface $taxCalculation,
        PriceCurrencyInterface $priceCurrency,
        DefaultConfig $config,
        \Magento\Catalog\Api\Data\ProductSearchResultsInterfaceFactory $searchResultsFactory
    ) {
        $this->productDetailBySkuService = $productDetailBySkuService;
        $this->productsListingByCategoryIdService = $productsListingByCategoryIdService;
        $this->productsListingByUrlPathService = $productsListingByUrlPathService;
        $this->productsListingService = $productsListingService;
        $this->taxCalculation = $taxCalculation;
        $this->priceCurrency = $priceCurrency;
        $this->config = $config;
        $this->searchResultsFactory = $searchResultsFactory;

        $this->init();
    }

    public function getProductDetailBySku(string $sku, ?int $storeId = null)
    : \Magento\Catalog\Api\Data\ProductSearchResultsInterface {

        $result = $this->addAdditionalData(
            $this->productDetailBySkuService->execute($sku, $storeId)
        );

        return $this->convertResultToSearchResult($result);
    }

    public function getProductsByCategoryId(
        int $categoryId,
        ?int $storeId = null,
        ?string $sortField = null,
        ?string $sortOrder = null,
        ?int $pageSize = null,
        ?int $currentPage = null
    ): \Magento\Catalog\Api\Data\ProductSearchResultsInterface {

        $result = $this->addAdditionalData(
            $this->productsListingByCategoryIdService->execute(
                $categoryId,
                $storeId,
                $sortField,
                $sortOrder,
                $pageSize,
                $currentPage
            )
        );

        return $this->convertResultToSearchResult($result);
    }

    public function getProductsByUrlPath(
        string $urlPath,
        ?int $storeId = null,
        ?string $sortField = null,
        ?string $sortOrder = null,
        ?int $pageSize = null,
        ?int $currentPage = null
    ): \Magento\Catalog\Api\Data\ProductSearchResultsInterface {

        $result = $this->addAdditionalData(
            $this->productsListingByUrlPathService->execute(
                $urlPath,
                $storeId,
                $sortField,
                $sortOrder,
                $pageSize,
                $currentPage
            )
        );

        return $this->convertResultToSearchResult($result);
    }

    public function getProducts(
        ?int $storeId = null,
        ?string $sortField = null,
        ?string $sortOrder = null,
        ?int $pageSize = null,
        ?int $currentPage = null
    ): \Magento\Catalog\Api\Data\ProductSearchResultsInterface {

        $result = $this->addAdditionalData(
            $this->productsListingService->execute($storeId, $sortField, $sortOrder, $pageSize, $currentPage)
        );

        return $this->convertResultToSearchResult($result);
    }

    private function addAdditionalData(array $items): array
    {
        /**
         * @var int $index
         * @var Product $product
         */
        foreach ($items as $index => $product) {

            $this->addTaxData($product);
            $this->addUrlPath($product);

            $items[$index] = $product;
        }
        return $items;
    }

    private function addTaxData(Product $product): void
    {
        $rate = $this->taxCalculation->getCalculatedRate($product->getData('tax_class_id'));
        $priceExcludingTax = $this->isPriceCalculationWithTax ?
            $product->getPrice() / (1 + ($rate / 100))
            : $product->getPrice();

        $product->setData('price_excl_tax', $this->priceCurrency->roundPrice($priceExcludingTax));
    }

    private function addUrlPath(Product $product): void
    {
        $product->setData('url_path', $product->getUrlModel()->getUrl($product));
    }

    private function convertResultToSearchResult(array $items): \Magento\Catalog\Api\Data\ProductSearchResultsInterface
    {
        $searchResult = $this->searchResultsFactory->create();
        $searchResult->setItems($items);
        $searchResult->setTotalCount(count($items));

        return $searchResult;
    }

    private function init(): void
    {
        $this->isPriceCalculationWithTax = $this->config->isPriceCalculationWithTax();
    }
}
