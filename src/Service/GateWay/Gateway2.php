<?php

namespace App\Service\GateWay;

use App\Entity\Payment;
use GatewayApi2;

class Gateway2 extends BaseGateway
{
    protected int $weight = 25;

    public function __construct(private GatewayApi2 $api)
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
        return 'Gateway2';
    }
}