<?php

declare(strict_types=1);

namespace App\Core\Domain\Model;

use Symfony\Component\Uid\Uuid;

class Warning
{
    private \DateTimeImmutable $createdAt;
    private \DateTimeImmutable $updatedAt;
    private ?\DateTimeImmutable $deletedAt = null;

    public function __construct(
        private Uuid $id,
        private string $subjectType,
        private string $subjectId,
        private string $category
    )
    {
        $now = new \DateTimeImmutable();
        $this->createdAt = $now;
        $this->updatedAt = $now;
    }

    public function getId(): Uuid { return $this->id; }
    public function getSubjectType(): string { return $this->subjectType; }
    public function getSubjectId(): string { return $this->subjectId; }
    public function getCategory(): string { return $this->category; }

    public function refresh(): void
    {
        $this->updatedAt = new \DateTimeImmutable();
    }

    public function close(): void
    {
        $this->deletedAt = new \DateTimeImmutable();
        $this->updatedAt = $this->deletedAt;
    }

    public function isClosed(): bool
    {
        return $this->deletedAt !== null;
    }
}
