# Bank of Georgia Merchant Console OpenAPI Helper

[![Packagist](https://img.shields.io/packagist/v/zgabievi/laravel-bog-console.svg)](https://packagist.org/packages/zgabievi/laravel-bog-console)
[![Packagist](https://img.shields.io/packagist/dt/zgabievi/laravel-bog-console.svg)](https://packagist.org/packages/zgabievi/laravel-bog-console)
[![license](https://img.shields.io/github/license/zgabievi/laravel-bog-console.svg)](https://packagist.org/packages/zgabievi/laravel-bog-console)

<img src="https://raw.githubusercontent.com/zgabievi/laravel-bog-console/main/assets/bog-console.jpg" alt="Laravel BOG Console" />

## Table of Contents

- [Installation](#installation)
- [Usage](#usage)
- [ENV Variables](#environment-variables)
- [License](#license)

## Installation

To get started, you need to install package:

```shell script
composer require zgabievi/laravel-bog-console
```

If your Laravel version is older than **5.5**, then add this to your service providers in *config/app.php*:

```php
'providers' => [
    ...
    Zorb\BOGConsole\BOGConsoleServiceProvider::class,
    ...
];
```

You can publish config file using this command:

```shell script
php artisan vendor:publish --provider="Zorb\BOGConsole\BOGConsoleServiceProvider"
```

This command will copy config file for you.

## Usage

> All of the responses are *stdClasses*.
> Errors are handled by laravel **abort** helper.
> Catch exceptions on your own, if you want to handle them.

**Here are methods provided by this package:**

- [Session](#session)
    - [Session opening](#session-opening)]
    - [Session termination](#session-termination)
    - [Opening a session with a new password](#opening-a-session-with-a-new-password)
    - [Session extension](#session-extension)
    - [Password change](#password-change)
- [Desktop](#dekstop)
    - [Obtaining the information on turnover for the period](#obtaining-the-information-on-turnover-for-the-period)
    - [Obtaining data for charts](#obtaining-data-for-charts)
- [Obtaining transaction data](#obtaining-transaction-data)
    - [Obtaining the number of transactions](#obtaining-the-number-of-transactions)
    - [Obtaining the list of transactions](#obtaining-the-list-of-transactions)
    - [Obtaining the information about a single transaction](#obtaining-the-information-about-a-single-transaction)
- [Completion of authorization](#completion-of-authorization)
- [Money refund](#money-refund)
- [Card verification history](#card-verification-history)
    - [Obtaining the size of the card verification list](#obtaining-the-size-of-the-card-verification-list)
    - [Obtaining the card verification list](#obtaining-the-card-verification-list)
    - [Obtaining the information about a single card verification operation](#obtaining-the-information-about-a-single-card-verification-operation)
- [Card registration history](#card-registration-history)
    - [Obtaining the size of the card registration list](#obtaining-the-size-of-the-card-registration-list)
    - [Obtaining the card registration list](#obtaining-the-card-registration-list)
    - [Obtaining the information about a single card registration operation](#obtaining-the-information-about-a-single-card-registration-operation)
- [Payment cards](#payment-cards)
    - [Obtaining the information about a single card](#obtaining-the-information-about-a-single-card)
    - [Obtaining the size of the card list](#obtaining-the-size-of-the-card-list)
    - [Obtaining the card list](#obtaining-the-card-list)
    - [Card deactivation](#card-deactivation)

### Session

All requests related to the merchant console shall be made only by authorized users. To be authorized the operator shall
enter a username and a password. The service checks the password validity and opens the session. Then all requests shall
be sent within this session.

The merchant operator profile is created in the administrative console of the Service.

The requests to the Service can be sent by the merchant operator using the merchant console. Or by an external system on
behalf of the merchant operator. The format of the requests and the rules for their processing are the same.

#### Session opening

```php
use Zorb\BOGConsole\Facades\BOGConsole;

class FakeController
{
    public function __invoke()
    {
        $response = BOGConsole::setIdentifier('API_USERNAME') // optional - will be used from env
            ->setPassword('API_PASSWORD') // optional - will be used from env
            ->startSession();
    }
}
```

Example `$response:`

```json
{
    "sessionId": "769B189AB989D1A77153522F5D869049"
}
```

#### Session termination

```php
use Zorb\BOGConsole\Facades\BOGConsole;

class FakeController
{
    public function __invoke()
    {
        $response = BOGConsole::finishSession();
        
        // or
        
        $response = BOGConsole::endSession();
        
        // or
        
        $response = BOGConsole::terminateSession();
    }
}
```

If there was no exception, it means the session terminated successfully.

#### Opening a session with a new password

```php
use Zorb\BOGConsole\Facades\BOGConsole;

class FakeController
{
    public function __invoke()
    {
        $response = BOGConsole::setIdentifier('API_USERNAME') // optional - will be used from env
            ->setPassword('CURRENT_API_PASSWORD') // optional - will be used from env
            ->setNewPassword('NEW_PASSWORD') // required
            ->startSessionWithChangePassword();
    }
}
```

Example `$response:`

```json
{
    "sessionId": "769B189AB989D1A77153522F5D869049"
}
```

#### Session extension

```php
use Zorb\BOGConsole\Facades\BOGConsole;

class FakeController
{
    public function __invoke()
    {
        $response = BOGConsole::extendSession();
        
        // or
        
        $response = BOGConsole::keepSessionAlive();
    }
}
```

If there was no exception, it means the session lifetime extended.

#### Password change

```php
use Zorb\BOGConsole\Facades\BOGConsole;

class FakeController
{
    public function __invoke()
    {
        $response = BOGConsole::setPassword('CURRENT_PASSWORD') // optional - will be used from env
            ->setNewPassword('NEW_PASSWORD') // required
            ->changePassword();
    }
}
```

If there was no exception, it means the session lifetime extended.

### Desktop

#### Obtaining the information on turnover for the period

```php
use Zorb\BOGConsole\Facades\BOGConsole;
use Zorb\BOGConsole\Enums\TransactionType;

class FakeController
{
    public function __invoke()
    {
        $response = BOGConsole::setType(TransactionType::CardToCard) // required
            ->setFrom(1581282000000) // optional
            ->setTo(1581886799999) // optional
            ->setMerchantId('KFH828HSH') // optional
            ->statisticsSummary();
    }
}
```

Example `$response:`

```json
{
    "GEL": {
        "sum": 2565000,
        "avg": 2565.0,
        "commission": 0,
        "totalCount": 60,
        "successfulCount": 54
    },
    "USD": {
        "sum": 2565,
        "avg": 256.0,
        "commission": 0,
        "totalCount": 6,
        "successfulCount": 5
    },
    "UNKNOWN": {
        "sum": 0,
        "avg": 0,
        "commission": 0,
        "totalCount": 1,
        "successfulCount": 0
    }
}
```

#### Obtaining data for charts

```php
use Zorb\BOGConsole\Enums\ChartScale;
use Zorb\BOGConsole\Facades\BOGConsole;
use Zorb\BOGConsole\Enums\TransactionType;
use Zorb\BOGConsole\Enums\TransactionStatus;

class FakeController
{
    public function __invoke()
    {
        $amount_response = BOGConsole::setType(TransactionType::CardToCard) // optional
            ->setScale(ChartScale::Week) // required
            ->setStatus(TransactionStatus::Success) // optional
            ->setFrom(1581282000000) // optional
            ->setTo(1581886799999) // optional
            ->setMerchantId('KFH828HSH') // optional
            ->amountStatistics();
            
        $commission_response = BOGConsole::setType(TransactionType::CardToCard) // optional
            ->setScale(ChartScale::Week) // required
            ->setStatus(TransactionStatus::Success) // optional
            ->setFrom(1581282000000) // optional
            ->setTo(1581886799999) // optional
            ->setMerchantId('KFH828HSH') // optional
            ->commissionStatistics();
            
        $transactions_response = BOGConsole::setType(TransactionType::CardToCard) // optional
            ->setScale(ChartScale::Week) // required
            ->setStatus(TransactionStatus::Success) // optional
            ->setFrom(1581282000000) // optional
            ->setTo(1581886799999) // optional
            ->setMerchantId('KFH828HSH') // optional
            ->transactionStatistics();
            
        $full_response = BOGConsole::setType(TransactionType::CardToCard) // optional
            ->setScale(ChartScale::Week) // required
            ->setStatus(TransactionStatus::Success) // optional
            ->setFrom(1581282000000) // optional
            ->setTo(1581886799999) // optional
            ->setMerchantId('KFH828HSH') // optional
            ->fullStatistics();
    }
}
```

Example `$response:`

```json
{
    "GEL": [
        [
            1407452400000,
            13,
            4500,
            45
        ],
        [
            1407538800000,
            21,
            200,
            2
        ],
        [
            1407625200000,
            65,
            12500,
            125
        ],
        [
            1407711600000,
            48,
            344,
            4
        ],
        [
            1407798000000,
            25,
            10000,
            100
        ],
        [
            1407884400000,
            15,
            5000,
            300
        ],
        [
            1407970800000,
            88,
            12000,
            120
        ]
    ],
    "USD": [
        [
            1407538800000,
            2,
            200,
            2
        ],
        [
            1407625200000,
            6,
            200,
            2
        ]
    ]
}
```

### Obtaining transaction data

#### Obtaining the number of transactions

```php
use Zorb\BOGConsole\Enums\SourceType;
use Zorb\BOGConsole\Facades\BOGConsole;
use Zorb\BOGConsole\Enums\TransactionType;
use Zorb\BOGConsole\Enums\TransactionStatus;

class FakeController
{
    public function __invoke()
    {
        $response = BOGConsole::setType(TransactionType::CardToCard) // optional
            ->setStatus(TransactionStatus::Finished) // optional - you can specify multiple comma separated values
            ->setFrom(1581282000000) // optional
            ->setTo(1581886799999) // optional
            ->setRRN('29847529874') // optional
            ->setSourceType(SourceType::ApplePay) // optional - you can specify multiple comma separated values
            ->setSource('421653xxxxxx8430') // optional
            ->setDestination('421653xxxxxx8430') // optional
            ->setCurrency('GEL') // optional
            ->setToken('J2L4J5LKHJ2424LK34J234') // optional
            ->setMerchantId('KFH828HSH') // optional
            ->setMerchantTrx('LKJ24K5LJ356KJ34KLJ45LKJ345LK3') // optional
            ->setSourceId('ASLKDJ245KJ4JK345J4') // optional
            ->setRecurrent() // optional
            ->setSourceAddedToProfile() // optional
            ->setRegisteredSource() // optional
            ->transactionHistoryCount();
    }
}
```

Example `$response:`

```json
{
    "count": 20
}
```

#### Obtaining the list of transactions

```php
use Zorb\BOGConsole\Enums\SourceType;
use Zorb\BOGConsole\Facades\BOGConsole;
use Zorb\BOGConsole\Enums\OrderDirection;
use Zorb\BOGConsole\Enums\TransactionType;
use Zorb\BOGConsole\Enums\TransactionStatus;

class FakeController
{
    public function __invoke()
    {
        $response = BOGConsole::setType(TransactionType::CardToCard) // optional
            ->setStatus(TransactionStatus::Finished) // optional - you can specify multiple comma separated values
            ->setFrom(1581282000000) // optional
            ->setTo(1581886799999) // optional
            ->setRRN('29847529874') // optional
            ->setSourceType(SourceType::ApplePay) // optional - you can specify multiple comma separated values
            ->setSource('421653xxxxxx8430') // optional
            ->setDestination('421653xxxxxx8430') // optional
            ->setCurrency('GEL') // optional
            ->setToken('J2L4J5LKHJ2424LK34J234') // optional
            ->setMerchantId('KFH828HSH') // optional
            ->setMerchantTrx('LKJ24K5LJ356KJ34KLJ45LKJ345LK3') // optional
            ->setSourceId('ASLKDJ245KJ4JK345J4') // optional
            ->setRecurrent() // optional
            ->setSourceAddedToProfile() // optional
            ->setRegisteredSource() // optional
            ->setOffset(5) // optional - 0 by default
            ->setLimit(30) // optional - 10 by default
            ->setOrderDirection(OrderDirection::Ascending) // optional - DESC by default
            ->transactionHistory();
    }
}
```

Example `$response:`

```json
[
    {
        "token": "234234LK234",
        "startedAt": "1415266887057",
        "finishedAt": "1415266887057",
        "type": "CARD_TO_CARD",
        "rrn": 123456789001,
        "approvalCode": "123456",
        "srcType": "card",
        "src": "5454xxxxxxxx5454",
        "dst": "4111xxxxxxxx1111",
        "amount": 49500,
        "commission": 743,
        "fullAmount": 50243,
        "refundAmount": 52500,
        "currency": "GEL",
        "merchantId": "TESTMERCHANT",
        "merchantTrx": "TX-582346237845",
        "status": "SUCCESS",
        "isFullyAuthenticated": true,
        "extendedCode": "OK",
        "refundable": true
    },
    {
        "token": "233NB2323",
        "startedAt": 1415266887057,
        "finishedAt": "1415266887057",
        "type": "CARD_TO_CARD",
        "rrn": "123456789002",
        "approvalCode": "123457",
        "srcType": "card",
        "src": "5454xxxxxxxx5454",
        "dst": "4111xxxxxxxx1111",
        "amount": 132500,
        "commission": 1888,
        "fullAmount": 134488,
        "refundAmount": 0,
        "currency": "GEL",
        "merchantId": "TESTMERCHANT",
        "merchantTrx": "TX-582346237843",
        "status": "SUCCESS",
        "extendedCode": "OK",
        "isFullyAuthenticated": true,
        "refundable": true
    }
]
```

#### Obtaining the information about a single transaction

```php
use Zorb\BOGConsole\Facades\BOGConsole;

class FakeController
{
    public function __invoke()
    {
        $response = BOGConsole::setToken('J2L4J5LKHJ2424LK34J234') // required
            ->transactionDetails();
    }
}
```

Example `$response:`

```json
{
    "token": "34234NNM234234",
    "startedAt": 1415266887057,
    "finishedAt": "1415266887057",
    "type": "CARD_TO_CARD",
    "rrn": "123456789001",
    "approvalCode": "123456",
    "srcType": "card",
    "src": "5454xxxxxxxx5454",
    "dst": "4111xxxxxxxx1111",
    "amount": 49500,
    "commission": 743,
    "fullAmount": 50243,
    "refundAmount": 0,
    "currency": "GEL",
    "merchantId": "TESTMERCHANT",
    "merchantTrx": "TX-582346237843",
    "status": "SUCCESS",
    "isFullyAuthenticated": true,
    "refundable": true,
    "cardholder": "JOHN DOE",
    "params": {
        "order": "12370"
    },
    "description": "Order 12370 - The Martian",
    "refunds": [
        {
            "createdAt": "1415266887057",
            "amount": "2500",
            "msisdn": "79160000001",
            "comment": "Partial refund",
            "status": "PROCESSING"
        }
    ],
    "hasSignature": true,
    "location": {
        "latitude": 12.345678,
        "longitude": -123.456789
    }
}
```

### Completion of authorization

```php
use Zorb\BOGConsole\Facades\BOGConsole;

class FakeController
{
    public function __invoke()
    {
        $response = BOGConsole::setToken('J2L4J5LKHJ2424LK34J234') // required
            ->setAmount(5000) // required
            ->setCurrency('GEL') // required
            ->completePreAuth();
            
        // or
        
        $response = BOGConsole::setToken('J2L4J5LKHJ2424LK34J234') // required
            ->setAmount(5000) // required
            ->setCurrency('GEL') // required
            ->finishPreAuth();
    }
}
```

Example `$response:`

```json
{
    "token": "1234567890ABCDEF",
    "startedAt": "1415266887057",
    "finishedAt": "1415266887057",
    "type": "ACQUIRING",
    "rrn": "123123123",
    "approvalCode": "123434",
    "srcType": "card",
    "src": "5454xxxxxxxx5454",
    "amount": "10000",
    "fullAmount": "10000",
    "currency": "GEL",
    "merchantId": "MERCH1",
    "merchantTrx": "trx-232323",
    "status": "SUCCESS",
    "extendedCode": "OK",
    "responseCode": "00",
    "isFullyAuthenticated": true,
    "orderStatus": "REGISTERED_AT_MERCHANT",
    "orderStatusChangedAt": "1415266887057",
    "refundable": true,
    "params": {
        "order_id": "121212"
    },
    "description": "some payment"
}
```

### Money refund

```php
use Zorb\BOGConsole\Facades\BOGConsole;

class FakeController
{
    public function __invoke()
    {
        $response = BOGConsole::setToken('J2L4J5LKHJ2424LK34J234') // required
            ->setAmount(5000) // required
            ->setCurrency('GEL') // required
            ->setComment('You are getting back your money') // optional
            ->refund();
    }
}
```

Example `$response:`

```json
{
    "status": "SUCCESS",
    "action": "REFUND",
    "rrn": "29847529874"
}
```

### Card verification history

#### Obtaining the size of the card verification list

```php
use Zorb\BOGConsole\Facades\BOGConsole;
use Zorb\BOGConsole\Enums\TransactionStatus;

class FakeController
{
    public function __invoke()
    {
        $response = BOGConsole::setStatus(TransactionStatus::Finished) // optional - you can specify multiple comma separated values
            ->setFrom(1581282000000) // optional
            ->setTo(1581886799999) // optional
            ->setPAN('421653xxxxxx8430') // optional
            ->setToken('J2L4J5LKHJ2424LK34J234') // optional
            ->setMerchantId('KFH828HSH') // optional
            ->setMerchantTrx('LKJ24K5LJ356KJ34KLJ45LKJ345LK3') // optional
            ->setCardId('ASLKDJ245KJ4JK345J4') // optional
            ->cardVerificationCount();
    }
}
```

Example `$response:`

```json
{
    "count": 20
}
```

#### Obtaining the card verification list

```php
use Zorb\BOGConsole\Facades\BOGConsole;
use Zorb\BOGConsole\Enums\OrderDirection;
use Zorb\BOGConsole\Enums\TransactionStatus;

class FakeController
{
    public function __invoke()
    {
        $response = BOGConsole::setStatus(TransactionStatus::Finished) // optional - you can specify multiple comma separated values
            ->setFrom(1581282000000) // optional
            ->setTo(1581886799999) // optional
            ->setPAN('421653xxxxxx8430') // optional
            ->setToken('J2L4J5LKHJ2424LK34J234') // optional
            ->setMerchantId('KFH828HSH') // optional
            ->setMerchantTrx('LKJ24K5LJ356KJ34KLJ45LKJ345LK3') // optional
            ->setCardId('ASLKDJ245KJ4JK345J4') // optional
            ->setOffset(5) // optional - 0 by default
            ->setLimit(30) // optional - 10 by default
            ->setOrderDirection(OrderDirection::Ascending) // optional - DESC by default
            ->cardVerificationHistory();
    }
}
```

Example `$response:`

```json
[
    {
        "token": "234234LK234",
        "startedAt": "1415266887057",
        "finishedAt": "1415266887057",
        "pan": "5454xxxxxxxx5454",
        "merchantId": "TESTMERCHANT",
        "merchantTrx": "TX-582346237845",
        "status": "SUCCESS",
        "extendedCode": "OK",
        "responseCode": "000",
        "isFullyAuthenticated": true,
        "orderStatus": "REGISTERED_AT_MERCHANT",
        "amountReverted": true
    }
]
```

#### Obtaining the information about a single card verification operation

```php
use Zorb\BOGConsole\Facades\BOGConsole;

class FakeController
{
    public function __invoke()
    {
        $response = BOGConsole::setToken('J2L4J5LKHJ2424LK34J234') // required
            ->cardVerificationDetails();
    }
}
```

Example `$response:`

```json
{
    "token": "234234LK234",
    "startedAt": "1415266887057",
    "finishedAt": "1415266887057",
    "pan": "5454xxxxxxxx5454",
    "merchantId": "TESTMERCHANT",
    "merchantTrx": "TX-582346237845",
    "status": "SUCCESS",
    "extendedCode": "OK",
    "responseCode": "000",
    "isFullyAuthenticated": true,
    "orderStatus": "REGISTERED_AT_MERCHANT",
    "amountReverted": true,
    "cardId": "34234NNM234234"
}
```

### Card registration history

#### Obtaining the size of the card registration list

```php
use Zorb\BOGConsole\Facades\BOGConsole;
use Zorb\BOGConsole\Enums\TransactionStatus;

class FakeController
{
    public function __invoke()
    {
        $response = BOGConsole::setStatus(TransactionStatus::Finished) // optional - you can specify multiple comma separated values
            ->setFrom(1581282000000) // optional
            ->setTo(1581886799999) // optional
            ->setPAN('421653xxxxxx8430') // optional
            ->setToken('J2L4J5LKHJ2424LK34J234') // optional
            ->setMerchantId('KFH828HSH') // optional
            ->setMerchantTrx('LKJ24K5LJ356KJ34KLJ45LKJ345LK3') // optional
            ->setCardId('ASLKDJ245KJ4JK345J4') // optional
            ->cardRegistrationCount();
    }
}
```

Example `$response:`

```json
{
    "count": 20
}
```

#### Obtaining the card registration list

```php
use Zorb\BOGConsole\Facades\BOGConsole;
use Zorb\BOGConsole\Enums\OrderDirection;
use Zorb\BOGConsole\Enums\TransactionStatus;

class FakeController
{
    public function __invoke()
    {
        $response = BOGConsole::setStatus(TransactionStatus::Finished) // optional - you can specify multiple comma separated values
            ->setFrom(1581282000000) // optional
            ->setTo(1581886799999) // optional
            ->setPAN('421653xxxxxx8430') // optional
            ->setToken('J2L4J5LKHJ2424LK34J234') // optional
            ->setMerchantId('KFH828HSH') // optional
            ->setMerchantTrx('LKJ24K5LJ356KJ34KLJ45LKJ345LK3') // optional
            ->setCardId('ASLKDJ245KJ4JK345J4') // optional
            ->setOffset(5) // optional - 0 by default
            ->setLimit(30) // optional - 10 by default
            ->setOrderDirection(OrderDirection::Ascending) // optional - DESC by default
            ->cardRegistrationHistory();
    }
}
```

Example `$response:`

```json
[
    {
        "token": "234234LK234",
        "startedAt": "1415266887057",
        "finishedAt": "1415266887057",
        "pan": "5454xxxxxxxx5454",
        "merchantId": "TESTMERCHANT",
        "merchantTrx": "TX-582346237845",
        "status": "SUCCESS",
        "extendedCode": "OK",
        "responseCode": "000",
        "isFullyAuthenticated": true,
        "orderStatus": "REGISTERED_AT_MERCHANT",
        "amountReverted": true
    }
]
```

#### Obtaining the information about a single card registration operation

```php
use Zorb\BOGConsole\Facades\BOGConsole;

class FakeController
{
    public function __invoke()
    {
        $response = BOGConsole::setToken('J2L4J5LKHJ2424LK34J234') // required
            ->cardRegistrationDetails();
    }
}
```

Example `$response:`

```json
{
    "token": "234234LK234",
    "startedAt": "1415266887057",
    "finishedAt": "1415266887057",
    "pan": "5454xxxxxxxx5454",
    "merchantId": "TESTMERCHANT",
    "merchantTrx": "TX-582346237845",
    "status": "SUCCESS",
    "extendedCode": "OK",
    "responseCode": "000",
    "isFullyAuthenticated": true,
    "orderStatus": "REGISTERED_AT_MERCHANT",
    "amountReverted": true,
    "cardId": "34234NNM234234"
}
```

### Payment cards

#### Obtaining the information about a single card

```php
use Zorb\BOGConsole\Facades\BOGConsole;

class FakeController
{
    public function __invoke()
    {
        $response = BOGConsole::setCardId('34234NNM234234') // required
            ->cardDetails();
    }
}
```

Example `$response:`

```json
{
    "id": "34234NNM234234",
    "status": "VERIFIED",
    "brand": "VISA",
    "pan": "4756xxxxxxxx6346",
    "expiry": "1225",
    "cardholder": "James Bond",
    "registeredAt": "1415266887057",
    "merchantId": "TESTMERCHANT"
}
```

#### Obtaining the size of the card list

```php
use Zorb\BOGConsole\Enums\CardStatus;
use Zorb\BOGConsole\Facades\BOGConsole;

class FakeController
{
    public function __invoke()
    {
        $response = BOGConsole::setStatus(CardStatus::Verified) // optional
            ->setFrom(1581282000000) // optional
            ->setTo(1581886799999) // optional
            ->setPAN('421653xxxxxx8430') // optional
            ->setToken('J2L4J5LKHJ2424LK34J234') // optional
            ->setMerchantId('KFH828HSH') // optional
            ->cardCount();
    }
}
```

Example `$response:`

```json
{
    "count": 20
}
```

#### Obtaining the card list

```php
use Zorb\BOGConsole\Enums\CardStatus;
use Zorb\BOGConsole\Facades\BOGConsole;
use Zorb\BOGConsole\Enums\OrderDirection;

class FakeController
{
    public function __invoke()
    {
        $response = BOGConsole::setStatus(CardStatus::Verified) // optional
            ->setFrom(1581282000000) // optional
            ->setTo(1581886799999) // optional
            ->setPAN('421653xxxxxx8430') // optional
            ->setToken('J2L4J5LKHJ2424LK34J234') // optional
            ->setMerchantId('KFH828HSH') // optional
            ->setOffset(5) // optional - 0 by default
            ->setLimit(30) // optional - 10 by default
            ->setOrderDirection(OrderDirection::Ascending) // optional - DESC by default
            ->cardHistory();
    }
}
```

Example `$response:`

```json
[
    {
        "id": "34234NNM234234",
        "status": "VERIFIED",
        "brand": "VISA",
        "pan": "4756xxxxxxxx6346",
        "expiry": "1225",
        "cardholder": "James Bond",
        "registeredAt": "1415266887057",
        "merchantId": "TESTMERCHANT"
    }
]
```

#### Card deactivation

```php
use Zorb\BOGConsole\Facades\BOGConsole;

class FakeController
{
    public function __invoke()
    {
        $response = BOGConsole::setCardId('34234NNM234234') // required
            ->deleteCard();
    }
}
```

If there was no exception, it means the session lifetime extended.

## Environment Variables

| Key | Meaning | Type | Default |
| --- | --- | :---: | --- |
| BOG_CONSOLE_PORTAL_ID | Merchant portal id for requests | string |  |
| BOG_CONSOLE_API_URL | OpenAPI console url | string | https://mpi.gc.ge/open/api/v4/ |
| BOG_CONSOLE_USERNAME | OpenAPI console username | string |  |
| BOG_CONSOLE_PASSWORD | OpenAPI console password | string |  |

## License

[zgabievi/laravel-bog-console](https://github.com/zgabievi/laravel-bog-console) is licensed under
a [MIT License](https://github.com/zgabievi/laravel-bog-console/blob/master/LICENSE).
