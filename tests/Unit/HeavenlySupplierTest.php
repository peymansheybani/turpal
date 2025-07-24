<?php

namespace Tests\Unit;

use App\Suppliers\Heavenly\Heavenly;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class HeavenlySupplierTest extends TestCase
{
    private Heavenly $heavenly;

    public function setUp(): void
    {
        parent::setUp();

        $this->heavenly = new Heavenly([
            'base_url' => 'https://mock.turpal.com'
        ]);
    }

    public function testListReturnsTours()
    {
        Http::fake([
            'https://mock.turpal.com/heavenly/api/tours*' => Http::response([
                'data' => [
                    [
                        'id' => '123',
                        'title' => 'Amazing Tour',
                        'excerpt' => 'Sample excerpt',
                        'city' => 'Paris',
                        'country' => 'FR'
                    ]
                ]
            ], 200)
        ]);

        $result = $this->heavenly->list();

        $this->assertIsArray($result);
        $this->assertEquals('123', $result[0]['id']);
    }

    public function testDetailReturnsData()
    {
        Http::fake([
            'https://mock.turpal.com/heavenly/api/tours/123' => Http::response([
                'id' => '123',
                'title' => 'Amazing Tour',
                'city' => 'Paris',
                "photos" =>[
                    "https://picsum.photos/seed/geTh6q8N/281/3535?blur=3",
                    "https://picsum.photos/seed/afBukNc/662/3683?grayscale&blur=1",
                    "https://picsum.photos/seed/ar0xVI/2525/844?blur=1"
                ]
            ], 200)
        ]);

        $result = $this->heavenly->detail('123');

        $this->assertEquals('123', $result['id']);
        $this->assertEquals('Paris', $result['city']);
        $this->assertIsArray($result['photos']);
    }

    public function testGetPriceReturnsData()
    {
        Http::fake([
            'https://mock.turpal.com/heavenly/api/tour-prices*' => Http::response([
                'data' => [
                    [
                        'tourId' => '123',
                        'price' => '100.00',
                    ]
                ]
            ], 200)
        ]);

        $result = $this->heavenly->getPrice('123');

        $this->assertIsArray($result);
        $this->assertEquals('100.00', $result[0]['price']);
    }

    public function testAvailabilityReturnsTrue()
    {
        Http::fake([
            'https://mock.turpal.com/heavenly/api/tours/123/availability' => Http::response([
                'available' => true
            ], 200)
        ]);

        $result = $this->heavenly->availability('123');

        $this->assertTrue($result);
    }

    public function testAvailabilityReturnsFalseOnError()
    {
        Http::fake([
            '*' => Http::response(null, 500)
        ]);

        $result = $this->heavenly->availability('123');

        $this->assertFalse($result);
    }
}
