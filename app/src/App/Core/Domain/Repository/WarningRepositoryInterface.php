<?php

declare(strict_types=1);

namespace App\Core\Domain\Repository;

use App\Core\Domain\Model\Warning;

interface WarningRepositoryInterface
{
    public function save(Warning $warning): void;

    public function findOpenBySubjectAndCategory(string $subjectType, string $subjectId, string $category): ?Warning;

    public function closeAllBySubjectAndCategory(string $subjectType, string $subjectId, string $category): int;

    /** @return Warning[] */
    public function findAllOpenByCategory(string $category): array;
}
