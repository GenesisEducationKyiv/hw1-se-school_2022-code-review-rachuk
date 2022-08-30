<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubscribeRequest;
use App\Services\StorageService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpFoundation\Response;

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
                return response()->json('E-mail added');
            }

            return response()->json('E-mail already exists in a file', Response::HTTP_CONFLICT);
        }

        throw new BadRequestHttpException('Invalid email');
    }
}
