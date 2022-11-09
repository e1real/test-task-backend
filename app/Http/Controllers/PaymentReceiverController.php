<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\GetwayResolverRequest;
use App\Payment\Exceptions\GetwayNotFoundException;
use App\Payment\Getways\GetwayServiceFactory;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class PaymentReceiverController extends Controller
{
    public function __invoke(
        GetwayResolverRequest $request,
        GetwayServiceFactory $getwayServiceFactory,
    ): Response {
        try {
            $getwayServiceFactory
                ->resolveGetwayByRequest(tap($request, fn () => $request->validated()))
                ->validate()
            ;
        } catch (GetwayNotFoundException $e) {
            throw ValidationException::withMessages(['merchant_id' => 'merchant doest exists']);
        }

        return response([], 200);
    }
}
