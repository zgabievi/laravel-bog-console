<?php

namespace Zorb\BOGConsole;

use Zorb\BOGConsole\Enums\OrderDirection;
use Zorb\BOGConsole\Contracts\BOGConsole as BOGConsoleContract;

class BOGConsole
{
    /**
     * @var BOGConsoleContract
     */
    protected $client;

    /**
     * @var string
     */
    protected $identifier = null;

    /**
     * @var string
     */
    protected $password = null;

    /**
     * @var string
     */
    protected $new_password;

    /**
     * @var string
     */
    protected $session_id;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var int
     */
    protected $from;

    /**
     * @var int
     */
    protected $to;

    /**
     * @var string
     */
    protected $merchant_id;

    /**
     * @var string
     */
    protected $scale;

    /**
     * @var string
     */
    protected $status;

    /**
     * @var string
     */
    protected $rrn;

    /**
     * @var string
     */
    protected $pan;

    /**
     * @var string
     */
    protected $src_type;

    /**
     * @var string
     */
    protected $src;

    /**
     * @var string
     */
    protected $dst;

    /**
     * @var string
     */
    protected $currency;

    /**
     * @var string
     */
    protected $token;

    /**
     * @var string
     */
    protected $merchant_trx;

    /**
     * @var string
     */
    protected $src_id;

    /**
     * @var bool
     */
    protected $recurrent = false;

    /**
     * @var bool
     */
    protected $src_added_to_profile = false;

    /**
     * @var bool
     */
    protected $registered_src = false;

    /**
     * @var int
     */
    protected $offset = 0;

    /**
     * @var int
     */
    protected $limit = 10;

    /**
     * @var OrderDirection
     */
    protected $order_dir = OrderDirection::Descending;

    /**
     * @var int
     */
    protected $amount;

    /**
     * @var string
     */
    protected $comment;

    /**
     * @var string
     */
    protected $card_id;

