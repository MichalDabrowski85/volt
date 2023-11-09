<?php

namespace App\Tests;


use App\Entity\Payment;
use App\Service\GateWay;
use App\Service\TrafficSplit;
use PHPUnit\Framework\TestCase;

class TrafficSplitTest extends TestCase
{
    /** @dataProvider  setGateWayProvider */
    public function testTrafficSplit(TrafficSplit $trafficSplit, $runsOptions, $toleranceInPercent): void
    {
        foreach ($runsOptions as $run) {
            $result = [];
            foreach ($trafficSplit->getGateways() as $gatway) {
                $result[$gatway->getName()] = 0;
            }
            foreach (range(1, $run) as $value) {
                $chosenGateway = $trafficSplit->handlePayment(new Payment);
                $result[$chosenGateway->getName()]++;
            }
            $totalWeight = $trafficSplit->getTotalWeight();
            foreach ($trafficSplit->getGateways() as $gateway) {
                $trafficWithTolerance = $gateway->getTrafficLoad() + $toleranceInPercent;
                $expectedTrafficInPercent = round($totalWeight * $trafficWithTolerance / 100);
                $expectedTraffic = round($run * $expectedTrafficInPercent / 100);
                self::assertLessThanOrEqual($expectedTraffic, $result[$gateway->getName()]);

                $trafficWithTolerance = $gateway->getTrafficLoad() - $toleranceInPercent;
                $expectedTraffic = round($totalWeight * $trafficWithTolerance / 100);
                self::assertGreaterThanOrEqual($expectedTraffic, $result[$gateway->getName()]);
            }
        }
    }

    public function setGateWayProvider(): \Generator
    {
        $gateway1 = $this->createMock(GateWay\Gateway1::class);
        $gateway1->method('getTrafficLoad')->willReturn(25);
        $gateway1->method('getName')->willReturn('Gateway1');

        $gateway2 = $this->createMock(GateWay\Gateway2::class);
        $gateway2->method('getTrafficLoad')->willReturn(25);
        $gateway2->method('getName')->willReturn('Gateway2');

        $gateway3 = $this->createMock(GateWay\Gateway3::class);
        $gateway3->method('getTrafficLoad')->willReturn(25);
        $gateway3->method('getName')->willReturn('Gateway3');

        $gateway4 = $this->createMock(GateWay\Gateway4::class);
        $gateway4->method('getTrafficLoad')->willReturn(25);
        $gateway4->method('getName')->willReturn('Gateway4');

        yield 'gateways 25,25,25,25' => [new TrafficSplit([
            $gateway1,
            $gateway2,
            $gateway3,
            $gateway4,
        ],), [100, 1000], 6];

        $gateway1 = $this->createMock(GateWay\Gateway1::class);
        $gateway1->method('getTrafficLoad')->willReturn(50);
        $gateway1->method('getName')->willReturn('Gateway1');

        $gateway2 = $this->createMock(GateWay\Gateway2::class);
        $gateway2->method('getTrafficLoad')->willReturn(50);
        $gateway2->method('getName')->willReturn('Gateway2');

        $gateway3 = $this->createMock(GateWay\Gateway3::class);
        $gateway3->method('getTrafficLoad')->willReturn(50);
        $gateway3->method('getName')->willReturn('Gateway3');

        yield 'gateways 75,10,15' => [new TrafficSplit([
            $gateway1,
            $gateway2,
            $gateway3,
        ],), [100, 1000], 6];
    }
}