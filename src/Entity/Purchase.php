<?php

declare(strict_types=1);

namespace App\Entity;

use App\Doctrine\Type\Purchase\PurchaseStatusType;
use App\Enum\Status;
use App\Repository\PurchaseRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: PurchaseRepository::class)]
#[ORM\Table(name: 'purchases')]
#[ORM\HasLifecycleCallbacks]
class Purchase
{
    use Trait\IdTrait;
    use Trait\TimestampTrait;

    #[ORM\Column(name: 'status', type: PurchaseStatusType::NAME)]
    private Status $status;

    #[ORM\Column(name: 'name', type: 'string')]
    private string $name;

    #[ORM\Column(name: 'quantity', type: 'integer')]
    private int $quantity;

    public function __construct(string $name, int  $quantity)
    {
        $this->id = Uuid::v7()->toRfc4122();
        $this->name = $name;
        $this->quantity = $quantity;
        $this->status = Status::NEW;
    }

    /**
     * @return Status
     */
    public function getStatus(): Status
    {
        return $this->status;
    }

    /**
     * @param Status $status
     */
    public function setStatus(Status $status): void
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }
}
