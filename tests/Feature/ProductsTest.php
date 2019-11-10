<?php

namespace Tests\Feature;

use App\Product;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductsTest extends TestCase
{
    use RefreshDatabase;

    private function data()
    {
        return [
            'name' => 'Cool Product',
            'quantity' => 2,
            'price' => 200,
            'description' => 'Cool super cool, Cool super cool, Cool super cool,',
            'min_order' => 2,
            'max_order' => 2,
        ];
    }

    /** 
     * @test 
     * **/
    public function a_product_can_be_added()
    {
        $this->withoutExceptionHandling();
        $response = $this->post('/api/products', $this->data());
        $response->assertOk();
        $this->assertCount(1, Product::all());
        // $response->assertStatus(201); TODO: check issue
    }

    /**  
     * @test 
     * **/
    public function fields_are_required()
    {
        collect(['name', 'quantity', 'price', 'min_order', 'max_order'])
            ->each(function ($field) {
                $response = $this->post('/api/products',
                    array_merge($this->data(), [$field => '']));

                $response->assertSessionHasErrors($field);
                $this->assertCount(0, Product::all());
            });
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
            'description' => 'Cool super cool, Cool super cool, Cool super cool,',
            'min_order' => 2,
            'max_order' => 2,
        ]);

        $this->assertEquals('Super Cool Product', Product::first()->name);
        $this->assertEquals(3, Product::first()->quantity);
        $this->assertEquals(300, Product::first()->price);
    }

    /** 
     * @test 
     * **/
    public function a_product_can_be_deleted()
    {
        $this->withoutExceptionHandling();
        $this->post('/api/products/', [
            'name' => 'Super Cool Product',
            'quantity' => 3,
            'price' => 300,
            'description' => 'Cool super cool, Cool super cool, Cool super cool,',
            'min_order' => 2,
            'max_order' => 2,
        ]);
        $this->assertCount(1, Product::all());
        $product = Product::first();
        $this->delete('/api/products/'.$product->id);
        $this->assertCount(0, Product::all());
    }

    /** 
     * @test 
     * **/
    public function lists_of_product_can_be_retreived()
    {
        $this->withoutExceptionHandling();
        factory(Product::class, 5)->create();
        $response = $this->get('/api/products');
        $response->assertJsonCount(1)
            ->assertJson([
                'data' => [
                    [
                        'product_id' => 1,
                        'created_at' => '1 second ago',
                        'updated_at' => '1 second ago'
                    ],
                    [
                        'product_id' => 2
                    ],
                ]
            ]);
    }

}
