<?php
declare(strict_types=1);

namespace Lemundo\ProductLandingPage\Api;

use Magento\Framework\Exception\LocalizedException;

interface ProductsByCategoryIdServiceInterface
{
    /**
     * @throws LocalizedException
     */
    public function execute(
        int $categoryId,
        ?int $storeId = null,
        ?string $sortField = null,
        ?string $sortOrder = null,
        ?int $pageSize = null,
        ?int $currentPage = null
    ): array;
}
