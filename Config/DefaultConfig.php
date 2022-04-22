<?php
declare(strict_types=1);

namespace Lemundo\ProductLandingPage\Config;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class DefaultConfig
{
    private ScopeConfigInterface $scopeConfig;

    public function __construct(ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
    }

    public function getDefaultPageSize(): int
    {
        return (int)$this->scopeConfig->getValue(
            'lemundo_product_landing_page/general/default_pagesize',
            ScopeInterface::SCOPE_STORES
        );
    }

    public function getDefaultSortField(): string
    {
        return $this->scopeConfig->getValue(
            'lemundo_product_landing_page/general/default_sortfield',
            ScopeInterface::SCOPE_STORES
        );
    }

    public function getDefaultSortOrder()
    {
        return $this->scopeConfig->getValue(
            'lemundo_product_landing_page/general/default_sortorder',
            ScopeInterface::SCOPE_STORES
        );
    }

    public function isPriceCalculationWithTax(): bool
    {
        return (bool)$this->scopeConfig->getValue(
            'tax/calculation/price_includes_tax',
            ScopeInterface::SCOPE_STORE
        );
    }
}
