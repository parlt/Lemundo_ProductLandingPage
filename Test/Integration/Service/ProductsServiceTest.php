<?php
declare(strict_types=1);

namespace Lemundo\ProductLandingPage\Test\Integration\Service;

use Lemundo\ProductLandingPage\Api\ProductsServiceInterface;
use Magento\Catalog\Model\Product;
use Magento\Framework\ObjectManagerInterface;
use Magento\TestFramework\Helper\Bootstrap;
use PHPUnit\Framework\TestCase;

/**
 * @magentoDataFixture Lemundo_ProductLandingPage::Test/Integration/_files/products.php
 * @magentoAppArea frontend
 * @magentoDbIsolation disabled
 */
class ProductsServiceTest extends TestCase
{
    protected ?ObjectManagerInterface $objectManager;

    private ?ProductsServiceInterface $productsService;

    private ?array $result;

    protected function setUp(): void
    {
        parent::setUp();

        $this->objectManager = Bootstrap::getObjectManager();
    }

    public function testExecute()
    {
        $this->givenWeHaveAProductServiceInstance();

        $this->whenWeExecuteProductService(null, 'name', 'DESC');

        $this->thenWeExpectANumberOfProducts(2);
        $this->thanWeExpectOnlyProductsWithLemundoLandingPageRelevantFlag();
        $this->thenWeExpectFistItemShouldHaveSku('B');
    }


    private function thenWeExpectFistItemShouldHaveSku(string $itemSku): void
    {
        self::assertNotEmpty($this->result);

        $item = \current($this->result);

        self::assertTrue($item instanceof Product);
        self::assertEquals($itemSku, $item->getData('sku'));
    }

    private function thenWeExpectANumberOfProducts(int $numberOfProducts): void
    {
        self::assertNotEmpty($this->result);
        self::assertEquals($numberOfProducts, \count($this->result));
    }

    private function thanWeExpectOnlyProductsWithLemundoLandingPageRelevantFlag(): void
    {
        foreach ($this->result as $product) {
            $this->assertEquals('1', $product->getData('lemundo_landingpage_relevant'));
        }
    }

    private function whenWeExecuteProductService(
        ?int $storeId = null,
        ?string $sortField = null,
        ?string $sortOrder = null,
        ?int $pageSize = null,
        ?int $currentPage = null
    ): void {
        $this->result = $this->productsService->execute($storeId, $sortField, $sortOrder, $pageSize, $currentPage);
    }

    private function givenWeHaveAProductServiceInstance(): void
    {
        $this->productsService = $this->objectManager->create(ProductsServiceInterface::class);
    }
}
