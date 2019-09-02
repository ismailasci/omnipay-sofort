<?php

namespace Omnipay\Sofort\Message;

use Omnipay\Common\Message\RequestInterface;

abstract class AbstractResponse extends \Omnipay\Common\Message\AbstractResponse
{
    public function __construct(RequestInterface $request, $response)
    {
        parent::__construct($request, $response);
        $this->data = $response->getBody()->getContents();
    }

    public function getRedirectMethod()
    {
        return 'GET';
    }

    public function getRedirectData()
    {
    }

    public function getRedirectUrl()
    {
    }
}
