<?php

declare(strict_types=1);

final class Money
{
    private const string DEFAULT_CURRENCY = 'PLN';

    public function __construct(private float $amount, private readonly string $currency = self::DEFAULT_CURRENCY)
    {
        if ($this->currency === '') {
            throw new \InvalidArgumentException('Currency must be a non-empty string');
        }
    }

    public static function zero(string $currency = self::DEFAULT_CURRENCY): self
    {
        return new self(0.0, $currency);
    }

    public static function fromString(string $amount, string $currency = self::DEFAULT_CURRENCY): self
    {
        return new self((float)$amount, $currency);
    }

    public static function fromFloat(float $amount, string $currency = self::DEFAULT_CURRENCY): self
    {
        return new self($amount, $currency);
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function add(self $other): self
    {
        $this->assertSameCurrency($other);
        $sum = round($this->amount + $other->amount, 2);
        return new self($sum, $this->currency);
    }

    public function isNegative(): bool
    {
        return $this->amount < 0.0;
    }

    private function assertSameCurrency(self $other): void
    {
        if ($this->currency !== $other->currency) {
            throw new \InvalidArgumentException('Cannot operate on different currencies');
        }
    }
}


