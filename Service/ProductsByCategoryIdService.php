<?php
declare(strict_types=1);

namespace Lemundo\ProductLandingPage\Service;

use Lemundo\ProductLandingPage\Api\GetProductCollectionServiceInterface;
use Lemundo\ProductLandingPage\Api\ProductsByCategoryIdServiceInterface;
use Magento\Framework\Exception\LocalizedException;
use Psr\Log\LoggerInterface;

class ProductsByCategoryIdService implements ProductsByCategoryIdServiceInterface
{
    private GetProductCollectionServiceInterface $getProductCollectionService;

    public function __construct(
        GetProductCollectionServiceInterface $getProductCollectionService,
        LoggerInterface $logger
    ) {
        $this->getProductCollectionService = $getProductCollectionService;
        $this->logger = $logger;
    }

    public function execute(
        int $categoryId,
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

        $productCollection->addCategoriesFilter(['in' => $categoryId]);
        $productCollection->addMediaGalleryData();

        return $productCollection->getItems();
    }

}
