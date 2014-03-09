<?php

namespace Omnipay\Sofort\Message;

use Omnipay\Tests\TestCase;

class AuthorizeResponseTest extends TestCase
{
    public function testAuthorizeSuccess()
    {
        $httpResponse = $this->getMockHttpResponse('AuthorizeSuccess.txt');
        $response = new AuthorizeResponse($this->getMockRequest(), $httpResponse);

        $this->assertTrue($response->isRedirect());
        $this->assertFalse($response->isSuccessful());
        $this->assertSame('55742-165747-52449B4B-6475', $response->getTransactionReference());
        $this->assertNull($response->getMessage());
        $this->assertNull($response->getRedirectData());
        $this->assertSame('GET', $response->getRedirectMethod());
    }

    public function testAuthorizeFailure()
    {
        $httpResponse = $this->getMockHttpResponse('AuthorizeFailure.txt');
        $response = new AuthorizeResponse($this->getMockRequest(), $httpResponse);

        $this->assertFalse($response->isRedirect());
        $this->assertFalse($response->isSuccessful());
        $this->assertEmpty($response->getTransactionReference());
        $this->assertSame('8015: Amount is out of range. ', $response->getMessage());
        $this->assertNull($response->getRedirectData());
        $this->assertSame('GET', $response->getRedirectMethod());
    }
}
