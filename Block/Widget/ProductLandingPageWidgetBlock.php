<?php
declare(strict_types=1);

namespace Lemundo\ProductLandingPage\Block\Widget;

use Magento\Catalog\Model\Product;
use Magento\Catalog\Pricing\Price\FinalPrice;
use Magento\Framework\Pricing\Render as PricingRenderer;
use Magento\Framework\View\Element\Template;

use Magento\Widget\Block\BlockInterface;

class ProductLandingPageWidgetBlock extends Template implements BlockInterface
{
    public function getProductPriceHtml(
        Product $product,
        $priceType = null,
        $renderZone = PricingRenderer::ZONE_ITEM_LIST,
        array $arguments = []
    ): string {

        if (!isset($arguments['zone'])) {
            $arguments['zone'] = $renderZone;
        }

        $arguments['zone'] = $arguments['zone']
            ?? $renderZone;

        $arguments['price_id'] = $arguments['price_id']
            ?? 'old-price-' . $product->getId() . '-' . $priceType;

        $arguments['include_container'] = $arguments['include_container']
            ?? true;

        $arguments['display_minimal_price'] = $arguments['display_minimal_price']
            ?? true;
        /** @var PricingRenderer $priceRender */
        $priceRender = $this->getLayout()->getBlock('product.price.render.default');

        $price = '';
        if ($priceRender) {
            $price = $priceRender->render(
                FinalPrice::PRICE_CODE,
                $product,
                $arguments
            );
        }

        return $price;
    }
}