    /**
     * BOGConsole constructor.
     * @param BOGConsoleContract $client
     */
    public function __construct(BOGConsoleContract $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $identifier
     * @return $this
     */
    public function setIdentifier(string $identifier): self
    {
        $this->identifier = $identifier;
        return $this;
    }

    /**
     * @param string $password
     * @return $this
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @param string $password
     * @return $this
     */
    public function setNewPassword(string $password): self
    {
        $this->new_password = $password;
        return $this;
    }

    /**
     * @param string $session_id
     * @return $this
     */
    public function setSessionId(string $session_id): self
    {
        $this->session_id = $session_id;
        return $this;
    }

    /**
     * @param string $type
     * @return $this
     */
    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @param int $timestamp
     * @return $this
     */
    public function setFrom(int $timestamp): self
    {
        $this->from = $timestamp;
        return $this;
    }

    /**
     * @param int $timestamp
     * @return $this
     */
    public function setTo(int $timestamp): self
    {
        $this->to = $timestamp;
        return $this;
    }

    /**
     * @param string $id
     * @return $this
     */
    public function setMerchantId(string $id): self
    {
        $this->merchant_id = $id;
        return $this;
    }

    /**
     * @param string $scale
     * @return $this
     */
    public function setScale(string $scale): self
    {
        $this->scale = $scale;
        return $this;
    }

    /**
     * @param string $status
     * @return $this
     */
    public function setStatus(string $status): self
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @param string $rrn
     * @return $this
     */
    public function setRRN(string $rrn): self
    {
        $this->rrn = $rrn;
        return $this;
    }

    /**
     * @param string $pan
     * @return $this
     */
    public function setPAN(string $pan): self
    {
        $this->pan = $pan;
        return $this;
    }

    /**
     * @param string $type
     * @return $this
     */
    public function setSourceType(string $type): self
    {
        $this->src_type = $type;
        return $this;
    }

    /**
     * @param string $source
     * @return $this
     */
    public function setSource(string $source): self
    {
        $this->src = $source;
        return $this;
    }

    /**
     * @param string $dist
     * @return $this
     */
    public function setDestination(string $dist): self
    {
        $this->dst = $dist;
        return $this;
    }

    /**
     * @param string $currency
     * @return $this
     */
    public function setCurrency(string $currency): self
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     * @param string $token
     * @return $this
     */
    public function setToken(string $token): self
    {
        $this->token = $token;
        return $this;
    }

    /**
     * @param string $trx
     * @return $this
     */
    public function setMerchantTransaction(string $trx): self
    {
        $this->merchant_trx = $trx;
        return $this;
    }

    /**
     * @param string $id
     * @return $this
     */
    public function setSourceId(string $id): self
    {
        $this->src_id = $id;
        return $this;
    }

    /**
     * @param bool $recurrent
     * @return $this
     */
    public function setRecurrent(bool $recurrent = true): self
    {
        $this->recurrent = $recurrent;
        return $this;
    }

    /**
     * @param bool $added
     * @return $this
     */
    public function setSourceAddedToProfile(bool $added = true): self
    {
        $this->src_added_to_profile = $added;
        return $this;
    }

    /**
     * @param bool $registered
     * @return $this
     */
    public function setRegisteredSource(bool $registered = true): self
    {
        $this->registered_src = $registered;
        return $this;
    }

    /**
     * @param int $offset
     * @return $this
     */
    public function setOffset(int $offset = 0): self
    {
        $this->offset = $offset;
        return $this;
    }

    /**
     * @param int $limit
     * @return $this
     */
    public function setLimit(int $limit = 10): self
    {
        $this->limit = $limit;
        return $this;
    }

    /**
     * @param string $dir
     * @return $this
     */
    public function setOrderDirection(string $dir = OrderDirection::Descending): self
    {
        $this->order_dir = $dir;
        return $this;
    }

    /**
     * @param int $amount
     * @return $this
     */
    public function setAmount(int $amount): self
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @param string $comment
     * @return $this
     */
    public function setComment(string $comment): self
    {
        $this->comment = $comment;
        return $this;
    }

    /**
     * @param string $card_id
     * @return $this
     */
    public function setCardId(string $card_id): self
    {
        $this->card_id = $card_id;
        return $this;
    }

    /**
     * 3.1 Session opening
     *
     * @param string|null $username
     * @param string|null $password
     * @return \stdClass|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \JsonException
     */
    public function startSession(string $username = null, string $password = null): ?\stdClass
    {
        return $this->client->startSession(
            $username ?: $this->identifier,
            $password ?: $this->password,
        );
    }

    /**
     * 3.2 Session termination
     *
     * @return \stdClass|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \JsonException
     */
    public function finishSession(): ?\stdClass
    {
        return $this->client->finishSession();
    }

    /**
     * 3.2 Session termination
     *
     * @return \stdClass|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \JsonException
     */
    public function endSession(): ?\stdClass
    {
        return $this->client->finishSession();
    }

    /**
     * 3.2 Session termination
     *
     * @return \stdClass|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \JsonException
     */
    public function terminateSession(): ?\stdClass
    {
        return $this->client->finishSession();
    }

    /**
     * 3.3 Opening a session with a new password
     *
     * @param string|null $username
     * @param string|null $password
     * @param string|null $new_password
     * @return \stdClass|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \JsonException
     */
    public function startSessionWithChangePassword(string $username = null, string $password = null, string $new_password = null): ?\stdClass
    {
        return $this->client->startSessionWithChangePassword(
            $username ?: $this->identifier,
            $password ?: $this->password,
            $new_password ?: $this->new_password,
        );
    }

    /**
     * 3.4 Session extension
     * The session has a short lifetime. However, each time a request is sent to the server the session in which the request is sent shall be extended.
     *
     * @return \stdClass|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \JsonException
     */
    public function extendSession(): ?\stdClass
    {
        return $this->client->extendSession();
    }

    /**
     * 3.4 Session extension
     * The session has a short lifetime. However, each time a request is sent to the server the session in which the request is sent shall be extended.
     *
     * @return \stdClass|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \JsonException
     */
    public function keepSessionAlive(): ?\stdClass
    {
        return $this->client->extendSession();
    }

    /**
     * 3.5 Password change
     *
     * @param string|null $password
     * @param string|null $new_password
     * @return \stdClass|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \JsonException
     */
    public function changePassword(string $password = null, string $new_password = null): ?\stdClass
    {
        return $this->client->changePassword(
            $password ?: $this->password,
            $new_password ?: $this->new_password,
        );
    }

    /**
     * 4.1 Obtaining the information on turnover for the period
     *
     * @param string|null $type
     * @param string|null $from
     * @param string|null $to
     * @param string|null $merchant_id
     * @return \stdClass|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \JsonException
     */
    public function statisticsSummary(string $type = null, string $from = null, string $to = null, string $merchant_id = null): ?\stdClass
    {
        return $this->client->statisticsSummary(
            $type ?: $this->type,
            $from ?: $this->from,
            $to ?: $this->to,
            $merchant_id ?: $this->merchant_id,
        );
    }

    /**
     * 4.2 Obtaining data for charts
     *
     * @param string|null $scale
     * @param string|null $type
     * @param string|null $status
     * @param string|null $from
     * @param string|null $to
     * @param string|null $merchant_id
     * @return \stdClass|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \JsonException
     */
    public function amountStatistics(string $scale = null, string $type = null, string $status = null, string $from = null, string $to = null, string $merchant_id = null): ?\stdClass
    {
        return $this->client->amountStatistics(
            $type ?: $this->type,
            $scale ?: $this->scale,
            $status ?: $this->status,
            $from ?: $this->from,
            $to ?: $this->to,
            $merchant_id ?: $this->merchant_id,
        );
    }

    /**
     * 4.2 Obtaining data for charts
     *
     * @param string|null $scale
     * @param string|null $type
     * @param string|null $status
     * @param string|null $from
     * @param string|null $to
     * @param string|null $merchant_id
     * @return \stdClass|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \JsonException
     */
    public function commissionStatistics(string $scale = null, string $type = null, string $status = null, string $from = null, string $to = null, string $merchant_id = null): ?\stdClass
    {
        return $this->client->commissionStatistics(
            $type ?: $this->type,
            $scale ?: $this->scale,
            $status ?: $this->status,
            $from ?: $this->from,
            $to ?: $this->to,
            $merchant_id ?: $this->merchant_id,
        );
    }

    /**
     * 4.2 Obtaining data for charts
     *
     * @param string|null $scale
     * @param string|null $type
     * @param string|null $status
     * @param string|null $from
     * @param string|null $to
     * @param string|null $merchant_id
     * @return \stdClass|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \JsonException
     */
    public function transactionStatistics(string $scale = null, string $type = null, string $status = null, string $from = null, string $to = null, string $merchant_id = null): ?\stdClass
    {
        return $this->client->transactionStatistics(
            $type ?: $this->type,
            $scale ?: $this->scale,
            $status ?: $this->status,
            $from ?: $this->from,
            $to ?: $this->to,
            $merchant_id ?: $this->merchant_id,
        );
    }

    /**
     * 4.2 Obtaining data for charts
     *
     * @param string|null $scale
     * @param string|null $type
     * @param string|null $status
     * @param string|null $from
     * @param string|null $to
     * @param string|null $merchant_id
     * @return \stdClass|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \JsonException
     */
    public function fullStatistics(string $scale = null, string $type = null, string $status = null, string $from = null, string $to = null, string $merchant_id = null): ?\stdClass
    {
        return $this->client->fullStatistics(
            $type ?: $this->type,
            $scale ?: $this->scale,
            $status ?: $this->status,
            $from ?: $this->from,
            $to ?: $this->to,
            $merchant_id ?: $this->merchant_id,
        );
    }

    /**
     * 5.1 Obtaining the number of transactions
     *
     * @param string|null $type
     * @param string|null $status
     * @param string|null $from
     * @param string|null $to
     * @param string|null $rrn
     * @param string|null $src_type
     * @param string|null $src
     * @param string|null $dist
     * @param string|null $currency
     * @param string|null $token
     * @param string|null $merchant_id
     * @param string|null $merchant_trx
     * @param string|null $src_id
     * @param bool|null $recurrent
     * @param bool|null $src_added_to_profile
     * @param bool|null $registered_src
     * @return \stdClass|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \JsonException
     */
    public function transactionHistoryCount(string $type = null, string $status = null, string $from = null, string $to = null, string $rrn = null, string $src_type = null, string $src = null, string $dist = null, string $currency = null, string $token = null, string $merchant_id = null, string $merchant_trx = null, string $src_id = null, bool $recurrent = null, bool $src_added_to_profile = null, bool $registered_src = null): ?\stdClass
    {
        return $this->client->transactionHistoryCount(
            $type ?: $this->type,
            $status ?: $this->status,
            $from ?: $this->from,
            $to ?: $this->to,
            $rrn ?: $this->rrn,
            $src_type ?: $this->src_type,
            $src ?: $this->src,
            $dist ?: $this->dst,
            $currency ?: $this->currency,
            $token ?: $this->token,
            $merchant_id ?: $this->merchant_id,
            $merchant_trx ?: $this->merchant_trx,
            $src_id ?: $this->src_id,
            $recurrent ?: $this->recurrent,
            $src_added_to_profile ?: $this->src_added_to_profile,
            $registered_src ?: $this->registered_src,
        );
    }

    /**
     * 5.2 Obtaining the list of transactions
     *
     * @param string|null $type
     * @param string|null $status
     * @param string|null $from
     * @param string|null $to
     * @param string|null $rrn
     * @param string|null $src_type
     * @param string|null $src
     * @param string|null $dist
     * @param string|null $currency
     * @param string|null $token
     * @param string|null $merchant_id
     * @param string|null $merchant_trx
     * @param string|null $src_id
     * @param bool|null $recurrent
     * @param bool|null $src_added_to_profile
     * @param bool|null $registered_src
     * @param int|null $offset
     * @param int|null $limit
     * @param string|null $order_dir
     * @return \stdClass|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \JsonException
     */
    public function transactionHistory(string $type = null, string $status = null, string $from = null, string $to = null, string $rrn = null, string $src_type = null, string $src = null, string $dist = null, string $currency = null, string $token = null, string $merchant_id = null, string $merchant_trx = null, string $src_id = null, bool $recurrent = null, bool $src_added_to_profile = null, bool $registered_src = null, int $offset = null, int $limit = null, string $order_dir = null): ?\stdClass
    {
        return $this->client->transactionHistory(
            $type ?: $this->type,
            $status ?: $this->status,
            $from ?: $this->from,
            $to ?: $this->to,
            $rrn ?: $this->rrn,
            $src_type ?: $this->src_type,
            $src ?: $this->src,
            $dist ?: $this->dst,
            $currency ?: $this->currency,
            $token ?: $this->token,
            $merchant_id ?: $this->merchant_id,
            $merchant_trx ?: $this->merchant_trx,
            $src_id ?: $this->src_id,
            $recurrent ?: $this->recurrent,
            $src_added_to_profile ?: $this->src_added_to_profile,
            $registered_src ?: $this->registered_src,
            $offset ?: $this->offset,
            $limit ?: $this->limit,
            $order_dir ?: $this->order_dir,
        );
    }

    /**
     * 5.3 Obtaining the information about a single transaction
     *
     * @param string|null $token
     * @return \stdClass
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \JsonException
     */
    public function transactionDetails(string $token = null): \stdClass
    {
        return $this->client->transactionDetails(
            $token ?: $this->token,
        );
    }

    /**
     * 6 Completion of authorization
     *
     * @param string|null $token
     * @param int|null $amount
     * @param string|null $currency
     * @return \stdClass|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \JsonException
     */
    public function completePreAuth(string $token = null, int $amount = null, string $currency = null): ?\stdClass
    {
        return $this->client->completePreAuth(
            $token ?: $this->token,
            $amount ?: $this->amount,
            $currency ?: $this->currency,
        );
    }

    /**
     * 6 Completion of authorization
     *
     * @param string|null $token
     * @param int|null $amount
     * @param string|null $currency
     * @return \stdClass|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \JsonException
     */
    public function finishPreAuth(string $token = null, int $amount = null, string $currency = null): ?\stdClass
    {
        return $this->client->completePreAuth(
            $token ?: $this->token,
            $amount ?: $this->amount,
            $currency ?: $this->currency,
        );
    }

    /**
     * 7 Money refund
     *
     * @param string|null $token
     * @param int|null $amount
     * @param string|null $currency
     * @param string|null $comment
     * @return mixed
     */
    public function refund(string $token = null, int $amount = null, string $currency = null, string $comment = null)
    {
        return $this->client->refund(
            $token ?: $this->token,
            $amount ?: $this->amount,
            $currency ?: $this->currency,
            $comment ?: $this->comment,
        );
    }

    /**
     * 8.1 Obtaining the size of the card verification list
     *
     * @param string|null $status
     * @param string|null $from
     * @param string|null $to
     * @param string|null $pan
     * @param string|null $token
     * @param string|null $merchant_id
     * @param string|null $merchant_trx
     * @param string|null $card_id
     * @return \stdClass
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \JsonException
     */
    public function cardVerificationCount(string $status = null, string $from = null, string $to = null, string $pan = null, string $token = null, string $merchant_id = null, string $merchant_trx = null, string $card_id = null): \stdClass
    {
        return $this->client->cardVerificationCount(
            $status ?: $this->status,
            $from ?: $this->from,
            $to ?: $this->to,
            $pan ?: $this->pan,
            $token ?: $this->token,
            $merchant_id ?: $this->merchant_id,
            $merchant_trx ?: $this->merchant_trx,
            $card_id ?: $this->card_id,
        );
    }

    /**
     * 8.2 Obtaining the card verification list
     *
     * @param string|null $status
     * @param string|null $from
     * @param string|null $to
     * @param string|null $pan
     * @param string|null $token
     * @param string|null $merchant_id
     * @param string|null $merchant_trx
     * @param string|null $card_id
     * @param int|null $offset
     * @param int|null $limit
     * @param string|null $order_dir
     * @return \stdClass
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \JsonException
     */
    public function cardVerificationHistory(string $status = null, string $from = null, string $to = null, string $pan = null, string $token = null, string $merchant_id = null, string $merchant_trx = null, string $card_id = null, int $offset = null, int $limit = null, string $order_dir = null): \stdClass
    {
        return $this->client->cardVerificationHistory(
            $status ?: $this->status,
            $from ?: $this->from,
            $to ?: $this->to,
            $pan ?: $this->pan,
            $token ?: $this->token,
            $merchant_id ?: $this->merchant_id,
            $merchant_trx ?: $this->merchant_trx,
            $card_id ?: $this->card_id,
            $offset ?: $this->offset,
            $limit ?: $this->limit,
            $order_dir ?: $this->order_dir,
        );
    }

    /**
     * 8.3 Obtaining the information about a single card verification operation
     *
     * @param string|null $token
     * @return \stdClass
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \JsonException
     */
    public function cardVerificationDetails(string $token = null): \stdClass
    {
        return $this->client->cardVerificationDetails(
            $token ?: $this->token,
        );
    }

    /**
     * 9.1 Obtaining the size of the card registration list
     *
     * @param string|null $status
     * @param string|null $from
     * @param string|null $to
     * @param string|null $pan
     * @param string|null $token
     * @param string|null $merchant_id
     * @param string|null $merchant_trx
     * @param string|null $card_id
     * @return \stdClass
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \JsonException
     */
    public function cardRegistrationCount(string $status = null, string $from = null, string $to = null, string $pan = null, string $token = null, string $merchant_id = null, string $merchant_trx = null, string $card_id = null): \stdClass
    {
        return $this->client->cardRegistrationCount(
            $status ?: $this->status,
            $from ?: $this->from,
            $to ?: $this->to,
            $pan ?: $this->pan,
            $token ?: $this->token,
            $merchant_id ?: $this->merchant_id,
            $merchant_trx ?: $this->merchant_trx,
            $card_id ?: $this->card_id,
        );
    }

    /**
     * 9.2 Obtaining the card registration list
     *
     * @param string|null $status
     * @param string|null $from
     * @param string|null $to
     * @param string|null $pan
     * @param string|null $token
     * @param string|null $merchant_id
     * @param string|null $merchant_trx
     * @param string|null $card_id
     * @param int|null $offset
     * @param int|null $limit
     * @param string|null $order_dir
     * @return \stdClass
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \JsonException
     */
    public function cardRegistrationHistory(string $status = null, string $from = null, string $to = null, string $pan = null, string $token = null, string $merchant_id = null, string $merchant_trx = null, string $card_id = null, int $offset = null, int $limit = null, string $order_dir = null): \stdClass
    {
        return $this->client->cardRegistrationHistory(
            $status ?: $this->status,
            $from ?: $this->from,
            $to ?: $this->to,
            $pan ?: $this->pan,
            $token ?: $this->token,
            $merchant_id ?: $this->merchant_id,
            $merchant_trx ?: $this->merchant_trx,
            $card_id ?: $this->card_id,
            $offset ?: $this->offset,
            $limit ?: $this->limit,
            $order_dir ?: $this->order_dir,
        );
    }

    /**
     * 9.3 Obtaining the information about a single card registration operation
     *
     * @param string|null $token
     * @return \stdClass
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \JsonException
     */
    public function cardRegistrationDetails(string $token = null): \stdClass
    {
        return $this->client->cardRegistrationDetails(
            $token ?: $this->token,
        );
    }

    /**
     * 10.1 Obtaining the information about a single card
     *
     * @param string|null $card_id
     * @return \stdClass
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \JsonException
     */
    public function cardDetails(string $card_id = null): \stdClass
    {
        return $this->client->cardDetails(
            $card_id ?: $this->card_id,
        );
    }

    /**
     * 10.2 Obtaining the size of the card list
     *
     * @param string|null $from
     * @param string|null $to
     * @param string|null $pan
     * @param string|null $merchant_id
     * @param string|null $status
     * @return \stdClass
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \JsonException
     */
    public function cardCount(string $from = null, string $to = null, string $pan = null, string $merchant_id = null, string $status = null): \stdClass
    {
        return $this->client->cardCount(
            $from ?: $this->from,
            $to ?: $this->to,
            $pan ?: $this->pan,
            $merchant_id ?: $this->merchant_id,
            $status ?: $this->status,
        );
    }

    /**
     * 10.3 Obtaining the card list
     *
     * @param string|null $from
     * @param string|null $to
     * @param string|null $pan
     * @param string|null $merchant_id
     * @param string|null $status
     * @param int|null $offset
     * @param int|null $limit
     * @param string|null $order_dir
     * @return \stdClass
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \JsonException
     */
    public function cardHistory(string $from = null, string $to = null, string $pan = null, string $merchant_id = null, string $status = null, int $offset = null, int $limit = null, string $order_dir = null): \stdClass
    {
        return $this->client->cardHistory(
            $from ?: $this->from,
            $to ?: $this->to,
            $pan ?: $this->pan,
            $merchant_id ?: $this->merchant_id,
            $status ?: $this->status,
            $offset ?: $this->offset,
            $limit ?: $this->limit,
            $order_dir ?: $this->order_dir,
        );
    }

    /**
     * 10.4 Card deactivation
     *
     * @param string|null $card_id
     * @return \stdClass|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \JsonException
     */
    public function deleteCard(string $card_id = null): ?\stdClass
    {
        return $this->client->deleteCard(
            $card_id ?: $this->card_id,
        );
    }
}
