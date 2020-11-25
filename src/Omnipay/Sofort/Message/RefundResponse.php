<?php

declare(strict_types=1);

namespace Omnipay\Sofort\Message;

class RefundResponse extends AbstractResponse
{
    public function isSuccessful()
    {
        return isset($this->data->refund->status) &&
            false === in_array($this->data->refund->status, array('error'));
    }

    public function getTransactionReference()
    {
        return (string) $this->data->refund->transaction;
    }
}
