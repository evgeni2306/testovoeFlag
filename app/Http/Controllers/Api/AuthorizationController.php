<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Cases\RegistrationCase;
use App\Exceptions\RegistrationException;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistrationRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthorizationController extends Controller
{
    /**
     * @param RegistrationRequest $request
     * @param RegistrationCase $case
     * @return JsonResponse
     * @throws RegistrationException
     */
    public function registration(RegistrationRequest $request, RegistrationCase $case): JsonResponse
    {
        $requestData = $request->validated();
        $email = $requestData['email'];
        $password = $requestData['password'];
        $token = $case->handle($email, $password);

        return response()->json(['token' => $token], 200, ['Content-Type' => 'string']);
    }

    /**
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $requestData = $request->validated();
        if (Auth::attempt($requestData)) {
            $user = Auth::user();
            $token = $user->createToken('token')->plainTextToken;

            return response()->json(['token' => $token], 200, ['Content-Type' => 'string']);
        } else {
            return response()->json(['message' => 'Unauthorized'], 401, ['Content-Type' => 'string']);
        }
    }
}
