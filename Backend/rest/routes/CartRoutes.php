<?php
/**
 * GET all carts
 * @OA\Get(
 *     path="/cart",
 *     tags={"cart"},
 *     summary="Get all carts",
 *     @OA\Parameter(
 *         name="user_id",
 *         in="query",
 *         required=false,
 *         description="Optional user ID to filter carts",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Array of all carts in the database"
 *     )
 * )
 */
Flight::route('GET /cart', function(){
    $query = Flight::request()->query->getData();
    Flight::json(Flight::cartService()->getAll($query));
});

/**
 * GET cart by ID
 * @OA\Get(
 *     path="/cart/{id}",
 *     tags={"cart"},
 *     summary="Get a cart by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Cart ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Returns the cart with the given ID"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Cart not found"
 *     )
 * )
 */
Flight::route('GET /cart/@id', function($id){ 
    Flight::json(Flight::cartService()->getById($id));
});

/**
 * POST a new cart
 * @OA\Post(
 *     path="/cart",
 *     tags={"cart"},
 *     summary="Add a new cart",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"user_id"},
 *             @OA\Property(property="user_id", type="integer", example=1),
 *             @OA\Property(property="product_id", type="integer", example=1),
 *             @OA\Property(property="quantity", type="number", format="float", example=25.50)
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="New cart created"
 *     )
 * )
 */
Flight::route('POST /cart', function(){
    $data = Flight::request()->data->getData();
    Flight::json(Flight::cartService()->addToCart($data));
});

/**
 * PUT update a cart
 * @OA\Put(
 *     path="/cart/{id}",
 *     tags={"cart"},
 *     summary="Update an existing cart by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Cart ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"user_id"},
 *             @OA\Property(property="user_id", type="integer", example=1),
 *             @OA\Property(property="product_id", type="integer", example=1),
 *             @OA\Property(property="quantity", type="number", format="float", example=30.75)
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Cart updated"
 *     )
 * )
 */
Flight::route('PUT /cart/@id', function($id){
    $data = Flight::request()->data->getData();
    Flight::json(Flight::cartService()->updateCart($id, $data));
});

/**
 * PATCH partially update a cart
 * @OA\Patch(
 *     path="/cart/{id}",
 *     tags={"cart"},
 *     summary="Partially update a cart by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Cart ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="user_id", type="integer", example=1),
 *             @OA\Property(property="product_id", type="integer", example=2),
 *             @OA\Property(property="quantity", type="number", format="float", example=35.25)
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Cart partially updated"
 *     )
 * )
 */
Flight::route('PATCH /cart/@id', function($id){
    $data = Flight::request()->data->getData();
    Flight::json(Flight::cartService()->partial_cart_update($id, $data));
});

/**
 * DELETE a cart
 * @OA\Delete(
 *     path="/cart/{id}",
 *     tags={"cart"},
 *     summary="Delete a cart by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Cart ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Cart deleted"
 *     )
 * )
 */
Flight::route('DELETE /cart/@id', function($id){
    Flight::json(Flight::cartService()->deleteCart($id));
});
?>
