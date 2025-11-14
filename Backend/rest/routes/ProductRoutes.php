<?php
/**
 * @OA\Get(
 *      path="/product",
 *      tags={"products"},
 *      summary="Get all products",
 *      @OA\Parameter(
 *          name="category",
 *          in="query",
 *          required=false,
 *          @OA\Schema(type="string"),
 *          description="Optional category to filter products"
 *      ),
 *      @OA\Parameter(
 *          name="product_id",
 *          in="query",
 *          required=false,
 *          @OA\Schema(type="integer"),
 *          description="Optional restaurant ID to filter products"
 *      ),
 *      @OA\Response(
 *           response=200,
 *           description="Array of all products in the database"
 *      )
 * )
 */
Flight::route('GET /products/@id', function($id){
   Flight::json(Flight::productService()->getById($id));
});



/**
 * @OA\Post(
 *     path="/product",
 *     tags={"products"},
 *     summary="Add a new product",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"name", "price", "restaurant_id"},
 *             @OA\Property(property="name", type="string", example="Bag44"),
 *             @OA\Property(property="price", type="number", format="float", example=12.99),
 *             @OA\Property(property="stock_quantity", type="integer", example=3),
 *             @OA\Property(property="description", type="string", example="topic"),
 *             @OA\Property(property="image_url", type="string", example="https://example.com/pizza.jpg")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="New product created"
 *     )
 * )
 */
Flight::route('POST /products', function(){
    $data = Flight::request()->data->getData();
    Flight::json(Flight::productService()->insertProduct($data));
});

/**
 * @OA\Put(
 *     path="/product/{id}",
 *     tags={"products"},
 *     summary="Update an existing product by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Product ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"name", "price", "id"},
 *             @OA\Property(property="name", type="string", example="Bag"),
 *             @OA\Property(property="price", type="number", format="float", example=15.99),
 *             @OA\Property(property="stock_quantity", type="integer", example=1),
 *             @OA\Property(property="description", type="string", example="Updated description"),
 *             @OA\Property(property="image_url", type="string", example="https://example.com/new-pizza.jpg")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Product updated"
 *     )
 * )
 */
Flight::route('PUT /products/@id', function($id){
    $data = Flight::request()->data->getData();
    Flight::json(Flight::productService()->updateProduct($id, $data));
});

/**
 * @OA\Patch(
 *     path="/product/{id}",
 *     tags={"products"},
 *     summary="Partially update a product by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Product ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="name", type="string", example="Only name changed"),
 *             @OA\Property(property="price", type="number", format="float", example=13.99),
 *             @OA\Property(property="category", type="string", example="Updated Category"),
 *             @OA\Property(property="description", type="string", example="Only description updated")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Product partially updated"
 *     )
 * )
 */
Flight::route('PATCH /products/@id', function($id){
    $data = Flight::request()->data->getData();
    Flight::json(Flight::productService()->partial_update_product($id, $data));
});

/**
 * @OA\Delete(
 *     path="/product/{id}",
 *     tags={"products"},
 *     summary="Delete a product by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Product ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Product deleted"
 *     )
 * )
 */
Flight::route('DELETE /products/@id', function($id){
    Flight::json(Flight::productService()->deleteProduct($id));
});
?>