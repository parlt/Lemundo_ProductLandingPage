<?php
declare(strict_types=1);

namespace Lemundo\ProductLandingPage\Model\Config\Source;

class SortList implements \Magento\Framework\Data\OptionSourceInterface
{
    public function toOptionArray() : array
    {
        return [
            ['value' => 'ASC', 'label' => __('ASC')],
            ['value' => 'DESC', 'label' => __('DESC')],
        ];
    }
}
