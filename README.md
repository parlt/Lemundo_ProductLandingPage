---
title: README

---

# Lemundo_ProductLandingPage

## General

The purpose of this module is to offer endpoints for landing page products,<br> 
a widget to show them f.e. in cms pages and console commands to show them on cli.

## Overview

#### ``Postman``

With postman_collection.json it is possible to import them in your local postman.

#### ``Filter and pagination``
- All endpoints supporting filter by `storeId` . 
- All endpoints except `/V1/productlandingpage/productdetailbysku` supporting sorting with `sortField` and `sortOrder`
- All endpoints except `/V1/productlandingpage/productdetailbysku` supporting pagination with `pageSize` and `currentPage`


#### ``Product landing page impact on Magento``

The product landing page module don't have any impact on the Magento core as it is independent.

## Web APIs

### ``/V1/productlandingpage/productdetailbysku``
Purpose:  Get product details for landing page products by sku. <br>
Interface: ``\Lemundo\ProductLandingPage\Api\ProductLandingPageRepositoryInterface`` <br>
Implementation: ``\Lemundo\ProductLandingPage\Repository\ProductLandingPageRepository`` <br>
Request: ``Get`` <br>
Response: ``\Magento\Catalog\Api\Data\ProductSearchResultsInterface`` <br>
Required arguments  `sku` <br>
Optional arguments `storeId`

### ``/V1/productlandingpage/productsbycategoryid``
Purpose:  Get landing page products by category id. <br>
Interface: ``\Lemundo\ProductLandingPage\Api\ProductLandingPageRepositoryInterface`` <br>
Implementation: ``\Lemundo\ProductLandingPage\Repository\ProductLandingPageRepository`` <br>
Request: ``Get`` <br>
Response: ``\Magento\Catalog\Api\Data\ProductSearchResultsInterface`` <br>
Required arguments  `categoryId` <br>
Optional arguments `storeId`, `sortField`, `sortOrder`, `pageSize`, `currentPage`

### ``/V1/productlandingpage/productsbyurlpath``
Purpose:  Get landing page products url path. <br>
Interface: ``\Lemundo\ProductLandingPage\Api\ProductLandingPageRepositoryInterface`` <br>
Implementation: ``\Lemundo\ProductLandingPage\Repository\ProductLandingPageRepository`` <br>
Request: ``Get`` <br>
Response: ``\Magento\Catalog\Api\Data\ProductSearchResultsInterface`` <br>
Required arguments  `urlPath` <br>
Optional arguments `storeId`, `sortField`, `sortOrder`, `pageSize`, `currentPage`

### ``/V1/productlandingpage/products``
Purpose:  Get landing page products.  <br>
Interface: ``\Lemundo\ProductLandingPage\Api\ProductLandingPageRepositoryInterface`` <br>
Implementation: ``\Lemundo\ProductLandingPage\Repository\ProductLandingPageRepository`` <br>
Request: ``Get`` <br>
Response: ``\Magento\Catalog\Api\Data\ProductSearchResultsInterface` `<br>
Optional arguments `storeId`, `sortField`, `sortOrder`, `pageSize`, `currentPage`

## Configuration

| tab | section | group   | field |
|:----|:--------|:--------|:------|
| lemundo | lemundo_product_landing_page | general | default_pagesize |
| lemundo | lemundo_product_landing_page | general | default_sortfield |
| lemundo | lemundo_product_landing_page | general | default_sortorder |

### ``\Lemundo\ProductLandingPage\Config\DefaultConfig``

- Contains product landing page configuration fields

## Acl

| id | title | parent   |
|:----|:--------|:--------|
| Lemundo_ProductLandingPage::productlandingpage_config | Lemundo ProductLandingPage Config | Magento_Backend::admin |

## Preferences

| source-class                                                          | custom-class                                                         |
|:----------------------------------------------------------------------|:---------------------------------------------------------------------|
| Lemundo\ProductLandingPage\Api\ProductLandingPageRepositoryInterface  | Lemundo\ProductLandingPage\Repository\ProductLandingPageRepository   |
| Lemundo\ProductLandingPage\Api\ProductDetailBySkuServiceInterface     | Lemundo\ProductLandingPage\Service\ProductDetailBySkuService         |
| Lemundo\ProductLandingPage\Api\ProductsByCategoryIdServiceInterface   | Lemundo\ProductLandingPage\Service\ProductsByCategoryIdService       |
| Lemundo\ProductLandingPage\Api\ProductsByUrlPathServiceInterface      | Lemundo\ProductLandingPage\Service\ProductsByUrlPathService          |
| Lemundo\ProductLandingPage\Api\ProductsServiceInterface               | Lemundo\ProductLandingPage\Service\ProductsService                   |
| Lemundo\ProductLandingPage\Api\GetProductCollectionServiceInterface   | Lemundo\ProductLandingPage\Service\GetProductCollectionService       |


## Services

