<?php

/*
 * This file is part of the fw4/organimmo-rental-api library
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Organimmo\Rental\Request;

/**
 * A request that sends a JSON body instead of query parameters. Writes are not
 * idempotent, so the adapter does not retry them.
 */
abstract class WriteRequest extends Request
{
    protected $_body = [];

    public function getMethod(): string
    {
        return 'POST';
    }

    public function getBody(): ?array
    {
        return $this->_body;
    }
}
