<?php

/*
 * This file is part of the fw4/organimmo-rental-api library
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Organimmo\Rental\Exception;

use Psr\Http\Message\ResponseInterface;

/**
 * A request the API rejected. Carries the ResponseObject payload the API returns on
 * 400/404/409, so the caller can log why instead of only seeing a status code.
 */
class RequestException extends \Exception
{
    private $statusCode;
    private $errorCode;
    private $errors = [];
    private $moreInformation;

    public static function fromResponse(ResponseInterface $response, string $endpoint): self
    {
        $statusCode = $response->getStatusCode();
        $payload = json_decode((string) $response->getBody(), true);

        if (!is_array($payload)) {
            $payload = [];
        }

        $message = $payload['Message'] ?? $response->getReasonPhrase();

        $exception = new self(
            sprintf('Organimmo rejected [%s] with status %d: %s', $endpoint, $statusCode, $message),
            $statusCode
        );

        $exception->statusCode = $statusCode;
        $exception->errorCode = $payload['Code'] ?? null;
        $exception->errors = $payload['Errors'] ?? [];
        $exception->moreInformation = $payload['MoreInformation'] ?? null;

        return $exception;
    }

    public function getStatusCode(): ?int
    {
        return $this->statusCode;
    }

    public function getErrorCode(): ?string
    {
        return $this->errorCode;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function getMoreInformation(): ?string
    {
        return $this->moreInformation;
    }
}
