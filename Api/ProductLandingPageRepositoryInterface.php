<?php
declare(strict_types=1);

namespace Lemundo\ProductLandingPage\Api;

use Magento\Framework\Exception\LocalizedException;

/**
 * A service to get landing page products.
 *
 * @api
 */
interface ProductLandingPageRepositoryInterface
{
    /**
     * Get details of landing page products by sku.
     *
     * @param string $sku
     * @param int|null $storeId
     * @return \Magento\Catalog\Api\Data\ProductSearchResultsInterface
     * @throws LocalizedException
     */
    public function getProductDetailBySku(string $sku, ?int $storeId = null)
    : \Magento\Catalog\Api\Data\ProductSearchResultsInterface;

    /**
     * Get a list of landing page products by category id.
     *
     * @param int $categoryId
     * @param int|null $storeId
     * @param string|null $sortField
     * @param string|null $sortOrder
     * @param int|null $pageSize
     * @param int|null $currentPage
     * @return \Magento\Catalog\Api\Data\ProductSearchResultsInterface
     * @throws LocalizedException
     */
    public function getProductsByCategoryId(
        int $categoryId,
        ?int $storeId = null,
        ?string $sortField = null,
        ?string $sortOrder = null,
        ?int $pageSize = null,
        ?int $currentPage = null
    ): \Magento\Catalog\Api\Data\ProductSearchResultsInterface;

    /**
     * Get a list of landing page products by url path.
     *
     * @param string $urlPath
     * @param int|null $storeId
     * @param string|null $sortField
     * @param string|null $sortOrder
     * @param int|null $pageSize
     * @param int|null $currentPage
     * @return \Magento\Catalog\Api\Data\ProductSearchResultsInterface
     * @throws LocalizedException
     */
    public function getProductsByUrlPath(
        string $urlPath,
        ?int $storeId = null,
        ?string $sortField = null,
        ?string $sortOrder = null,
        ?int $pageSize = null,
        ?int $currentPage = null
    ): \Magento\Catalog\Api\Data\ProductSearchResultsInterface;

    /**
     * Get a list of landing page products.
     *
     * @param int|null $storeId
     * @param string|null $sortField
     * @param string|null $sortOrder
     * @param int|null $pageSize
     * @param int|null $currentPage
     * @return \Magento\Catalog\Api\Data\ProductSearchResultsInterface
     * @throws LocalizedException
     */
    public function getProducts(
        ?int $storeId = null,
        ?string $sortField = null,
        ?string $sortOrder = null,
        ?int $pageSize = null,
        ?int $currentPage = null
    )
    : \Magento\Catalog\Api\Data\ProductSearchResultsInterface;
}
