<?php

namespace App\Service\GateWay;

use App\Entity\Payment;

abstract class BaseGateway
{
    abstract protected function pay(Payment $payment): void;

    abstract public function getTrafficLoad(): int;

    abstract protected function getName(): string;
}