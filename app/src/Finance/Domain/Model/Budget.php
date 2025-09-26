<?php

declare(strict_types=1);

use Symfony\Component\Uid\Uuid;

class Budget
{
    private \DateTimeImmutable $createdAt;
    private \DateTimeImmutable $updatedAt;
    private ?\DateTimeImmutable $deletedAt = null;

    public function __construct(private Uuid $id, private string $name, private int $balance)
    {
        $now = new \DateTimeImmutable();
        $this->createdAt = $now;
        $this->updatedAt = $now;
    }

    public function getId(): Uuid { return $this->id; }
    public function getName(): string { return $this->name; }
    public function getBalance(): int { return $this->balance; }

    public function changeBalance(int $delta): void
    {
        $this->balance += $delta;
        $this->updatedAt = new \DateTimeImmutable();
    }

    public function isNegative(): bool
    {
        return $this->balance < 0;
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
