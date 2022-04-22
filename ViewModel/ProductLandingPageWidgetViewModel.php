<?php
declare(strict_types=1);

namespace Lemundo\ProductLandingPage\ViewModel;

use Lemundo\ProductLandingPage\Api\ProductLandingPageRepositoryInterface;
use Magento\Framework\Data\Helper\PostHelper;
use Magento\Framework\Escaper;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Catalog\Helper\Image as ImageHelper;
use Magento\Catalog\Model\Product;
use Magento\Checkout\Helper\Cart as CartHelper;

class ProductLandingPageWidgetViewModel implements ArgumentInterface
{
    private ProductLandingPageRepositoryInterface $productLandingPageRepository;

    private array $products = [];

    private CartHelper $cartHelper;

    private PostHelper $postHelper;

    public function __construct(
        ProductLandingPageRepositoryInterface $productLandingPageRepository,
        CartHelper $cartHelper,
        PostHelper $postHelper,
        Escaper $escaper
    ) {

        $this->productLandingPageRepository = $productLandingPageRepository;
        $this->cartHelper = $cartHelper;
        $this->postHelper = $postHelper;
        $this->escaper = $escaper;
    }

    public function getProductList(): array
    {
        if (empty($this->products)) {
            $this->products = $this->extractSearchResult($this->productLandingPageRepository->getProducts());
        }
        return $this->products;
    }

    public function getMaxProducts(): int
    {
        return \count($this->getProductList());
    }

    public function getEscaper(): Escaper
    {
        return $this->escaper;
    }

    public function getProductUrl(Product $product): string
    {
        return $product->getProductUrl();
    }

    public function getProductImageUrl(Product $product): string
    {
        return $product->getMediaGalleryImages()->getFirstItem()->getData('url');
    }

    public function getPreparedPostData(Product $product): string
    {
        return $this->postHelper->getPostData(
            $this->cartHelper->getAddUrl($product),
            ['product' => $product->getId()]
        );
    }

    private function extractSearchResult(
        \Magento\Catalog\Api\Data\ProductSearchResultsInterface $productSearchResults
    ): array {

        return $productSearchResults->getItems();
    }
}
