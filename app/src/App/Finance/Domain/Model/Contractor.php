<?php

declare(strict_types=1);

namespace App\Finance\Domain\Model;

use Symfony\Component\Uid\Uuid;

class Contractor
{
    private Uuid $id;
    private \DateTimeImmutable $createdAt;
    private \DateTimeImmutable $updatedAt;
    private ?\DateTimeImmutable $deletedAt = null;

    public function __construct(Uuid $id, private string $name)
    {
        $now = new \DateTimeImmutable();
        $this->id = $id;
        $this->createdAt = $now;
        $this->updatedAt = $now;
    }

    public function getId(): Uuid { return $this->id; }
    public function getName(): string { return $this->name; }

    public function rename(string $newName): void
    {
        $this->name = $newName;
        $this->updatedAt = new \DateTimeImmutable();
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
