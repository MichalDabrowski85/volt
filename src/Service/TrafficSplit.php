<?php

namespace App\Service;

use App\Entity\Payment;
use App\Service\GateWay\BaseGateway;

class TrafficSplit
{
    private int $totalWeight = 0;
    private array $counter = [];

    /** @var BaseGateway[] $gateways */
    public function __construct(private array $gateways)
    {
        $this->init();
    }

    private function init(): void
    {
        foreach ($this->gateways as $gateway) {
            $this->totalWeight += $gateway->getWeight();
            $this->counter[$gateway->getName()] = 0;
        }
        assert($this->totalWeight, 100);
    }

    public function handlePayment(Payment $payment): void
    {
        $random = rand(1, $this->totalWeight);
        $countHelper = 0;

        foreach ($this->gateways as $gateway) {
            $countHelper += $gateway->getWeight();
            if ($random <= $countHelper) {
                $gateway->pay($payment);
                $this->counter[$gateway->getName()]++;
                return;
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

    public function getTrafficInPercentByGateWayName(string $gatewayName): int
    {
        return $this->counter[$gatewayName];
    }

    public function resetCounter(): void
    {
        foreach ($this->gateways as $gateway) {
            $this->counter[$gateway->getName()] = 0;
        }
    }
}