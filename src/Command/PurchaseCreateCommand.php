<?php

declare(strict_types=1);

namespace App\Command;

use App\Entity\Purchase;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:purchase:create',
    description: 'Create purchase',
)]
class PurchaseCreateCommand extends Command
{
    /**
     * @param EntityManagerInterface $entityManager
     * @param string|null $name
     */
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        ?string $name = null
    ) {
        parent::__construct($name);
    }

    protected function configure(): void
    {
        $this
            ->addArgument('name', InputArgument::OPTIONAL, 'Name')
            ->addArgument('quantity', InputArgument::OPTIONAL, 'Quantity')
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $name = (string) $input->getArgument('name');
        $quantity = (int) $input->getArgument('quantity');

        if ($name === '' || $quantity <= 0) {
            $io->error('Invalid arguments');

            return Command::INVALID;
        }

        $purchase = new Purchase($name, $quantity);
        $this->entityManager->persist($purchase);
        $this->entityManager->flush();

        return Command::SUCCESS;
    }
}
