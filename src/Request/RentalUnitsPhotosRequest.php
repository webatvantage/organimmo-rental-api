<?php

/*
 * This file is part of the fw4/organimmo-rental-api library
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Organimmo\Rental\Request;

use Organimmo\Rental\ApiAdapter\ApiAdapter;

class RentalUnitsPhotosRequest extends CollectionRequest
{
    protected $id;

    public function __construct(int $id, ApiAdapter $adapter)
    {
        $this->id = $id;
        parent::__construct($adapter);
    }

	/**
	 * Get the photos of a specified rental unit using ID.
	 *
	 * @param int $rental_unit_id
	 */
	public function files(string $guid): RentalUnitsFilesRequest
	{
		return new RentalUnitsFilesRequest($guid, $this->adapter);
	}

    public function getEndpoint(): string
    {
        return 'rentalunits/' . $this->id . '/photos';
    }
}
