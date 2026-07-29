<?php

/*
 * This file is part of the fw4/organimmo-rental-api library
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Organimmo\Rental\Request;

use Organimmo\Rental\ApiAdapter\ApiAdapter;

abstract class Request extends RequestObject
{
    protected $adapter;
    protected $_headers = [];

    public function __construct(ApiAdapter $adapter)
    {
        $this->adapter = $adapter;
    }

    public function getEndpoint(): string
    {
        return static::ENDPOINT;
    }

    public function getHeaders(): array
    {
        return $this->_headers;
    }

    /**
     * HTTP method this request is sent with. Reads are the default, see WriteRequest.
     */
    public function getMethod(): string
    {
        return 'GET';
    }

    /**
     * Payload to send as a JSON request body, or null for a request without one.
     * Distinct from getData(), which is sent as query parameters.
     */
    public function getBody(): ?array
    {
        return null;
    }

    public function depth(int $depth): Request
    {
        $this->_data['depth'] = $depth;
        return $this;
    }
}
