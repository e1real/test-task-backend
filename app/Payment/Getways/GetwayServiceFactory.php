<?php declare(strict_types=1);

namespace App\Payment\Getways;

use App\Http\Requests\GetwayResolverRequest;
use App\Payment\Exceptions\GetwayNotFoundException;

class GetwayServiceFactory
{
    private GetwayOne $getwayOne;

    public function __construct(GetwayOne $getwayOne)
    {
        $this->getwayOne = $getwayOne;
    }

    public function resolveGetwayByRequest(GetwayResolverRequest $request): ValidatableGetwayContract
    {
        return match ($request->merchant_id) {
            default => throw new GetwayNotFoundException(),
            $this->getwayOne->getId() => $this->getwayOne,
        };
    }
}
