<?php declare(strict_types=1);

namespace Tests\Feature;

use App\Payment\Getways\GetwayOne;
use Tests\TestCase;

class PaymentRequestTest extends TestCase
{
    public function test_it_merchant_1_works()
    {
        $getway = new GetwayOne();
        $payload = [
            "merchant_id" => $getway->getId(),
            "payment_id" => 13,
            "status" => "completed",
            "amount" => 500,
            "amount_paid" => 500,
            "timestamp" => 1654103837,
            "sign" => "65ec7118f18facbaf5cf497be6e826c2ebb6ef23c9671ce3cd2c66cb6162b918",
        ];

        $this->json('GET', route('payment.callback', $payload))
            ->assertOk()
        ;
    }
}
