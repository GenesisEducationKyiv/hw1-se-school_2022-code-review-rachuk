<?php

namespace App\Http\Controllers;

use App\Mail\FeedbackMailer;
use App\Services\CurrencyService;
use App\Services\StorageService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class FeedbackController extends Controller
{
    /**
     * @param CurrencyService $currencyService
     * @param StorageService $storageService
     * @return JsonResponse
     * @throws \Exception
     */
    public function send(CurrencyService $currencyService, StorageService $storageService): JsonResponse
    {
        $rate = $currencyService->getBTCToUAH();
        if ($rate !== null) {
            $emails = $storageService->getEmails();

            foreach ($emails as $email) {
                Mail::to($email)->send(new FeedbackMailer($rate));
            }

            return response()->json('E-mails have been sent');
        }

        throw new BadRequestHttpException('No rate for now');
    }
}
