<?php

namespace Zorb\BOGConsole\Contracts;

use Request;

class BOGConsole extends Request
{
    /**
     * @var string
     */
    protected $session_id;

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
        return $this->postRequest('session/start', [
            'identifier' => $username ?: config('bog-console.username'),
            'password' => $password ?: config('bog-console.password'),
        ]);
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
        return $this->postRequest('session/start-with-change-password', [
            'identifier' => $username,
            'password' => $password,
            'newPassword' => $new_password,
        ], $this->session_id);
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
        return $this->postRequest('session/finish', [], $this->session_id);
    }

    /**
     * 3.4 Session extension
     *
     * @return \stdClass|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \JsonException
     */
    public function extendSession(): ?\stdClass
    {
        return $this->postRequest('session/keep-alive', [], $this->session_id);
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
        return $this->postRequest('profile/password/change', [
            'password' => $password,
            'newPassword' => $new_password,
        ], $this->session_id);
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
        return $this->getRequest('merchant/statistics/summary', [
            'type' => $type,
            'from' => $from,
            'to' => $to,
            'merchantId' => $merchant_id,
        ], $this->session_id);
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
        return $this->getRequest('merchant/statistics/amount', [
            'type' => $type,
            'scale' => $scale,
            'status' => $status,
            'from' => $from,
            'to' => $to,
            'merchantId' => $merchant_id,
        ], $this->session_id);
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
        return $this->getRequest('merchant/statistics/commission', [
            'type' => $type,
            'scale' => $scale,
            'status' => $status,
            'from' => $from,
            'to' => $to,
            'merchantId' => $merchant_id,
        ], $this->session_id);
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
        return $this->getRequest('merchant/statistics/trx', [
            'type' => $type,
            'scale' => $scale,
            'status' => $status,
            'from' => $from,
            'to' => $to,
            'merchantId' => $merchant_id,
        ], $this->session_id);
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
        return $this->getRequest('merchant/statistics/full', [
            'type' => $type,
            'scale' => $scale,
            'status' => $status,
            'from' => $from,
            'to' => $to,
            'merchantId' => $merchant_id,
        ], $this->session_id);
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
        return $this->getRequest('merchant/history/trx-count', [
            'type' => $type,
            'status' => $status,
            'from' => $from,
            'to' => $to,
            'rrn' => $rrn,
            'srcType' => $src_type,
            'src' => $src,
            'dist' => $dist,
            'currency' => $currency,
            'token' => $token,
            'merchantId' => $merchant_id,
            'merchantTrx' => $merchant_trx,
            'srcId' => $src_id,
            'recurrent' => $recurrent,
            'srcAddedToProfile' => $src_added_to_profile,
            'registeredSrc' => $registered_src,
        ], $this->session_id);
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
        return $this->getRequest('merchant/history/trx', [
            'type' => $type,
            'status' => $status,
            'from' => $from,
            'to' => $to,
            'rrn' => $rrn,
            'srcType' => $src_type,
            'src' => $src,
            'dist' => $dist,
            'currency' => $currency,
            'token' => $token,
            'merchantId' => $merchant_id,
            'merchantTrx' => $merchant_trx,
            'srcId' => $src_id,
            'recurrent' => $recurrent,
            'srcAddedToProfile' => $src_added_to_profile,
            'registeredSrc' => $registered_src,
            'offset' => $offset,
            'limit' => $limit,
            'orderDir' => $order_dir,
        ], $this->session_id);
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
        return $this->getRequest("merchant/history/trx/{$token}", [], $this->session_id);
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
    public function completePreAuth(string $token = null, int $amount = null, string $currency = null): \stdClass
    {
        return $this->postRequest("merchant/history/trx/{$token}/complete", [
            'amount' => $amount,
            'currency' => $currency,
        ], $this->session_id);
    }

    /**
     * 7 Money refund
     *
     * @param string|null $token
     * @param int|null $amount
     * @param string|null $currency
     * @param string|null $comment
     * @return \stdClass|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \JsonException
     */
    public function refund(string $token = null, int $amount = null, string $currency = null, string $comment = null): \stdClass
    {
        return $this->postRequest("merchant/history/trx/{$token}/refund", [
            'amount' => $amount,
            'currency' => $currency,
            'comment' => $comment,
        ], $this->session_id);
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
        return $this->getRequest('merchant/history/card-verification-count', [
            'status' => $status,
            'from' => $from,
            'to' => $to,
            'pan' => $pan,
            'token' => $token,
            'merchantId' => $merchant_id,
            'merchantTrx' => $merchant_trx,
            'cardId' => $card_id,
        ], $this->session_id);
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
        return $this->getRequest('merchant/history/card-verification', [
            'status' => $status,
            'from' => $from,
            'to' => $to,
            'pan' => $pan,
            'token' => $token,
            'merchantId' => $merchant_id,
            'merchantTrx' => $merchant_trx,
            'cardId' => $card_id,
            'offset' => $offset,
            'limit' => $limit,
            'orderDir' => $order_dir,
        ], $this->session_id);
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
        return $this->getRequest("merchant/history/card-verification/{$token}", [], $this->session_id);
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
        return $this->getRequest('merchant/history/card-registration-count', [
            'status' => $status,
            'from' => $from,
            'to' => $to,
            'pan' => $pan,
            'token' => $token,
            'merchantId' => $merchant_id,
            'merchantTrx' => $merchant_trx,
            'cardId' => $card_id,
        ], $this->session_id);
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
        return $this->getRequest('merchant/history/card-registration', [
            'status' => $status,
            'from' => $from,
            'to' => $to,
            'pan' => $pan,
            'token' => $token,
            'merchantId' => $merchant_id,
            'merchantTrx' => $merchant_trx,
            'cardId' => $card_id,
            'offset' => $offset,
            'limit' => $limit,
            'orderDir' => $order_dir,
        ], $this->session_id);
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
        return $this->getRequest("merchant/history/card-registration/{$token}", [], $this->session_id);
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
        return $this->getRequest("merchant/card/{$card_id}", [], $this->session_id);
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
        return $this->getRequest('merchant/card/count', [
            'from' => $from,
            'to' => $to,
            'pan' => $pan,
            'merchantId' => $merchant_id,
            'status' => $status,
        ], $this->session_id);
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
        return $this->getRequest('merchant/card', [
            'from' => $from,
            'to' => $to,
            'pan' => $pan,
            'merchantId' => $merchant_id,
            'status' => $status,
            'offset' => $offset,
            'limit' => $limit,
            'orderDir' => $order_dir,
        ], $this->session_id);
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
        return $this->postRequest("merchant/card/{$card_id}/delete", [], $this->session_id);
    }
}
