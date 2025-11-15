<?php
/**
 * GET all products
 * @OA\Get(
 *     path="/products",
 *     tags={"products"},
 *     summary="Get all products",
 *     @OA\Response(
 *         response=200,
 *         description="Array of all products in the database"
 *     )
 * )
 */
Flight::route('GET /products', function(){
    Flight::json(Flight::productService()->getAll());
});

/**
 * GET product by ID
 * @OA\Get(
 *     path="/products/{id}",
 *     tags={"products"},
 *     summary="Get product by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Product ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Details of a single product"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Product not found"
 *     )
 * )
 */
Flight::route('GET /products/@id', function($id){
    Flight::json(Flight::productService()->getById($id));
});

/**
 * Add a new product
 * @OA\Post(
 *     path="/products",
 *     tags={"products"},
 *     summary="Add a new product",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             type="object",
 *             required={"name","price","id"},
 *             @OA\Property(property="name", type="string", example="Bag44"),
 *             @OA\Property(property="price", type="number", format="float", example=12.99),
 *             @OA\Property(property="stock_quantity", type="integer", example=3),
 *             @OA\Property(property="description", type="string", example="Red bag")                      
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
 * Update an existing product
 * @OA\Put(
 *     path="/products/{id}",
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
 *             type="object",
 *             required={"name","price","id"},
 *             @OA\Property(property="name", type="string", example="Updated Bag"),
 *             @OA\Property(property="price", type="number", format="float", example=15.99),
 *             @OA\Property(property="stock_quantity", type="integer", example=5),
 *             @OA\Property(property="description", type="string", example="Updated description")
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
 * Partially update a product
 * @OA\Patch(
 *     path="/products/{id}",
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
 *             type="object",
 *             @OA\Property(property="name", type="string", example="Partial name update"),
 *             @OA\Property(property="price", type="number", format="float", example=13.99),
 *             @OA\Property(property="stock_quantity", type="integer", example=2),
 *             @OA\Property(property="description", type="string", example="Partial description update")
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
 * Delete a product
 * @OA\Delete(
 *     path="/products/{id}",
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