### ``\Lemundo\ProductLandingPage\Service\ProductDetailBySkuService``
Get product details for landing page products by sku.

### ``\Lemundo\ProductLandingPage\Service\ProductsByCategoryIdService``
Get landing page products by category id.

### ``\Lemundo\ProductLandingPage\Service\ProductsByUrlPathService``
Get landing page products url path.

### ``\Lemundo\ProductLandingPage\Service\ProductsService``
Get landing page products.

### ``\Lemundo\ProductLandingPage\Service\GetProductCollectionService``
Get generic prefiltered landing page product collection with necessary fields and attributes.

## Interfaces

### ``\Lemundo\ProductLandingPage\Api\ProductLandingPageRepositoryInterface`` <br> 
Proxy class for all get landing page product services. <br>
``\Lemundo\ProductLandingPage\Repository\ProductLandingPageRepository::getProductDetailBySku`` <br>
``\Lemundo\ProductLandingPage\Repository\ProductLandingPageRepository::getProductsByCategoryId``<br>
``\Lemundo\ProductLandingPage\Repository\ProductLandingPageRepository::getProductsByUrlPath``<br>
``\Lemundo\ProductLandingPage\Repository\ProductLandingPageRepository::getProducts``<br>

### ``\Lemundo\ProductLandingPage\Api\ProductDetailBySkuServiceInterface``
``\Lemundo\ProductLandingPage\Service\ProductDetailBySkuService::execute`` get product details for landing page products by sku.

### ``\Lemundo\ProductLandingPage\Api\ProductsByCategoryIdServiceInterface``
``\Lemundo\ProductLandingPage\Service\ProductsByCategoryIdService::execute`` get landing page products by category id.

### ``\Lemundo\ProductLandingPage\Api\ProductsByUrlPathServiceInterface``
``\Lemundo\ProductLandingPage\Service\ProductsByUrlPathService::execute`` get landing page products url path.

### ``\Lemundo\ProductLandingPage\Api\ProductsServiceInterface``
``\Lemundo\ProductLandingPage\Service\ProductsService::execute`` get landing page products.

## Repository

### ``\Lemundo\ProductLandingPage\Repository\ProductLandingPageRepository``
Proxy class for all get landing page product services.

## Model

### ``\Lemundo\ProductLandingPage\Model\Config\Source\SortList``
Select values for `default_sortorder` configuration.

## Console

### ``\Lemundo\ProductLandingPage\Console\Command\GetProductDetailBySku``

Get product details for landing page products by sku. Calls `\Lemundo\ProductLandingPage\Api\ProductLandingPageRepositoryInterface`, required command option `--sku=XXX`.

Command example `bin/magento lemundo:productlandingpage:getproductdetailbysku --sku=XXX`.

### ``\Lemundo\ProductLandingPage\Console\Command\GetProductsListing``

Get landing page products. Calls `\Lemundo\ProductLandingPage\Api\ProductLandingPageRepositoryInterface`.

Command example `bin/magento lemundo:productlandingpage:getproducts`.

### ``\Lemundo\ProductLandingPage\Console\Command\GetProductsListingByCategoryId``

Get landing page products by category id. Calls `\Lemundo\ProductLandingPage\Api\ProductLandingPageRepositoryInterface`, required command option `--category_id=XXX`.

Command example `bin/magento lemundo:productlandingpage:getproductsbycategoryid --category_id=XXX`.

### ``\Lemundo\ProductLandingPage\Console\Command\GetProductsListingByUrlPath``

Get landing page products url path. Calls `\Lemundo\ProductLandingPage\Api\ProductLandingPageRepositoryInterface`, required command option `--url_path=XXX`.

Command example `bin/magento lemundo:productlandingpage:getproductsbyurlpath --url_path=XXX`.

## Block

### ``\Lemundo\ProductLandingPage\Block\Widget\ProductLandingPageWidgetBlock``
Block for ProductLandingPageWidget overrides `getProductPriceHtml`.

## ViewModel

### ``\Lemundo\ProductLandingPage\ViewModel\ProductLandingPageWidgetViewModel``
View model for ProductLandingPageWidget implements `getProductList`, `getMaxProducts`, `getEscaper`, `getProductUrl`, `getProductImageUrl`, `getPreparedPostData`.

## Plugins

### assign_view_model

`Lemundo\ProductLandingPage\Plugin\Block\Widget\ProductLandingPageWidgetPlugin::beforeToHtml` - this plugin intercepts
`Lemundo\ProductLandingPage\Block\Widget\ProductLandingPageWidgetBlock::toHtml` and assigns the view model  `Lemundo\ProductLandingPage\ViewModel\ProductLandingPageWidgetViewMode` to var `viewModel`.
with widgets is is not possible to use the regular xml argument assignment for view models.


## Frontend Implementation

### Ui Components Templates
`Lemundo\ProductLandingPage\view\frontend\web\templates\widget\listproducts.phtml` - landing page product widget list template.
