<?php

declare(strict_types=1);

namespace Omnipay\Sofort\Message;

use SimpleXMLElement;

class RefundRequest extends AbstractRequest
{
    public function getData()
    {
        $data = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><refunds/>');

        $data->addChild('project_id', $this->getProjectId());

        $refund = $data->addChild('refund');

        $refund->addChild('amount', $this->getAmount());
        $refund->addChild('transaction', $this->getTransactionReference());

        return $data;
    }

    protected function createResponse($response)
    {
        return $this->response = new RefundResponse($this, $response);
    }
}
