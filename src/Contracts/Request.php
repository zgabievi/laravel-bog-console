<?php

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class Request
{
    /**
     * Reusable http post request
     *
     * @param string $url
     * @param array $data
     * @param string|null $token
     * @param string $type
     * @return \stdClass|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \JsonException
     */
    protected function postRequest(string $url, array $data = [], string $token = null, string $type = 'form_params'): ?\stdClass
    {
        $api_url = rtrim(config('bog-console.api_url'), '/');
        $portal_id = config('bog-console.portal_id');

        $client = new Client();
        try {
            $params = $type === 'json' ? ['json' => $data] : ['form_params' => $data];
            $response = $client->post("{$api_url}/{$portal_id}/{$url}", array_merge($params, $token ? [
                'headers' => [
                    'Authorization' => 'Session ' . $token,
                ],
            ] : []));
        } catch (ClientException $exception) {
            $error = json_decode($exception->getResponse()->getBody(), false, 512, JSON_THROW_ON_ERROR);

            if (!isset($error->error_code)) {
                return $error;
            }

            abort($error->error_code, isset($error->error_message) ? $error->error_message : '');
        }

        return json_decode((string)$response->getBody(), false, 512, JSON_THROW_ON_ERROR);
    }

    /**
     * Reusable http get request
     *
     * @param string $url
     * @param array $data
     * @param string|null $token
     * @return \stdClass
     * @throws JsonException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function getRequest(string $url, array $data = [], string $token = null): \stdClass
    {
        $api_url = rtrim(config('bog-console.api_url'), '/');
        $portal_id = config('bog-console.portal_id');

        $params = http_build_query($data);

        $client = new Client();
        try {
            $response = $client->get("{$api_url}/{$portal_id}/{$url}?{$params}", $token ? [
                'headers' => [
                    'Authorization' => 'Session ' . $token,
                ],
            ] : []);
        } catch (ClientException $exception) {
            $error = json_decode($exception->getResponse()->getBody(), false, 512, JSON_THROW_ON_ERROR);

            if (!isset($error->error_code)) {
                return $error;
            }

            abort($error->error_code, isset($error->error_message) ? $error->error_message : '');
        }

        return json_decode((string)$response->getBody(), false, 512, JSON_THROW_ON_ERROR);
    }
}
