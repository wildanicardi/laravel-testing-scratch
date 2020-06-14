<?php

namespace Tests\Feature;

use App\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{

    /** @test **/
    public function product_has_name()
    {
        $product = new Product('Fallout 4', 59);

        $this->assertEquals('Fallout 4', $product->name());
    }
    /** @test **/
    public function product_has_coast()
    {
        $product = new Product('Fallout 4', 59);

        $this->assertEquals(59, $product->cost());
    }
}
