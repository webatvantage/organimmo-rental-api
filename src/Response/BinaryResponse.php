<?php

namespace Organimmo\Rental\Response;

use Organimmo\Rental\ApiAdapter\ApiAdapterInterface;
use Organimmo\Rental\Request\Request;

class BinaryResponse
{
    /**
     * @var string The binary content returned from the API
     */
    protected $data;

    /**
     * @var string|null The content type (optional)
     */
    protected $contentType;

    /**
     * BinaryResponse constructor.
     *
     * @param Request $request
     * @param ApiAdapterInterface $api_adapter
     */
    public function __construct(Request $request, ApiAdapterInterface $api_adapter)
    {
        $this->data = $api_adapter->fetchBinary($request);

        // Optionally, if the adapter returns headers:
        $this->contentType = $api_adapter->getLastContentType() ?? null;
    }

    /**
     * Get the binary data
     *
     * @return string
     */
    public function getData(): string
    {
        return $this->data;
    }

    /**
     * Save the binary data to a file
     *
     * @param string $path
     * @return void
     */
    public function saveToFile(string $path): void
    {
        file_put_contents($path, $this->data);
    }

    /**
     * Output the binary data to the browser
     *
     * @return void
     */
    public function output(): void
    {
        if (headers_sent()) {
            throw new \RuntimeException('Headers already sent, binary output will be corrupted.');
        }
        if ($this->contentType) {
            header('Content-Type: ' . $this->contentType);
        }

        header('Content-Length: ' . strlen($this->data));

        echo $this->data;
        exit;
    }

    /**
     * Optionally get content type
     */
    public function getContentType(): ?string
    {
        return $this->contentType;
    }
}
