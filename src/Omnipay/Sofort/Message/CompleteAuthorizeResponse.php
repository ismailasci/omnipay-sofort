<?php

namespace Omnipay\Sofort\Message;

use Omnipay\Common\Message\RedirectResponseInterface;

class CompleteAuthorizeResponse extends AbstractResponse implements RedirectResponseInterface
{
    /**
     * Is the response successful?
     *
     * @return boolean
     */
    public function isSuccessful()
    {
        return isset($this->data->transaction_details) &&
            false === in_array($this->data->transaction_details->status, array('pending', 'loss', 'refunded'));
    }


    /**
     * Is the payment pending?
     *
     * @return boolean
     */
    public function isPending()
    {
        return isset($this->data->transaction_details) &&
            $this->data->transaction_details->status == 'pending';
    }


    /**
     * Returns the transaction ID
     *
     * @return string
     */
    public function getTransactionId()
    {
        return $this->getRequest()->getTransactionId();
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
