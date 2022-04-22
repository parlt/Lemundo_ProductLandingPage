<?php
declare(strict_types=1);

namespace Lemundo\ProductLandingPage\Console\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class GetProductsListingByUrlPath extends AbstractCommand
{
    const URL_PATH = 'url_path';

    protected function configure()
    {
        $this->setName('lemundo:productlandingpage:getproductsbyurlpath')
            ->setDescription('Get landigpage products by url path.')
            ->addOption(self::URL_PATH, null, InputOption::VALUE_REQUIRED, self::URL_PATH);

        parent::configure();
    }
    protected function execute(InputInterface $input, OutputInterface $output): int
    {

        $result = $this->productLandingPageRepository->getProductsByUrlPath(
            $input->getOption(self::URL_PATH),
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
