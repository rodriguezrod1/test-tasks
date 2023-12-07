<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movements;
use App\Models\Product;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{

    /** @test */
    public function index_method_returns_all_products()
    {
        // Step 1: Truncate the Products table to ensure a clean state for the test
        Product::truncate();

        // Step 2: Create a test product
        $product = new Product;
        $product->name = 'Testing Index';
        $product->description = 'Product description for Index';
        $product->quantity = 10;
        $product->price = 15.5;
        $product->save();

        // Step 3: Send a GET request to the '/api/products' endpoint
        $response = $this->get('/api/products');

        // Step 4: Check that the response status code is 200 (OK)
        $response->seeStatusCode(200);

        // Step 5: Decode the response content from JSON to an array
        $data = json_decode($response->response->getContent(), true);

        // Step 6: Assert that the response contains one product
        $this->assertCount(1, $data['data']);
    }

    /** @test */
    public function store_method_creates_a_new_product()
    {
        // Step 1: Truncate the Products and Movements tables to ensure a clean state for the test
        Product::truncate();
        Movements::truncate();

        // Step 2: Create a test product
        $product = new Product;
        $product->name = 'Testing Sales';
        $product->description = 'Product description for Sales Test';
        $product->quantity = 10;
        $product->price = 12.5;
        $product->save();

        // Step 3: Create a new request with the data for the new product
        $request = new Request([
            'name' => 'Testing Sales',
            'description' => 'Product description for Sales Test edited to exist.',
            'price' => 100,
            'quantity' => 5,
        ]);

        // Step 4: Send a POST request to the '/api/products' endpoint with the new product data
        $response = $this->post('/api/products', $request->all());

        // Step 5: Check that the response status code is 200 (OK)
        $response->seeStatusCode(200);

        // Step 6: Decode the response content from JSON to an array
        $data = json_decode($response->response->getContent(), true);

        // Step 7: Assert that the response contains a new product ID
        $this->assertNotEmpty($data['data']['id']);

        // Step 8: Retrieve the newly created product from the database
        $editProduct = Product::find($product->id);

        // Step 9: Assert that the quantity of the newly created product matches the quantity in the response
        $this->assertEquals($editProduct->quantity, $data['data']['quantity']);

        // Step 10: Retrieve the corresponding movement from the Movements table
        $movement = Movements::find($data['data']['id']);

        // Step 11: Assert that the product ID and quantity in the movement match the expected values
        $this->assertEquals($product->id, $movement->product_id);
        $this->assertEquals(5, $movement->quantity);
    }
}
