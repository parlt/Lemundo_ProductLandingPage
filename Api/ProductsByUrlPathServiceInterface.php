<?php
declare(strict_types=1);

namespace Lemundo\ProductLandingPage\Api;

use Magento\Framework\Exception\LocalizedException;

interface ProductsByUrlPathServiceInterface
{
    /**
     * @throws LocalizedException
     */
    public function execute(
        string $urlPath,
        ?int $storeId = null,
        ?string $sortField = null,
        ?string $sortOrder = null,
        ?int $pageSize = null,
        ?int $currentPage = null
    ): array;
}
