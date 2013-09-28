<?php

namespace Asci\Omnipay\Sofort\Message;

use SimpleXMLElement;

class AuthorizeRequest extends AbstractRequest
{
    public function getData()
    {
        $data = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><multipay/>');

        $data->addChild('project_id', $this->getProjectId());
        $data->addChild('language_code', 'de');
        $data->addChild('amount', $this->getAmount());
        $data->addChild('currency_code', $this->getCurrency());
        $data->addChild('success_url', str_replace('&', '&amp;', $this->getReturnUrl()));
        $data->addChild('abort_url', str_replace('&', '&amp;', $this->getCancelUrl()));

        $reasons = $data->addChild('reasons');
        $reasons->addChild('reason', $this->getDescription());

        $su = $data->addChild('su');
        $su->addChild('customer_protection', 1);

        return $data;
    }

    protected function createResponse($response)
    {
        return $this->response = new AuthorizeResponse($this, $response);
    }
}
