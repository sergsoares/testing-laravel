<?php

namespace App;

class Order 
{
    protected $products = [];

    public function addProduct($product)
    {
        $this->products[] = $product;  
    }

    public function products()
    {
        return $this->products; 
    }

    public function totalCost()
    {
        $totalCost = array_reduce($this->products, function($total, $product){
            return $total += $product->cost();
        });

        return $totalCost;
    }

}
