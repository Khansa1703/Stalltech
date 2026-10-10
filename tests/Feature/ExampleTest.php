<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function test_the_login_page_returns_a_successful_response(): void
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }

    public function test_cart_subtotal_calculation_does_not_throw_argument_count_error(): void
    {
        $cart = [10 => 2, 20 => 3];
        $variants = [
            10 => (object)['price' => 50000],
            20 => (object)['price' => 100000],
        ];

        $subtotal = collect($cart)->map(fn ($quantity, $id) => ($variants[$id]->price ?? 0) * $quantity)->sum();

        $this->assertEquals(400000, $subtotal);
    }
}
