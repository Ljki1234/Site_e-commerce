<?php
declare(strict_types=1);

namespace App\Services;

class PayPal
{
    private string $clientId;
    private string $clientSecret;
    private bool $sandbox;
    private ?string $accessToken = null;

    public function __construct(string $clientId, string $clientSecret, bool $sandbox = true)
    {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->sandbox = $sandbox;
    }

    private function baseUrl(): string
    {
        return $this->sandbox ? 'https://api-m.sandbox.paypal.com' : 'https://api-m.paypal.com';
    }

    private function getAccessToken(): string
    {
        if ($this->accessToken !== null) {
            return $this->accessToken;
        }
        $url = $this->baseUrl() . '/v1/oauth2/token';
        $auth = base64_encode($this->clientId . ':' . $this->clientSecret);
        $opts = [
            'http' => [
                'method' => 'POST',
                'header' => "Authorization: Basic $auth\r\nContent-Type: application/x-www-form-urlencoded\r\n",
                'content' => 'grant_type=client_credentials',
                'ignore_errors' => true,
            ],
        ];
        $ctx = stream_context_create($opts);
        $response = @file_get_contents($url, false, $ctx);
        if ($response === false) {
            throw new \RuntimeException('PayPal: failed to get access token');
        }
        $data = json_decode($response, true);
        if (empty($data['access_token'])) {
            throw new \RuntimeException('PayPal: invalid token response');
        }
        $this->accessToken = $data['access_token'];
        return $this->accessToken;
    }

    /**
     * Create a PayPal order. Returns ['id' => paypalOrderId, 'approve_url' => url].
     */
    public function createOrder(float $amount, string $returnUrl, string $cancelUrl, string $description = 'Order'): array
    {
        $token = $this->getAccessToken();
        $url = $this->baseUrl() . '/v2/checkout/orders';
        $body = [
            'intent' => 'CAPTURE',
            'purchase_units' => [
                [
                    'amount' => [
                        'currency_code' => 'USD',
                        'value' => number_format($amount, 2, '.', ''),
                    ],
                    'description' => $description,
                ],
            ],
            'application_context' => [
                'return_url' => $returnUrl,
                'cancel_url' => $cancelUrl,
            ],
        ];
        $opts = [
            'http' => [
                'method' => 'POST',
                'header' => "Authorization: Bearer $token\r\nContent-Type: application/json\r\n",
                'content' => json_encode($body),
                'ignore_errors' => true,
            ],
        ];
        $ctx = stream_context_create($opts);
        $response = @file_get_contents($url, false, $ctx);
        if ($response === false) {
            throw new \RuntimeException('PayPal: failed to create order');
        }
        $data = json_decode($response, true);
        if (empty($data['id'])) {
            throw new \RuntimeException('PayPal: ' . ($data['message'] ?? 'create order failed'));
        }
        $approveUrl = '';
        foreach ($data['links'] ?? [] as $link) {
            if (($link['rel'] ?? '') === 'approve') {
                $approveUrl = $link['href'] ?? '';
                break;
            }
        }
        if ($approveUrl === '') {
            throw new \RuntimeException('PayPal: no approval link');
        }
        return ['id' => $data['id'], 'approve_url' => $approveUrl];
    }

    /**
     * Capture a PayPal order. Returns true on success.
     */
    public function captureOrder(string $paypalOrderId): bool
    {
        $token = $this->getAccessToken();
        $url = $this->baseUrl() . '/v2/checkout/orders/' . urlencode($paypalOrderId) . '/capture';
        $opts = [
            'http' => [
                'method' => 'POST',
                'header' => "Authorization: Bearer $token\r\nContent-Type: application/json\r\n",
                'content' => '{}',
                'ignore_errors' => true,
            ],
        ];
        $ctx = stream_context_create($opts);
        $response = @file_get_contents($url, false, $ctx);
        if ($response === false) {
            return false;
        }
        $data = json_decode($response, true);
        return ($data['status'] ?? '') === 'COMPLETED';
    }
}
