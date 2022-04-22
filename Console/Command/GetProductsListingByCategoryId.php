<?php
declare(strict_types=1);

namespace Lemundo\ProductLandingPage\Console\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class GetProductsListingByCategoryId extends AbstractCommand
{
    const CATEGORY_ID = 'category_id';

    protected function configure()
    {
        $this->setName('lemundo:productlandingpage:getproductsbycategoryid')
            ->setDescription('Get landigpage products by category id.')
            ->addOption(self::CATEGORY_ID, null, InputOption::VALUE_REQUIRED, self::CATEGORY_ID);

        parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $result = $this->productLandingPageRepository->getProductsByCategoryId(
            $input->getOption(self::CATEGORY_ID),
            $this->getStoreId($input),
            $input->getOption(self::SORT_FIELD),
            $input->getOption(self::SORT_ORDER),
            $this->stringToIntNotEmpty($input->getOption(self::PAGE_SIZE)),
            $this->stringToIntNotEmpty($input->getOption(self::CURRENT_PAGE))
        );

        $this->writeOurResult($this->extractSearchResult($result), $output);

        return 0;
    }
}
