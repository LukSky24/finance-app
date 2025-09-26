<?php

declare(strict_types=1);

namespace App\Finance\Domain\Repository;

use App\Finance\Domain\Model\Invoice;
use App\Core\Domain\Model\Money;
use Symfony\Component\Uid\Uuid;

interface InvoiceRepositoryInterface
{
    public function findById(Uuid $id): ?Invoice;
    public function save(Invoice $invoice): void;

    /** @return Invoice[] */
    public function findOverdueUnpaid(): array;

    /** @return Invoice[] */
    public function findUnpaidByContractor(Uuid $contractorId): array;

    public function sumUnpaidOverdueAmountByContractor(Uuid $contractorId): Money;
}
