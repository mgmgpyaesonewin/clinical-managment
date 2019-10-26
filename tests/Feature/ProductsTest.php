<?php

namespace Tests\Feature;

use App\Product;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductsTest extends TestCase
{
    use RefreshDatabase;
    /** 
     * @test 
     * **/
    public function a_product_can_be_added()
    {
        $this->withoutExceptionHandling();
        $response = $this->post('/api/products', [
            'name' => 'Cool Product',
            'quantity' => 2,
            'price' => 200,
            'description' => 'Cool super cool, Cool super cool, Cool super cool,',
            'min_order' => 2,
            'max_order' => 2,
        ]);

        $response->assertOk();
        $this->assertCount(1, Product::all());
    }

    /**  
     * @test 
     * **/
    public function a_name_is_required()
    {
        $response = $this->post('/api/products', [
            'name' => ''
        ]);
        $response->assertSessionHasErrors('name');
    }

    /** 
     * @test 
     * **/
    public function a_product_can_be_updated()
    {
        $this->withoutExceptionHandling();
        $this->post('/api/products', [
            'name' => 'Cool Product',
            'quantity' => 2,
            'price' => 200,
            'description' => 'Cool super cool, Cool super cool, Cool super cool,',
            'min_order' => 2,
            'max_order' => 2,
        ]);    
        $product = Product::first();
        $this->patch('/api/products/' . $product->id, [
            'name' => 'Super Cool Product',
            'quantity' => 3,
            'price' => 300,
        ]);

        $this->assertEquals('Super Cool Product', Product::first()->name);
        $this->assertEquals(3, Product::first()->quantity);
        $this->assertEquals(300, Product::first()->price);
    }
}
