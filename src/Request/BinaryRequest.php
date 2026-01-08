<?php

namespace Organimmo\Rental\Request;

use Organimmo\Rental\Response\BinaryResponse;

abstract class BinaryRequest extends Request
{
    /**
     * Execute request and return a BinaryResponse
     */
    public function get(): BinaryResponse
    {
        return new BinaryResponse($this, $this->adapter);
    }
}
