<?php

/*
 * This file is part of the Omnipay package.
 *
 * (c) Adrian Macneil <adrian@adrianmacneil.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Asci\Omnipay\Sofort\Message;

use Omnipay\TestCase;


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
