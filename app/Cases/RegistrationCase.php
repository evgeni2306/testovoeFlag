<?php

declare(strict_types=1);

namespace App\Cases;

use App\Exceptions\RegistrationException;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RegistrationCase
{
    private const LOG_CHANNEL_NAME = 'registration';

    /**
     * @param string $email
     * @param string $password
     * @return string
     * @throws RegistrationException
     */
    public function handle(string $email, string $password): string
    {
        DB::beginTransaction();
        try {
            $user = User::query()->create(['email' => $email, 'password' => $password]);
            $token = $user->createToken('token')->plainTextToken;
        } catch (Exception $exception) {
            DB::rollBack();
            Log::channel(self::LOG_CHANNEL_NAME)->info($exception->getMessage());
            throw new RegistrationException('Registration failed', 0, $exception);
        }
        DB::commit();

        return $token;
    }
}
