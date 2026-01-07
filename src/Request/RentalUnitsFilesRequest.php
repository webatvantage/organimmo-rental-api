<?php

/*
 * This file is part of the fw4/organimmo-rental-api library
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Organimmo\Rental\Request;

use Organimmo\Rental\ApiAdapter\ApiAdapter;
use Organimmo\Rental\Enums\FileSize;

class RentalUnitsFilesRequest extends CollectionRequest
{
	protected $guid;
	protected $size;

	public function __construct(string $guid, FileSize $size, ApiAdapter $adapter)
	{
		$this->guid = $guid;
		$this->size = $size;
		parent::__construct($adapter);
	}

	public function getEndpoint(): string
	{
		return 'rentalunitphotos/file/' . $this->guid . $this->size->value;
	}
}
