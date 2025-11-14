<?php

/**
 * @OA\Get(
 *     path="/cart/{id}",
 *     tags={"carts"},
 *     summary="Get cart by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the cart",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Returns the cart with the given ID"
 *     )
 * )
 */
Flight::route('GET /cart/@id', function($id){ 
    Flight::json(Flight::cartService()->getById($id));
});

/**
 * @OA\Post(
 *     path="/cart",
 *     tags={"carts"},
 *     summary="Add a new cart",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"user_id"},
 *             @OA\Property(property="user_id", type="integer", example=1),
 *             @OA\Property(property="cart_id", type="integer", example=1),
 *             @OA\Property(property="quantity", type="number", format="float", example=25.50),
 *       
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
    Flight::json(Flight::cartService()->addTocart($data));
});

/**
 * @OA\Put(
 *     path="/cart/{id}",
 *     tags={"carts"},
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
 *             @OA\Property(property="cart_id", type="integer", example=1),
 *             @OA\Property(property="quantity", type="number", format="float", example=30.75),
 *  
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
 * @OA\Patch(
 *     path="/cart/{id}",
 *     tags={"carts"},
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
 *             @OA\Property(property="cart_id", type="integer", example=2),
 *             @OA\Property(property="quantity", type="number", format="float", example=35.25),
 *     
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
 * @OA\Delete(
 *     path="/cart/{id}",
 *     tags={"carts"},
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