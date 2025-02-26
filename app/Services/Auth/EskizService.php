<?php

namespace App\Services\Auth;

use App\Exceptions\ApiResponseException;
use App\Traits\ResponseTrait;
use Cache;
use Illuminate\Support\Facades\Http;

class EskizService
{
    use ResponseTrait;

    /**
     * Summary of token
     */
    private string $token;

    const REDIS_KEY = 'otp_token';

    public function __construct()
    {
        $this->token = Cache::has($this::REDIS_KEY) ? Cache::get($this::REDIS_KEY) : Cache::put($this::REDIS_KEY, $this->getToken(), now()->addDays(29));
    }

    /**
     * Summary of getToken
     * 
     * @throws \App\Exceptions\ApiResponseException
     */
    public function getToken(): string
    {
        $response = Http::post(config('eskiz.url').'/auth/login', [
            'email' => config('eskiz.login'),
            'password' => config('eskiz.password'),
        ]);

        if (! $response->ok()) {
            throw new ApiResponseException('Eskiz benen baylanisiwda problema', 400);
        }

        $data = $response->json();

        return $data['data']['token'];
    }

    /**
     * Summary of send
     * @throws \App\Exceptions\ApiResponseException
     */
    public function send(string $phone, string $message): void
    {
        $response = Http::withToken($this->token)
            ->post(
                url: config('eskiz.url').'/message/sms/send',
                data: [
                    'mobile_phone' => $phone,
                    'message' => $message,
                    'from' => 4546,
                ]
            );

        $data = $response->json();
        
        if ($response->clientError()) {
            throw new ApiResponseException($data['message'], 400);
        }

        if ($response->serverError()) {
            throw new ApiResponseException("Eskiz benen baylanisli server ta'repinen problema shiqti", 500);
        }
    }
}