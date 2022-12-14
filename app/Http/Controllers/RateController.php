<?php

namespace App\Http\Controllers;

use App\Services\CurrencyService;
use Exception;
use Illuminate\Http\JsonResponse;
use Psy\Util\Json;
use Symfony\Component\HttpFoundation\Response;

class RateController extends Controller
{
    /**
     * @param CurrencyService $service
     * @return JsonResponse
     * @throws Exception
     */
    public function getRate(CurrencyService $service): JsonResponse
    {
        $rate = $service->getBTCToUAH();

        if ($rate !== null) {
            return response()->json(Json::encode($service->getBTCToUAH()));
        }

        return response()->json('Invalid status value', Response::HTTP_BAD_REQUEST);
    }
}
