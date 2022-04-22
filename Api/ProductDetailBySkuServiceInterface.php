<?php
declare(strict_types=1);

namespace Lemundo\ProductLandingPage\Api;

use Magento\Framework\Exception\LocalizedException;

interface ProductDetailBySkuServiceInterface
{
    /**
     * @throws LocalizedException
     */
    public function execute(string $sku, ?int $storeId = null): array;
}
