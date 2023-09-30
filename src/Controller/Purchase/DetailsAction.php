<?php

declare(strict_types=1);

namespace App\Controller\Purchase;

use App\Repository\PurchaseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
#[Route(path: '/purchases/{id}', name: 'app.purchase.details')]
class DetailsAction extends AbstractController
{
    /**
     * @param PurchaseRepository $purchaseRepository
     */
    public function __construct(
        private readonly PurchaseRepository $purchaseRepository
    ) {}

    /**
     * @return Response
     */
    public function __invoke(string $id): Response
    {
        return $this->render('purchase/details.html.twig', [
            'purchase' => $this->purchaseRepository->find($id),
        ]);
    }
}
