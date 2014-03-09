<?php

namespace Omnipay\Sofort\Message;

use SimpleXMLElement;

class CompleteAuthorizeRequest extends AbstractRequest
{
    public function getData()
    {
        $data = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><transaction_request/>');

        $data->addAttribute('version', 2);
        $data->addChild('transaction', $this->getTransactionId());

        return $data;
    }

    protected function createResponse($response)
    {
        return $this->response = new CompleteAuthorizeResponse($this, $response);
    }
}
