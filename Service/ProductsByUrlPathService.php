<?php
declare(strict_types=1);

namespace Lemundo\ProductLandingPage\Service;

use Lemundo\ProductLandingPage\Api\GetProductCollectionServiceInterface;
use Lemundo\ProductLandingPage\Api\ProductsByUrlPathServiceInterface;
use Magento\Catalog\Model\Product;

class ProductsByUrlPathService implements ProductsByUrlPathServiceInterface
{
    private GetProductCollectionServiceInterface $getProductCollectionService;

    public function __construct(GetProductCollectionServiceInterface $getProductCollectionService)
    {
        $this->getProductCollectionService = $getProductCollectionService;
    }

    public function execute(
        string $urlPath,
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

        // if you really mean filter by url_path see functional code below,
        // if you mean url_key we can use an attribute filter

        // $productCollection->addAttributeToFilter('url_key', ['eq' => $urlPath]);

        $productCollection->addMediaGalleryData();
        return $this->filterByUrlPath($urlPath, $productCollection->getItems());
    }

    private function filterByUrlPath(string $urlPath, array $items): array
    {
        /**
         * @var int $index
         * @var Product $product
         */
        foreach ($items as $index => $product) {
            $productUrlPath = $product->getUrlModel()->getUrl($product);
            if (!\str_contains($productUrlPath, $urlPath)) {
                unset($items[$index]);
            }
        }

        return $items;
    }
}
