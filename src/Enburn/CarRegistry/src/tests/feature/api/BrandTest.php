<?php

use Enburn\CarRegistry\Database\Factories\BrandFactory;
use Enburn\CarRegistry\Models\Brand;
use Tests\TestCase;

class BrandTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->brands = BrandFactory::new()->times(3)->make();

    }

    public function testCanCreateBrand()
    {
        $response = $this->post('api/v1/brands', $this->brands->first()->toArray());

        $response->assertStatus(201);
        $response->assertJsonFragment($this->brands->first()->toArray());
    }

    public function testCanSeeBrands()
    {
        Brand::create($this->brands->first()->toArray());

        $response = $this->get('api/v1/brands');
        $response->assertStatus(200);
        $response->assertJsonFragment($this->brands->first()->toArray());
    }

    public function testCanUpdateBrands()
    {
        $brand = $this->brands->first();
        $createdBrand = Brand::create($brand->toArray());
        $createdBrand->name = 'Ford';
        $createdBrand->deleted_at = null;

        $response = $this->json('PATCH', 'api/v1/brands/' . $createdBrand->id, $createdBrand->toArray());

        $response->assertStatus(201);
        $response->assertJson($createdBrand->toArray());
    }

    public function testCanDeleteBrand()
    {
        $brand = $this->brands->first();
        $createdBrand = Brand::create($brand->toArray());

        $response = $this->json('DELETE', 'api/v1/brands/' . $createdBrand->id);

        $response->assertStatus(200);
        $this->assertTrue(null !== $createdBrand->withTrashed()->find($createdBrand->id)->deleted_at);
    }
}
