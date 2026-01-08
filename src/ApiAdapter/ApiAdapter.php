<?php

/*
 * This file is part of the fw4/organimmo-rental-api library
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Organimmo\Rental\ApiAdapter;

use Organimmo\Rental\Request\Request;
use Organimmo\Rental\Response\Response;
use Organimmo\Rental\Response\CollectionResponse;

abstract class ApiAdapter implements ApiAdapterInterface
{
    private ?int $rowCount = null;

    /**
     * Last response Content-Type header
     */
    protected ?string $lastContentType = null;

    public function request(?Request $request = null, bool $raw = false)
    {
        $this->rowCount = null;
        $this->lastContentType = null;

        $http_body = $this->requestBody(
            $request->getEndpoint(),
            $request->getData(),
            $request->getHeaders()
        );

        if ($raw) {
            return $http_body;
        }

        if ($http_body === null) {
            return null;
        }

        return json_decode($http_body, false);
    }

    /**
     * Fetch raw binary response
     */
    public function fetchBinary(Request $request): string
    {
        return (string) $this->request($request, true);
    }

    /**
     * Return Content-Type of last response
     */
    public function getLastContentType(): ?string
    {
        return $this->lastContentType;
    }

    protected function setRowCount(?int $count): void
    {
        $this->rowCount = $count;
    }

    public function getRowCount(): ?int
    {
        return $this->rowCount;
    }

    /**
     * Concrete adapters MUST:
     *  - perform the HTTP request
     *  - set $this->lastContentType
     */
    abstract public function requestBody(
        string $endpoint,
        ?array $params = null,
        ?array $headers = []
    ): ?string;
}
