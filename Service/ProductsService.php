<?php
declare(strict_types=1);

namespace Lemundo\ProductLandingPage\Service;

use Lemundo\ProductLandingPage\Api\GetProductCollectionServiceInterface;
use Lemundo\ProductLandingPage\Api\ProductsServiceInterface;
use Magento\Framework\Exception\LocalizedException;

class ProductsService implements ProductsServiceInterface
{
    private GetProductCollectionServiceInterface $getProductCollectionService;

    public function __construct(GetProductCollectionServiceInterface $getProductCollectionService)
    {
        $this->getProductCollectionService = $getProductCollectionService;
    }

    public function execute(
        ?int $storeId = null,
        ?string $sortField = null,
        ?string $sortOrder = null,
        ?int $pageSize = null,
        ?int $currentPage = null
    ): array {

        $productCollection = $this->getProductCollectionService->execute(
            $storeId,
            $sortField,
            $sortOrder,
            $pageSize,
            $currentPage
        );

        $productCollection->addMediaGalleryData();
        return $productCollection->getItems();
    }
}
