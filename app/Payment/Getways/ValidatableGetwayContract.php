<?php declare(strict_types=1);

namespace App\Payment\Getways;

interface ValidatableGetwayContract
{
    public function validate();
}
