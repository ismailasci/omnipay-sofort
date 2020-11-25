<?php

namespace Omnipay\Sofort;

use Omnipay\Tests\GatewayTestCase;

class GatewayTest extends GatewayTestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->gateway = new Gateway($this->getHttpClient(), $this->getHttpRequest());
    }

    public function testAuthorizeSuccess()
    {
        $options = array(
            'amount' => '10.00',
            'returnUrl' => 'https://www.example.com/return',
            'cancelUrl' => 'https://www.example.com/cancel',
        );

        $this->setMockHttpResponse('AuthorizeSuccess.txt');
        $response = $this->gateway->authorize($options)->send();

        $this->assertInstanceOf('\Omnipay\Sofort\Message\AuthorizeResponse', $response);
        $this->assertTrue($response->isSuccessful());
        $this->assertTrue($response->isRedirect());
        $this->assertEquals('https://www.sofort.com/payment/go/dd853fc10480b7b6b1ae47252a973166e96aab5b', $response->getRedirectUrl());
    }

    public function testAuthorizeFailure()
    {
        $options = array(
            'amount' => '10.00',
            'returnUrl' => 'https://www.example.com/return',
            'cancelUrl' => 'https://www.example.com/cancel',
        );

        $this->setMockHttpResponse('AuthorizeFailure.txt');
        $response = $this->gateway->authorize($options)->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertEmpty($response->getTransactionReference());
        $this->assertSame('8015: Amount is out of range. ', $response->getMessage());
    }

    public function testCompleteAuthorizeSuccess()
    {
        $this->setMockHttpResponse('CompleteAuthorizeSuccess.txt');
        $response = $this->gateway->completeAuthorize()->send();

        $this->assertInstanceOf('\Omnipay\Sofort\Message\CompleteAuthorizeResponse', $response);
        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
    }

    public function testCompleteAuthorizeFailure()
    {
        $this->setMockHttpResponse('CompleteAuthorizeFailure.txt');
        $response = $this->gateway->completeAuthorize()->send();

        $this->assertInstanceOf('\Omnipay\Sofort\Message\CompleteAuthorizeResponse', $response);
        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
    }

    public function testInitialize()
    {
    	$this->gateway->initialize(array(
            'country' => 'de',
            'protection' => 1,
    	));

    	$this->assertEquals('de', $this->gateway->getCountry());
        $this->assertEquals(true, $this->gateway->getProtection());
    }
}
