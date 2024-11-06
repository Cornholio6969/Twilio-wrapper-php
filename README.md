# Twilio Wrapper for PHP

This repository provides a simple PHP wrapper for interacting with Twilio's API. It allows you to easily send SMS messages and manage other Twilio interactions using a structured and reusable class-based approach.

## Features

- **Simple API Access**: Makes interacting with Twilio's API straightforward.
- **Modular Design**: Includes an `HttpClient` for HTTP requests and a `TwilioClient` for Twilio-specific interactions.
- **Error Handling**: Custom `TwilioException` for gracefully handling API errors.

## Installation

1. **Clone the Repository**:
   Run `git clone https://github.com/yourusername/TwilioWrapper.git`.

2. **Include in Your Project**:
   Place the `TwilioWrapper` directory in your project and include it in your PHP files as needed.

## Usage

To use this wrapper, you’ll need your Twilio Account SID and Auth Token. Replace `'your_account_sid'` and `'your_auth_token'` with your actual credentials.

### Example

```php
<?php
require_once 'src/Twilio/TwilioClient.php';
require_once 'src/Twilio/HttpClient.php';
require_once 'src/Twilio/Exception/TwilioException.php';

use Twilio\TwilioClient;
use Twilio\HttpClient;

$accountSid = 'your_account_sid';
$authToken = 'your_auth_token';
$client = new TwilioClient(new HttpClient(), $accountSid, $authToken);

try {
    $smsService = $client->sms();
    $response = $smsService->sendMessage('+1234567890', '+0987654321', 'Hello from Twilio!');
    echo 'Message sent successfully';
} catch (Twilio\Exception\TwilioException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>
```

This example demonstrates a simple SMS sending interaction with Twilio. The `sendMessage` method sends an SMS from one phone number to another and returns the response upon success.

## Class Structure

- **`TwilioClient`**: Main class for interacting with Twilio’s API, providing access to SMS services.
- **`HttpClient`**: Handles HTTP requests and is shared across other services.
- **`TwilioException`**: Custom exception for managing API-related errors.

## Contributing

Contributions are welcome! Please fork the repository, make your changes, and submit a pull request.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for more details.