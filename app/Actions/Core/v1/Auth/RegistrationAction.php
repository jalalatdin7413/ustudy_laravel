<?php

namespace App\Actions\Core\V1\Auth;

use App\Dto\Core\v1\Auth\RegistrationDto;
use App\Actions\Core\v1\Auth\Otp\SendAction;
use App\Traits\ResponseTrait;
use Cache;
use Illuminate\Http\JsonResponse;


class RegistrationAction
{
    use ResponseTrait;

    public SendAction $sendAction;

    public function __construct()
    {
        $this->sendAction = new SendAction;
    }

    public function __invoke(RegistrationDto $dto): JsonResponse
    {
        $data = [
            'country_id' => $dto->countryId,
            'first_name' => $dto->firstName,
            'last_name' => $dto->lastName,
            'email' => $dto->email,
            'phone' => $dto->phone,
            'password' => $dto->password
        ];

       Cache::put('user_' . $dto->phone, $data, now()->addHour());

       return ($this->sendAction)($data);

        //$user->SendEmailVerificationNotification();

        
    }
}