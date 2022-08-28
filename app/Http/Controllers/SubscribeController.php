<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubscribeRequest;
use App\Services\StorageService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class SubscribeController extends Controller
{
    /**
     * @param SubscribeRequest $request
     * @param StorageService $service
     * @return JsonResponse
     */
    public function subscribe(SubscribeRequest $request, StorageService $service): JsonResponse
    {
        $validatedData = $request->validated();

        if (isset($validatedData['email'])) {
            if ($service->isEmailExist($validatedData['email'])) {
                $service->save($validatedData['email']);
                return response()->json('E-mail додано');
            }

            return response()->json('Повертати, якщо e-mail вже є в базі даних (файловій)', 409);
        }

        throw new BadRequestHttpException('Invalid email');
    }
}
