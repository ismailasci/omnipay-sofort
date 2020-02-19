<?php

declare(strict_types=1);

namespace Omnipay\Sofort\Message;

use Omnipay\Tests\TestCase;

class RefundRequestTest extends TestCase
{
    public function testGetData()
    {
        $request = new RefundRequest($this->getHttpClient(), $this->getHttpRequest());
        $request->initialize(array(
            'transactionReference' => '55742-165747-52441DAF-3596',
            'amount' => 1
        ));

        $data = $request->getData();

        $this->assertInstanceOf('SimpleXMLElement', $data);
        $this->assertSame('55742-165747-52441DAF-3596', (string) $data->refund->transaction);
        $this->assertSame('1.00', (string) $data->refund->amount);
    }
}
