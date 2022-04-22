<?php
declare(strict_types=1);

namespace Lemundo\ProductLandingPage\Api;

use Magento\Framework\Exception\LocalizedException;

interface ProductsServiceInterface
{
    /**
     * @throws LocalizedException
     */
    public function execute(
        ?int $storeId = null,
        ?string $sortField = null,
        ?string $sortOrder = null,
        ?int $pageSize = null,
        ?int $currentPage = null
    ): array;
}
