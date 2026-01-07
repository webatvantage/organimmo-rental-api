<?php

/*
 * This file is part of the fw4/organimmo-rental-api library
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Organimmo\Rental\Request;

use Organimmo\Rental\ApiAdapter\ApiAdapter;

class RentalUnitsFilesRequest extends CollectionRequest
{
	protected $guid;

	public function __construct(string $guid, ApiAdapter $adapter)
	{
		$this->guid = $guid;
		parent::__construct($adapter);
	}

	public function getEndpoint(): string
	{
		return 'rentalunitphotos/' . $this->guid . '/files';
	}
}
