<?php

namespace App\Dto\Core\V1\Auth;

use App\Http\Requests\Core\v1\Auth\OtpAcceptRequest;

readonly class OtpAcceptDto
{
    public function __construct(
        public int $phone,
        public int $code,
    ) {}

    public static function from(OtpAcceptRequest $request): self
    {
        return new self(
            phone: $request->get('phone'),
            code: $request->get('code')
        );
    }
}