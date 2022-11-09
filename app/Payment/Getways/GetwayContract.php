<?php declare(strict_types=1);

namespace App\Payment\Getways;

interface GetwayContract
{
    public function getKey(): string|int;

    public function getId(): string|int;
}
