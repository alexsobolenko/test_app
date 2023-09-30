<?php

declare(strict_types=1);

namespace App\Command;

use App\Entity\Purchase;
use App\Enum\Status;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:purchase:update',
    description: 'Update purchase',
)]
class PurchaseUpdateCommand extends Command
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
            ->addArgument('id', InputArgument::OPTIONAL, 'ID')
            ->addArgument('status', InputArgument::OPTIONAL, 'Status')
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
        $id = $input->getArgument('id');
        $statusCase = (string) $input->getArgument('status');
        $status = Status::tryFrom($statusCase);
        if (!$id || !$status) {
            $io->error('Invalid arguments');

            return Command::INVALID;
        }

        $purchase = $this->entityManager->getRepository(Purchase::class)->find($id);
        if (!$purchase instanceof Purchase) {
            $io->error('Purchase not found');

            return Command::FAILURE;
        }

        $purchase->setStatus($status);
        $this->entityManager->flush();

        return Command::SUCCESS;
    }
}
