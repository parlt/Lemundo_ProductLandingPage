<?php
declare(strict_types=1);

use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Model\Product;
use Magento\Catalog\Model\Product\Attribute\Source\Status;
use Magento\Catalog\Model\Product\Visibility;
use Magento\TestFramework\Helper\Bootstrap;

$objectManager = Bootstrap::getObjectManager();


/** @var $product1 Product */
$product1 = Bootstrap::getObjectManager()->create(Product::class);
$product1
    ->setId(188)
    ->setTypeId('simple')
    ->setAttributeSetId(9)
    ->setWebsiteIds([1])
    ->setName('Simple Product A')
    ->setSku('A')
    ->setPrice(10)
    ->setMetaTitle('meta title')
    ->setMetaKeyword('meta keyword')
    ->setMetaDescription('meta description')
    ->setVisibility(Visibility::VISIBILITY_BOTH)
    ->setStatus(Status::STATUS_ENABLED)
    ->setStockData(['use_config_manage_stock' => 1, 'qty' => 22, 'is_in_stock' => 1])
    ->setQty(22)
    ->setDescriotion('Description A')
    ->setUrlKey('simple-Product-a')
    ->setData('lemundo_product_features', 'Product features A')
    ->setData('lemundo_product_application', 'Product application A')
    ->setData('lemundo_landingpage_relevant', true)
    ->save();

/** @var $product2 Product */
$product2 = Bootstrap::getObjectManager()->create(Product::class);
$product2
    ->setId(189)
    ->setTypeId('simple')
    ->setAttributeSetId(9)
    ->setWebsiteIds([1])
    ->setName('Simple Product B')
    ->setSku('B')
    ->setPrice(10)
    ->setMetaTitle('meta title')
    ->setMetaKeyword('meta keyword')
    ->setMetaDescription('meta description')
    ->setVisibility(Visibility::VISIBILITY_BOTH)
    ->setStatus(Status::STATUS_ENABLED)
    ->setStockData(['use_config_manage_stock' => 1, 'qty' => 22, 'is_in_stock' => 1])
    ->setQty(22)
    ->setDescriotion('Description B')
    ->setUrlKey('simple-Product-b')
    ->setData('lemundo_product_features', 'Product features B')
    ->setData('lemundo_product_application', 'Product application B')
    ->setData('lemundo_landingpage_relevant', true)
    ->save();

/** @var $product3 Product */
$product3 = Bootstrap::getObjectManager()->create(Product::class);
$product3
    ->setId(190)
    ->setTypeId('simple')
    ->setAttributeSetId(9)
    ->setWebsiteIds([1])
    ->setName('Simple Product C')
    ->setSku('B')
    ->setPrice(10)
    ->setMetaTitle('meta title')
    ->setMetaKeyword('meta keyword')
    ->setMetaDescription('meta description')
    ->setVisibility(Visibility::VISIBILITY_BOTH)
    ->setStatus(Status::STATUS_ENABLED)
    ->setStockData(['use_config_manage_stock' => 1, 'qty' => 22, 'is_in_stock' => 1])
    ->setQty(22)
    ->setDescriotion('Description C')
    ->setUrlKey('simple-Product-C')
    ->setData('lemundo_product_features', 'Product features C')
    ->setData('lemundo_product_application', 'Product application C')
    ->setData('lemundo_landingpage_relevant', false)
    ->save();

