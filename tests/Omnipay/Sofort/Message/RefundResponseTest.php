<?php

declare(strict_types=1);

namespace Omnipay\Sofort\Message;

use Omnipay\Tests\TestCase;

class RefundResponseTest extends TestCase
{
    public function testRefundSuccess()
    {
        $httpResponse = $this->getMockHttpResponse('RefundSuccess.txt');
        $response = new RefundResponse($this->getMockRequest(), $httpResponse);

        $this->assertTrue($response->isSuccessful());
    }

    public function testRefundFailure()
    {
        $httpResponse = $this->getMockHttpResponse('RefundFailure.txt');
        $response = new RefundResponse($this->getMockRequest(), $httpResponse);

        $this->assertFalse($response->isSuccessful());
    }
}
