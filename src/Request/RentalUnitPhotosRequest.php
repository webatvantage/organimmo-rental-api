<?php

/*
 * This file is part of the fw4/organimmo-rental-api library
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Organimmo\Rental\Request;

use Organimmo\Rental\Enums\FileSize;

class RentalUnitPhotosRequest extends CollectionRequest
{
    use HasSimpleChildTrait;

    const ENDPOINT = 'rentalunitphotos';

	/**
	 * Get the photos of a specified rental unit using ID.
	 *
	 * @param int $rental_unit_id
	 */
	public function files(string $guid, FileSize $size = FileSize::ORIGINAL): RentalUnitsFilesRequest
	{
		return new RentalUnitsFilesRequest($guid, $size, $this->adapter);
	}
}
