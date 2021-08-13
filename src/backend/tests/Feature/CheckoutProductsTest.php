<?php

namespace Tests\Feature;

use App\Order;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CheckoutProductsTest extends TestCase
{
    use RefreshDatabase;
    /** 
     * @test 
     * **/
    public function a_product_can_checkout_order()
    {
        $this->withoutExceptionHandling();
        $response = $this->post('/api/auth/checkout', [
            'total_price' => '200'
        ]);

        $response->assertOk();
        $this->assertCount(1, Order::all());
    }

    /** 
     * @test 
     * **/
    public function total_price_is_required()
    {
        $response = $this->post('/api/auth/checkout', [
            'total_price' => ''
        ]);

        $response->assertSessionHasErrors('total_price');
    }
}
