<?php
declare(strict_types=1);

namespace Lemundo\ProductLandingPage\Service;

use Lemundo\ProductLandingPage\Api\GetProductCollectionServiceInterface;
use Lemundo\ProductLandingPage\Config\DefaultConfig;
use Magento\Catalog\Model\Product\Attribute\Source\Status;
use Magento\Catalog\Model\ResourceModel\Product\Collection as ProductCollection;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory as ProductCollectionFactory;
use Psr\Log\LoggerInterface;

class GetProductCollectionService implements GetProductCollectionServiceInterface
{
    private ProductCollectionFactory $productCollectionFactory;

    private DefaultConfig $config;

    private LoggerInterface $logger;

    public function __construct(
        ProductCollectionFactory $productCollectionFactory,
        DefaultConfig $config,
        LoggerInterface $logger
    ) {
        $this->productCollectionFactory = $productCollectionFactory;
        $this->config = $config;
        $this->logger = $logger;
    }

    public function execute(
        ?int $storeId = null,
        ?string $sortField = null,
        ?string $sortOrder = null,
        ?int $pageSize = null,
        ?int $currentPage = null
    ): ProductCollection {

        $productCollection = $this->productCollectionFactory->create();

        $this->addFieldsToSelect($productCollection);

        try {

            $this->addStoreFilter($storeId, $productCollection);
            $this->addActiveProductsFilter($productCollection);
            $this->addInStockFilter($productCollection);
            $this->addIsLandingPageRelevantFilter($productCollection);

            $this->addSortOrder($productCollection, $sortField, $sortOrder);
            $this->addLimitAndPagination($productCollection, $pageSize, $currentPage);

            $productCollection->addPriceData();
            $productCollection->addFinalPrice();
            $productCollection->addTaxPercents();

        } catch (\Exception $e) {
            $this->logger->critical($e->getMessage());
        }

        return $productCollection;
    }

    private function addLimitAndPagination(
        ProductCollection $productCollection,
        ?int $pageSize,
        ?int $currentPage
    ): void {

        if ($pageSize === null) {
            $pageSize = $this->config->getDefaultPageSize();
        }

        $productCollection->setPageSize($pageSize);
        $productCollection->setCurPage($currentPage ?? 0);
    }

    private function addSortOrder(
        ProductCollection $productCollection,
        ?string $sortField = null,
        ?string $sortOrder = null
    ): void {

        if ($sortField === null) {
            $sortField = $this->config->getDefaultSortField();
        }

        if ($sortOrder === null) {
            $sortOrder = $this->config->getDefaultSortOrder();
        }

        $productCollection->addOrder($sortField, $sortOrder);
    }

    private function addFieldsToSelect(ProductCollection $productCollection): void
    {
        $productCollection->addFieldToSelect('name');
        $productCollection->addFieldToSelect('description');
        $productCollection->addFieldToSelect('lemundo_legacy_product_id');
        $productCollection->addFieldToSelect('lemundo_product_features');
        $productCollection->addFieldToSelect('lemundo_product_application');

        $productCollection->addAttributeToSelect('image');
        $productCollection->addAttributeToSelect('base_image');
        $productCollection->addAttributeToSelect('small_image');
        $productCollection->addAttributeToSelect('thumbnail');

        $productCollection->addAttributeToSelect('price');
        $productCollection->addAttributeToSelect('final_price');
        $productCollection->addAttributeToSelect('tax_class_id');
        $productCollection->addAttributeToSelect('url_key');
    }

    private function addStoreFilter(?int $storeId, ProductCollection $productCollection): void
    {
        if (!$storeId !== null) {
            $productCollection->addStoreFilter($storeId);
        }
    }

    private function addActiveProductsFilter(ProductCollection $productCollection): void
    {
        $productCollection->addAttributeToFilter('status', Status::STATUS_ENABLED);
    }

    private function addInStockFilter(ProductCollection $productCollection): void
    {
        $productCollection->setFlag('require_stock_items', true);
        $productCollection->joinField(
            'qty',
            'cataloginventory_stock_item',
            'qty',
            'product_id=entity_id',
            '{{table}}.stock_id=1',
            'left'
        );
    }

    private function addIsLandingPageRelevantFilter(ProductCollection $productCollection): void
    {
        $productCollection->addAttributeToFilter('lemundo_landingpage_relevant', '1');
    }
}
