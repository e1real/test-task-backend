<?php declare(strict_types=1);

namespace App\Payment\Getways;

use Illuminate\Support\Facades\Validator;

class GetwayOne implements GetwayContract, ValidatableGetwayContract
{
    public function getKey(): string
    {
        return config('services.getway_service_1.merchant_key');
    }

    public function getId(): string
    {
        return config('services.getway_service_1.merchant_id');
    }

    public function validate()
    {
        return Validator::make(request()->all(), [
            "merchant_id" => "integer|required",
            "payment_id" => "integer|required",
            "status" => "string|required",
            "amount" => "numeric|required",
            "amount_paid" => "numeric|required",
            "timestamp" => "integer|required",
            "sign" => [
                "string",
                function ($attribute, $value, $fail) {
                    if (!$this->signIsValid()) {
                        $fail('invalid sign key');
                    }
                },
            ],
        ])->validate();
    }

    public function signIsValid(): bool
    {
        $req = request();
        $fields = [
            "merchant_id",
            "payment_id",
            "status",
            "amount",
            "amount_paid",
            "timestamp",
        ];

        $fieldsString = collect($fields)
            ->sort()
            ->map(fn ($key) => $key . $req->input($key))
            ->implode(':')
        ;

        $fieldsString .= $this->getKey();

        return hash('sha256', $fieldsString) === $req->input('sign');
    }
}
