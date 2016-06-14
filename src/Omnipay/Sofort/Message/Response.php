<?php

namespace Omnipay\Sofort\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;

class Response extends AbstractResponse
{
    public function __construct(RequestInterface $request, $response)
    {
        parent::__construct($request, $response);
        $this->data = $response->xml();
    }

    public function isSuccessful()
    {
        return false;
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
