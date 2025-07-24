<?php
namespace Tests\Unit;

use App\Suppliers\Dto\SupplierNormalizeDto;
use App\Suppliers\Heavenly\Heavenly;
use App\Suppliers\Heavenly\HeavenlyAdaptor;
use PHPUnit\Framework\TestCase;

class HeavenlyAdaptorTest extends TestCase
{
    public function test_list_returns_normalized_tours_with_price()
    {
        $heavenlyMock = $this->createMock(Heavenly::class);

        $tourList = [
            [
                'id' => 1,
                'title' => 'Test Tour',
                'excerpt' => 'Short Description',
                'city' => 'Shiraz',
                'country' => 'Iran'
            ]
        ];

        $priceData = [
            'price' => 1000000
        ];

        $heavenlyMock->method('list')->willReturn($tourList);
        $heavenlyMock->method('getPrice')->with(1)->willReturn($priceData);

        $adaptor = new HeavenlyAdaptor($heavenlyMock);
        $result = $adaptor->list();

        $this->assertIsArray($result);
        $this->assertInstanceOf(SupplierNormalizeDto::class, $result[0]);
        $this->assertEquals(1, $result[0]->id);
        $this->assertEquals('Test Tour', $result[0]->title);
        $this->assertEquals('Short Description', $result[0]->description);
        $this->assertEquals('Shiraz', $result[0]->city);
        $this->assertEquals('Iran', $result[0]->country);
        $this->assertEquals(1000000, $result[0]->price);
    }
}

