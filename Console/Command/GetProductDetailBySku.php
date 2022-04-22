<?php
declare(strict_types=1);

namespace Lemundo\ProductLandingPage\Console\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class GetProductDetailBySku extends AbstractCommand
{
    const SKU = 'sku';

    protected function configure()
    {
        $this->setName('lemundo:productlandingpage:getproductdetailbysku')
            ->setDescription('Get landigpage product detail by sku.')
            ->addOption(self::SKU, null, InputOption::VALUE_REQUIRED, self::SKU);

        parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $result = $this->productLandingPageRepository->getProductDetailBySku(
            $input->getOption(self::SKU),
            $this->getStoreId($input)
        );

        $this->writeOurResult($this->extractSearchResult($result), $output);

        return 0;
    }
}
