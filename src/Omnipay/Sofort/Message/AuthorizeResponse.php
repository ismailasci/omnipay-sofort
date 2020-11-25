<?php

namespace Omnipay\Sofort\Message;

use Omnipay\Common\Message\RedirectResponseInterface;

class AuthorizeResponse extends AbstractResponse implements RedirectResponseInterface
{
    public function isSuccessful()
    {
        return isset($this->data->transaction) && !isset($this->data->payment_url);
    }

    public function isRedirect()
    {
        return isset($this->data->transaction) && isset($this->data->payment_url) && !isset($this->data->errors);
    }

    public function getRedirectUrl()
    {
        return (string) $this->data->payment_url;
    }

    public function getTransactionReference()
    {
        return (string) $this->data->transaction;
    }

    public function getMessage()
    {
        if (false === $this->isRedirect()) {
            $message = '';

            foreach ($this->data->error as $error) {
                $message .= $error->code . ': ' . $error->message . ' ';
            }

            return $message;
        }

        return null;
    }
}
