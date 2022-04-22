<?php
declare(strict_types=1);

namespace Lemundo\ProductLandingPage\Plugin\Block\Widget;

use Lemundo\ProductLandingPage\Block\Widget\ProductLandingPageWidgetBlock;
use Lemundo\ProductLandingPage\ViewModel\ProductLandingPageWidgetViewModel;

class ProductLandingPageWidgetPlugin
{
    private ProductLandingPageWidgetViewModel $productLandingPageViewModel;

    public function __construct(
        ProductLandingPageWidgetViewModel $productLandingPageViewModel
    ) {
        $this->productLandingPageViewModel = $productLandingPageViewModel;
    }

    public function beforeToHtml(ProductLandingPageWidgetBlock $productLandingPageWidgetBlock):array
    {
        $productLandingPageWidgetBlock->assign('viewModel', $this->productLandingPageViewModel);
        return [];
    }
}
