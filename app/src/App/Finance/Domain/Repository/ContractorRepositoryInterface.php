<?php

declare(strict_types=1);

namespace App\Finance\Domain\Repository;

use App\Finance\Domain\Model\Contractor;
use Symfony\Component\Uid\Uuid;

interface ContractorRepositoryInterface
{
    public function findById(Uuid $id): ?Contractor;
    public function save(Contractor $contractor): void;
    /** @return Contractor[] */
    public function findAllActive(): array;
}
