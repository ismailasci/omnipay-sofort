<?php

namespace Omnipay\Sofort;

use Omnipay\Common\AbstractGateway;

class Gateway extends AbstractGateway
{
    public function getName()
    {
        return 'Sofort';
    }

    public function getDefaultParameters()
    {
        return array(
            'username' => '',
            'password' => '',
            'projectId' => '',
            'protection' => true,
            'testMode' => false,
        );
    }

    public function getUsername()
    {
        return $this->getParameter('username');
    }

    public function setUsername($value)
    {
        return $this->setParameter('username', $value);
    }

    public function getPassword()
    {
        return $this->getParameter('password');
    }

    public function setPassword($value)
    {
        return $this->setParameter('password', $value);
    }

    public function getProjectId()
    {
        return $this->getParameter('projectId');
    }

    public function setProjectId($value)
    {
        return $this->setParameter('projectId', $value);
    }

    public function getCountry()
    {
        return $this->getParameter('country');
    }

    public function setCountry($value)
    {
        return $this->setParameter('country', $value);
    }

    public function getProtection()
    {
        return $this->getParameter('protection');
    }

    public function setProtection($value)
    {
        return $this->setParameter('protection', $value);
    }

    public function authorize(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Sofort\Message\AuthorizeRequest', $parameters);
    }

    public function completeAuthorize(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Sofort\Message\CompleteAuthorizeRequest', $parameters);
    }

    public function purchase(array $parameters = array())
    {
        return $this->authorize($parameters);
    }

    public function refund(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Sofort\Message\RefundRequest', $parameters);
    }
}
