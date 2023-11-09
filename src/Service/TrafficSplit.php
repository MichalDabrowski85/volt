<?php

namespace App\Service;

use App\Entity\Payment;
use App\Service\GateWay\BaseGateway;

class TrafficSplit
{
    private int $totalWeight = 0;

    /** @var BaseGateway[] $gateways */
    public function __construct(private array $gateways)
    {
        $this->init();
    }

    private function init(): void
    {
        foreach ($this->gateways as $gateway) {
            $this->totalWeight += $gateway->getTrafficLoad();
        }
    }

    public function handlePayment(Payment $payment): BaseGateway
    {
        $random = rand(1, $this->totalWeight);
        $countHelper = 0;

        foreach ($this->gateways as $gateway) {
            $countHelper += $gateway->getTrafficLoad();
            if ($random <= $countHelper) {
                $gateway->pay($payment);
                return $gateway;
            }
        }
    }

    public function getGateways(): array
    {
        return $this->gateways;
    }

    public function getTotalWeight(): int
    {
        return $this->totalWeight;
    }
}