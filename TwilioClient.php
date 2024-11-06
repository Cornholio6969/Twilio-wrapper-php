<?php

namespace Twilio;

use Twilio\Exception\TwilioException;

class TwilioClient
{
    private $httpClient;
    private $accountSid;
    private $authToken;

    public function __construct(HttpClient $httpClient, string $accountSid, string $authToken)
    {
        $this->httpClient = $httpClient;
        $this->accountSid = $accountSid;
        $this->authToken = $authToken;
    }

    /**
     * Get the base URL for Twilio API
     *
     * @return string
     */
    public function getBaseUrl(): string
    {
        return "https://api.twilio.com/2010-04-01/Accounts/{$this->accountSid}";
    }

    /**
     * Get authentication headers for the API requests
     *
     * @return array
     */
    public function getAuthHeaders(): array
    {
        return [
            'Authorization' => 'Basic ' . base64_encode($this->accountSid . ':' . $this->authToken),
            'Content-Type' => 'application/x-www-form-urlencoded'
        ];
    }

    /**
     * Returns a new SmsService instance
     *
     * @return SmsService
     */
    public function sms(): SmsService
    {
        return new SmsService($this);
    }
}
