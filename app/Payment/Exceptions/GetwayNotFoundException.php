<?php declare(strict_types=1);

namespace App\Payment\Exceptions;

class GetwayNotFoundException extends \Exception
{
    public function __toString()
    {
        return get_class($this) . " '{$this->message}' in {$this->file}({$this->line})\n"
                                . "{$this->getTraceAsString()}";
    }
}
