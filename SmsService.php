<?php

namespace Twilio;

use Twilio\Exception\TwilioException;

class SmsService
{
    private $client;

    public function __construct(TwilioClient $client)
    {
        $this->client = $client;
    }

    /**
     * Send an SMS message
     *
     * @param string $from - Sender's phone number
     * @param string $to - Recipient's phone number
     * @param string $body - Message body
     * @return array
     * @throws TwilioException
     */
    public function sendMessage(string $from, string $to, string $body): array
    {
        $url = $this->client->getBaseUrl() . '/Messages.json';
        $data = [
            'From' => $from,
            'To' => $to,
            'Body' => $body,
        ];

        $response = $this->client->httpClient->post($url, $data, $this->client->getAuthHeaders());

        if (isset($response['error_message'])) {
            throw new TwilioException($response['error_message']);
        }

        return $response;
    }
}
