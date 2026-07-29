<?php

/*
 * This file is part of the fw4/organimmo-rental-api library
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Organimmo\Rental\Tests;

use PHPUnit\Framework\TestCase;
use Organimmo\Rental\Organimmo;

class BookingRequestTest extends TestCase
{
    protected $api;
    protected $adapter;

    protected function setUp(): void
    {
        parent::setUp();

        $this->adapter = new TestApiAdapter();
        $this->api = new Organimmo('');
        $this->api->setApiAdapter($this->adapter);
    }

    public function testCreateSendsPostWithJsonBody()
    {
        $this->adapter->queueResponseFromFile('bookingrequest.json');

        $booking = [
            'BookingDateTime' => '2026-07-29T09:45:15.548Z',
            'RentalUnitID' => 171,
            'TotalRentalUnitPeriod' => 1250.0,
            'BookerName' => 'Jan Janssens',
            'BookerAdress' => 'Kerkstraat 1',
            'BookerPostalcode' => '8300',
            'BookerCity' => 'Knokke-Heist',
            'BookerCountry' => 'België',
            'BookerLanguage' => 'N',
            'BookerEmail' => 'jan@example.com',
        ];

        $response = $this->api->bookingRequests()->create($booking);

        $request = $this->adapter->getLastRequest();

        $this->assertSame('BookingRequest', $request['endpoint']);
        $this->assertSame('POST', $request['method']);
        $this->assertSame($booking, $request['body']);

        $this->assertSame(4711, $response->OnlineBookingRequestId);
        $this->assertSame(0, $response->Status);
    }

    public function testStatusIsAGetOnTheStatusEndpoint()
    {
        $this->adapter->queueResponseFromFile('bookingrequest.json');

        $this->api->bookingRequests()->status(4711);

        $request = $this->adapter->getLastRequest();

        $this->assertSame('BookingRequest/4711/status', $request['endpoint']);
        $this->assertSame('GET', $request['method']);
        $this->assertNull($request['body']);
    }
}
