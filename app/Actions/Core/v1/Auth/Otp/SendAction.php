<?php

namespace App\Actions\Core\V1\Auth\Otp;

use App\Traits\ResponseTrait;
use App\Services\Auth\EskizService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Redis;
use Cache;

class SendAction
{
    use ResponseTrait;

    protected EskizService $eskizService;

    public function __construct()
    {
        $this->eskizService = new EskizService();
    }

    /**
     * Summary of __invoke
     * @param array $user
     * @return JsonResponse
     */
    public function __invoke(array $user): JsonResponse
    {
        $ttl = 120;
        $code = rand(100000, 999999);

        if (Cache::has('otp_verification_' . $user['phone'])) {
            $ttl = Redis::ttl(config('cache.prefix') . 'otp_verification_' . $user['phone']);

            $minute = (int)($ttl / 60);
            $second = $ttl % 60;
            $second = $second < 10 ? '0' . $second : $second;

            return static::toResponse(
                code: 400,
                message: __('auth.otp.exists', ['sec' => '0' . $minute . ':' . $second]),
                ttl: $ttl
            );

        }

        $this->eskizService->send(
            phone: $user['phone'],
            //message: __('auth.otp.message', ['code' => $code])
            message: "Bu Eskiz dan test"
        );

        Cache::set('otp_verification_' . $user['phone'], $code, $ttl);

        return static::toResponse(
            message: __('auth.otp.success'),
            data: [
                'code' => $code
            ],
            ttl: $ttl
        );
    }
}