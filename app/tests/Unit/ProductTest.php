<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Product;

class ProductTest extends TestCase
{

    public $product;
  
    public function setUp()
    {
        $this->product = new Product('Fallout 4', 59);
    }


    public function test_product_has_name()
    {
        $this->assertEquals('Fallout 4', $this->product->name());
    }

    public function test_product_has_cost()
    {
        $this->assertEquals(59, $this->product->cost());
    }
}
