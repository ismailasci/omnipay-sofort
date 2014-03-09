<?php

namespace Omnipay\Sofort\Message;

use Omnipay\Tests\TestCase;

class CompleteAuthorizeResponseTest extends TestCase
{
    public function testCompleteAuthorizeSuccess()
    {
        $httpResponse = $this->getMockHttpResponse('CompleteAuthorizeSuccess.txt');
        $response = new CompleteAuthorizeResponse($this->getMockRequest(), $httpResponse);

        $this->assertTrue($response->isSuccessful());
    }

    public function testCompleteAuthorizeFailure()
    {
        $httpResponse = $this->getMockHttpResponse('CompleteAuthorizeFailure.txt');
        $response = new CompleteAuthorizeResponse($this->getMockRequest(), $httpResponse);

        $this->assertFalse($response->isSuccessful());
    }
}
