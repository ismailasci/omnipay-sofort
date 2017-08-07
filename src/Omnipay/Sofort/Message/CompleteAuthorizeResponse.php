<?php

namespace Omnipay\Sofort\Message;

use Omnipay\Common\Message\RedirectResponseInterface;

class CompleteAuthorizeResponse extends AbstractResponse implements RedirectResponseInterface
{
    public function isSuccessful()
    {
        return isset($this->data->transaction_details) &&
            false === in_array($this->data->transaction_details->status, array('loss', 'refunded'));
    }


    /**
     * Gateway Reference
     * 
     * @return null|string A reference provided by the gateway to represent this transaction
     */
    public function getTransactionReference()
    {
        return $this->getRequest()->getTransactionReference();
    }
}
