<?php

namespace Twilio;

use Twilio\Exception\TwilioException;

class HttpClient
{
    /**
     * Send a POST request with form data
     *
     * @param string $url
     * @param array $data
     * @param array $headers
     * @return array
     * @throws TwilioException
     */
    public function post(string $url, array $data, array $headers): array
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => http_build_query($data),
            CURLOPT_HTTPHEADER => $this->formatHeaders($headers),
        ]);

        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if ($httpCode !== 201 || curl_errno($curl)) {
            throw new TwilioException("HTTP Error: " . curl_error($curl));
        }

        curl_close($curl);

        return json_decode($response, true);
    }

    /**
     * Format headers for cURL
     *
     * @param array $headers
     * @return array
     */
    private function formatHeaders(array $headers): array
    {
        $formattedHeaders = [];
        foreach ($headers as $key => $value) {
            $formattedHeaders[] = "$key: $value";
        }
        return $formattedHeaders;
    }
}
