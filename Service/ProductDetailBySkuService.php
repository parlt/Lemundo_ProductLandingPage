<?php
declare(strict_types=1);

namespace Lemundo\ProductLandingPage\Service;

use Lemundo\ProductLandingPage\Api\GetProductCollectionServiceInterface;
use Lemundo\ProductLandingPage\Api\ProductDetailBySkuServiceInterface;

class ProductDetailBySkuService implements ProductDetailBySkuServiceInterface
{
    private GetProductCollectionServiceInterface $getProductCollectionService;

    public function __construct(GetProductCollectionServiceInterface $getProductCollectionService)
    {
        $this->getProductCollectionService = $getProductCollectionService;
    }

    public function execute(string $sku, ?int $storeId = null): array
    {

        $productCollection = $this->getProductCollectionService->execute($storeId);
        $productCollection->addFieldToFilter('sku', $sku);
        $productCollection->addMediaGalleryData();

        return $productCollection->getItems();
    }

}
