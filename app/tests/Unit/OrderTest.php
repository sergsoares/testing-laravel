<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Order;
use App\Product;

class OrderTest extends TestCase
{

    protected $order;

    public function setUp(){
        $this->order = $this->createOrderWithProducts();
    }

    /** @test */
    public function an_order_has_products()
    {
        $result = $this->order->products();

        $this->assertCount(2, $result);
    } 

    public function test_order_obtain_costs_of_total_products()
    {
        $order = $this->createOrderWithProducts();

        $result = $order->totalCost();
        
        $this->assertEquals(42, $result);

    }

    protected function createOrderWithProducts()
    {
        $order = new Order;

        $product1 = new Product('Fallout 4', 30);
        $product2 = new Product('Oblivion', 12);

        $order->addProduct($product1);
        $order->addProduct($product2);

        return $order;
    }

}