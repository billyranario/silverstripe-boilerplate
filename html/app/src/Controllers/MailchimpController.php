<?php

use SilverStripe\Control\Controller;
use SilverStripe\Control\HTTPRequest;
use SilverStripe\Control\HTTPResponse;
use SilverStripe\Core\Environment;

class MailchimpController extends Controller
{
    private static $allowed_actions = [
        'index'
    ];

    public function index(HTTPRequest $request)
    {
        if ($request->isPOST()) {
            // Read the raw body and decode the JSON
            $json = json_decode($request->getBody(), true);

            // Ensure 'email', 'first_name', and 'last_name' are set and valid
            $email = isset($json['email']) ? $json['email'] : null;
            $firstName = isset($json['first_name']) ? $json['first_name'] : null;
            $lastName = isset($json['last_name']) ? $json['last_name'] : null;

            // Validate that all fields are provided
            if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return HTTPResponse::create('Invalid or missing email address', 400)
                    ->addHeader('Content-Type', 'text/plain');
            }

            if (!$firstName) {
                return HTTPResponse::create('First name is required', 400)
                    ->addHeader('Content-Type', 'text/plain');
            }

            if (!$lastName) {
                return HTTPResponse::create('Last name is required', 400)
                    ->addHeader('Content-Type', 'text/plain');
            }

            // Call the subscribeToMailchimp method with first name and last name
            $response = $this->subscribeToMailchimp($email, $firstName, $lastName);

            if ($response['status'] === 'error') {
                return HTTPResponse::create('Subscription failed: ' . $response['detail'], 400)
                    ->addHeader('Content-Type', 'text/plain');
            } else {
                return HTTPResponse::create('Subscription successful!', 200)
                    ->addHeader('Content-Type', 'text/plain');
            }
        }

        return HTTPResponse::create('Invalid request method', 405)
            ->addHeader('Content-Type', 'text/plain');
    }

    private function subscribeToMailchimp($email, $firstName, $lastName)
    {
        $apiKey = Environment::getEnv('MAILCHIMP_API_KEY');
        $listId = Environment::getEnv('MAILCHIMP_LIST_ID');
        $dataCenter = substr($apiKey, strpos($apiKey, '-') + 1);

        $url = 'https://' . $dataCenter . '.api.mailchimp.com/3.0/lists/' . $listId . '/members/';

        // Mailchimp request payload
        $data = [
            'email_address' => $email,
            'status' => 'subscribed', // Set to 'subscribed' for instant subscription
            'merge_fields' => [
                'FNAME' => $firstName,
                'LNAME' => $lastName
            ]
        ];

        // Setup the request
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: apikey ' . $apiKey,
            'Content-Type: application/json'
        ]);

        // Execute the request
        $result = curl_exec($ch);

        // Check for cURL errors
        if ($result === false) {
            return [
                'status' => 'error',
                'detail' => 'Curl error: ' . curl_error($ch)
            ];
        }

        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE); // Get HTTP status code
        curl_close($ch);

        // Decode the JSON response from Mailchimp
        $response = json_decode($result, true);

        // Handle Mailchimp response
        if ($httpCode == 200 || $httpCode == 201) {
            return [
                'status' => 'success',
                'detail' => 'Subscription successful!'
            ];
        } elseif ($httpCode == 400 && isset($response['title']) && $response['title'] === 'Member Exists') {
            return [
                'status' => 'error',
                'detail' => 'The email address is already subscribed to this list.'
            ];
        } else {
            // Return the error detail from Mailchimp's response
            return [
                'status' => 'error',
                'detail' => isset($response['detail']) ? $response['detail'] : 'Unknown error'
            ];
        }
    }
}
