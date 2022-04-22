<?php
declare(strict_types=1);

namespace Lemundo\ProductLandingPage\Api;

use Magento\Catalog\Model\ResourceModel\Product\Collection as ProductCollection;

interface GetProductCollectionServiceInterface
{
    public function execute(
        ?int $storeId = null,
        ?string $sortField = null,
        ?string $sortOrder = null,
        ?int $pageSize = null,
        ?int $currentPage = null
    ): ProductCollection;
}
