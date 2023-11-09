<?php

namespace App\Service\GateWay;

use App\Entity\Payment;
use GatewayApi4;

class Gateway4 extends BaseGateway
{

    public function __construct(private GatewayApi4 $api)
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
        return 'Gateway4';
    }

}