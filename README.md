SOFORT Überweisung Omnipay gateway
==============

[![Build Status](https://travis-ci.org/ismailasci/omnipay-sofort.png?branch=master)](https://travis-ci.org/ismailasci/omnipay-sofort)
[![Latest Stable Version](https://poser.pugx.org/asci/omnipay-sofort/v/stable.png)](https://packagist.org/packages/asci/omnipay-sofort)
[![Total Downloads](https://poser.pugx.org/asci/omnipay-sofort/downloads.png)](https://packagist.org/packages/asci/omnipay-sofort)


[SOFORT Überweisung](https://www.sofort.com/eng-INT/) gateway for awesome [Omnipay](https://github.com/adrianmacneil/omnipay) library.

**Important Note: Omnipay 1.x Users**

If you are using Omnipay 1.x versions please use [1.x](https://github.com/ismailasci/omnipay-sofort/tree/1.x) tree.
For detailed information you can check Omnipay's 2.0 [release notes](https://github.com/omnipay/omnipay/releases/tag/v2.0.0).

#### API Notes

This gateway only provides 2 methods to place a successful transaction. The first one is `authorize` which initializes an authorization and returns a redirect url. 

The second one is `completeAuthorize`. This method doesn't actually complete anything. Since SOFORT Überweisung doesn't have a `capture` functionality, the only way to know about a transaction is checking that transaction details. According to official docs, if there is no any successful or failed transactions, the API will return empty `transactions` XML object.

#### Installation

To install, simply add it to your composer.json file:

```json
{
    "require": {
        "asci/omnipay-sofort": "~2.0"
    }
}
```

and run `composer update`

#### Usage

For general usage instructions, please see the main [Omnipay](https://github.com/omnipay/omnipay) repository.

**1. Authorize**

```php
$gateway = Omnipay::create('Sofort');
$gateway->initialize(array(
    'username' => 'your_account_id',
    'password' => 'password',
    'projectId' => 'sofort_project_id',
    'testMode' => true
));

$response = $gateway->authorize(array(
    'amount' => 199.00,
    'description' => 'Google Nexus 4',
))->send();

$transactionReference = $response->getTransactionReference();

if ($response->isRedirect()) {
    // redirect to offsite payment gateway
    $response->redirect();
} else {
    // payment failed: display message to customer
    echo $response->getMessage();
}

```

**2. Complete Authorize**

```php
$gateway = Omnipay::create('Sofort');
$gateway->initialize(array(
    'username' => 'your_account_id',
    'password' => 'password',
    'projectId' => 'sofort_project_id',
    'testMode' => true
));

$response = $gateway->completeAuthorize(array(
    'transactionId' => $transactionReference,
))->send();

if ($response->isSuccessful()) {
    // payment was successful
    print_r($response);
} else {
    // payment failed: display message to customer
    echo $response->getMessage();
}

```
