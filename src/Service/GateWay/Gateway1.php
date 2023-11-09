<?php

namespace App\Service\GateWay;

use App\Entity\Payment;
use GatewayApi1;

class Gateway1 extends BaseGateway
{
    protected int $weight = 25;

    public function __construct(private GatewayApi1 $api)
    {
    }

    public function pay(Payment $payment): void
    {
        //payment process
    }

    public function getTrafficLoad(): int
    {
        return $this->api->getTrafficLoad();
    }

    public function getName(): string
    {
        return 'Gateway1';
    }
}