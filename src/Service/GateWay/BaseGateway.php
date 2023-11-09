<?php

namespace App\Service\GateWay;

use App\Entity\Payment;

abstract class BaseGateway
{
    protected int $weight;

    abstract protected function pay(Payment $payment): void;

    abstract public function getTrafficLoad(): int;

    abstract protected function getName(): string;

    public function getWeight(): int
    {
        return $this->weight;
    }
}