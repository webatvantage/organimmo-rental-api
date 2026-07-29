<?php

/*
 * This file is part of the fw4/organimmo-rental-api library
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Organimmo\Rental\Request;

use Organimmo\Rental\Response\Response;

/**
 * Online booking requests.
 *
 * The booking period is given either by its RentalUnitPeriodID, or by the combination
 * BeginDateTime + BeginDayPartID + EndDateTime + EndDayPartID, or by both.
 *
 * A successful call returns OnlineBookingRequestId and Status. Status is an enum:
 * 0 Requested, 1 Pending, 2 Ready for processing, 3 Approved, 4 Refused. A Status of
 * 4 means the request was NOT booked, even though the call itself succeeded.
 */
class BookingRequestsRequest extends WriteRequest
{
    const ENDPOINT = 'BookingRequest';

    /**
     * Add an online booking request.
     *
     * @param array $booking An OnlineBookingRequestPDTO payload. Required members:
     *                       BookingDateTime, RentalUnitID, TotalRentalUnitPeriod,
     *                       BookerName, BookerAdress, BookerPostalcode, BookerCity,
     *                       BookerCountry, BookerLanguage, BookerEmail.
     */
    public function create(array $booking): ?Response
    {
        $this->_body = $booking;

        $response = $this->adapter->request($this);

        return $response ? new Response($response, $this->adapter) : null;
    }

    /**
     * Get the current status of a booking request.
     */
    public function status(int $id): ?Response
    {
        $response = $this->adapter->request(new BookingRequestStatusRequest($id, $this->adapter));

        return $response ? new Response($response, $this->adapter) : null;
    }
}
