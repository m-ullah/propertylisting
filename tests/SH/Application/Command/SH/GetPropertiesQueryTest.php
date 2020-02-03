<?php

use PHPUnit\Framework\TestCase;
use SH\Framework\Infrastructure\Service\PropertyFeedService;

final class GetPropertiesQueryTest extends TestCase
{
    protected $http;
    protected $service;
    protected $xmlfile;

    public function setUp()
    {
        // create http client (Guzzle)
        $this->http = new GuzzleHttp\Client(array(
            'base_uri' => 'http://localhost:8055/bootstrap.php/property/list?limit=10&sort=date',
            'request.options' => array(
                'exceptions' => false,
            )
        ));

        $this->service = new PropertyFeedService();
        $this->xmlfile = './tests/SH/testdata/mitula-UK-en-2.xml';
    }

    public function tearDown()
    {
        $this->http = null;
    }

    public function testGET()
    {
        $response = $this->http->request('GET');

        $this->assertEquals(200, $response->getStatusCode());

        $data = json_decode($response->getBody(true), true);
        if (!empty($data)) {
            $this->assertArrayHasKey('id', $data[0]);
        }
    }

    public function testCurrencyService()
    {
        $data = json_decode(json_encode($this->service->fetchXMLFeed($this->xmlfile)), true);
        if (!empty($data)) {
            $this->assertArrayHasKey('id', $data);
        }
    }
}
