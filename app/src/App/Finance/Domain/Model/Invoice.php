<?php

declare(strict_types=1);

namespace App\Finance\Domain\Model;

use Symfony\Component\Uid\Uuid;
use App\Core\Domain\Model\Money;

class Invoice
{
    private \DateTimeImmutable $createdAt;
    private \DateTimeImmutable $updatedAt;
    private ?\DateTimeImmutable $deletedAt = null;

    public function __construct(
        private Uuid $id,
        private string $number,
        private Uuid $contractorId,
        private Money $amount,
        private bool $paid,
        private \DateTimeImmutable $dueDate
    ) {
        $now = new \DateTimeImmutable();
        $this->createdAt = $now;
        $this->updatedAt = $now;
    }

    public function getId(): Uuid { return $this->id; }
    public function getNumber(): string { return $this->number; }
    public function getContractorId(): Uuid { return $this->contractorId; }
    public function getAmount(): Money { return $this->amount; }
    public function isPaid(): bool { return $this->paid; }
    public function getDueDate(): \DateTimeImmutable { return $this->dueDate; }

    public function markPaid(): void
    {
        $this->paid = true;
        $this->updatedAt = new \DateTimeImmutable();
    }

    public function isOverdue(\DateTimeImmutable $now = new \DateTimeImmutable()): bool
    {
        return $this->paid === false && $this->dueDate < $now;
    }

    public function markDeleted(): void
    {
        $this->deletedAt = new \DateTimeImmutable();
        $this->updatedAt = $this->deletedAt;
    }

    public function getCreatedAt(): \DateTimeImmutable { return $this->createdAt; }
    public function getUpdatedAt(): \DateTimeImmutable { return $this->updatedAt; }
    public function getDeletedAt(): ?\DateTimeImmutable { return $this->deletedAt; }
}
