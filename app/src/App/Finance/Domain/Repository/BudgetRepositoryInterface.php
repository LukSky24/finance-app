<?php

declare(strict_types=1);

namespace App\Finance\Domain\Repository;

use App\Finance\Domain\Model\Budget;
use Symfony\Component\Uid\Uuid;

interface BudgetRepositoryInterface
{
    public function findById(Uuid $id): ?Budget;
    public function save(Budget $budget): void;
    /** @return Budget[] */
    public function findAllActive(): array;
}
