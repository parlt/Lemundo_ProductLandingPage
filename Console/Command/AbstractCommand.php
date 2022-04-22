<?php
declare(strict_types=1);

namespace Lemundo\ProductLandingPage\Console\Command;

use Lemundo\ProductLandingPage\Api\ProductLandingPageRepositoryInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

abstract class AbstractCommand extends Command
{
    const STORE_ID = 'store_id';
    const SORT_FIELD = 'sort_field';
    const SORT_ORDER = 'sort_order';
    const PAGE_SIZE = 'page_size';
    const CURRENT_PAGE = 'current_page';

    protected ProductLandingPageRepositoryInterface $productLandingPageRepository;

    public function __construct(ProductLandingPageRepositoryInterface $productLandingPageRepository)
    {
        $this->productLandingPageRepository = $productLandingPageRepository;

        parent::__construct();
    }

    protected function configure()
    {
        $this->addOption(self::STORE_ID, null, InputOption::VALUE_OPTIONAL, self::STORE_ID)
            ->addOption(self::SORT_FIELD, null, InputOption::VALUE_REQUIRED, self::SORT_FIELD)
            ->addOption(self::SORT_ORDER, null, InputOption::VALUE_OPTIONAL, self::SORT_ORDER)
            ->addOption(self::PAGE_SIZE, null, InputOption::VALUE_OPTIONAL, self::PAGE_SIZE)
            ->addOption(self::CURRENT_PAGE, null, InputOption::VALUE_OPTIONAL, self::CURRENT_PAGE);

        parent::configure();
    }

    protected function getStoreId(InputInterface $input): ?int
    {
        return $input->getOption(self::STORE_ID);
    }

    protected function extractSearchResult(
        \Magento\Catalog\Api\Data\ProductSearchResultsInterface $productSearchResults
    ): array
    {

        $data = [];
        foreach ($productSearchResults->getItems() as $product) {
            $data[] = $product->getSku() . ' | ' . $product->getName();
        }
        return $data;
    }

    protected function writeOurResult(array $result, OutputInterface $output): void
    {
        foreach ($result as $item) {
            $output->writeln($item);
        }
    }

    protected function stringToIntNotEmpty(?string $value): ?int
    {

        if (empty($value)) {
            return null;
        }

        return (int)$value;

    }
}
