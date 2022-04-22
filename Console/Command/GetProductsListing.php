<?php
declare(strict_types=1);

namespace Lemundo\ProductLandingPage\Console\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GetProductsListing extends AbstractCommand
{
    protected function configure()
    {
        $this->setName('lemundo:productlandingpage:getproducts')
            ->setDescription('Get landigpage products.');

        parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $result = $this->productLandingPageRepository->getProducts(
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
