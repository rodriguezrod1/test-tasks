<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Movements;
use App\Models\Product;
use Illuminate\Http\Request;
use Tests\TestCase;

class MovementControllerTest extends TestCase
{

    /** @test */
    public function index_method_returns_all_movements()
    {
        // Step 1: Truncate the Products and Movements tables to ensure a clean state for the test
        Product::truncate();
        Movements::truncate();

        // Step 2: Create a test product
        $product1 = Product::create([
            'name' => 'Product 1',
            'description' => 'Product 1 description',
            'price' => 100,
            'quantity' => 10,
        ]);

        // Step 3: Create a movement for the test product
        Movements::create([
            'product_id' => $product1->id,
            'quantity' => 1,
        ]);

        // Step 4: Send a GET request to the '/api/movements' endpoint
        $response = $this->get('/api/movements');

        // Step 5: Check that the response status code is 200 (OK)
        $response->seeStatusCode(200);

        // Step 6: Decode the response content from JSON to an array
        $data = json_decode($response->response->getContent(), true);

        // Step 7: Assert that the response contains one movement
        $this->assertCount(1, $data['data']);

        // Step 8: Assert that the product ID in the response matches the ID of the test product
        $this->assertEquals($product1->id, $data['data'][0]['product_id']);
    }



    /** @test */
    public function store_method_creates_a_new_movement_and_updates_product_quantity()
    {
        // Step 1: Truncate the Products and Movements tables to ensure a clean state for the test
        Product::truncate();
        Movements::truncate();

        // Step 2: Create a test product
        $product = Product::create([
            'name' => 'Product 3',
            'description' => 'Product 3 description',
            'price' => 300,
            'quantity' => 30,
        ]);

        // Step 3: Create a new request with the data for the new movement
        $request = new Request([
            'product_id' => $product->id,
            'quantity' => 3,
        ]);

        // Step 4: Send a POST request to the '/api/movements' endpoint with the new movement data
        $response = $this->post('/api/movements', $request->all());

        // Step 5: Check that the response status code is 200 (OK)
        $response->seeStatusCode(200);

        // Step 6: Decode the response content from JSON to an array
        $data = json_decode($response->response->getContent(), true);

        // Step 7: Assert that the response contains a new movement ID
        $this->assertNotEmpty($data['data']['id']);

        // Step 8: Assert that the product ID and quantity in the response match the expected values
        $this->assertEquals($product->id, $data['data']['product_id']);
        $this->assertEquals($request->quantity, $data['data']['quantity']);

        // Step 9: Retrieve the newly updated product from the database
        $newProduct = Product::find($product->id);

        // Step 10: Assert that the quantity of the newly updated product matches the expected value
        $this->assertEquals($newProduct->quantity, $product->quantity - $data['data']['quantity']);
    }
}
