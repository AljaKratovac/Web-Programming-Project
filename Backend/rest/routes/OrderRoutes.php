<?php
/**
 * GET all orders
 * @OA\Get(
 *     path="/orders",
 *     tags={"orders"},
 *     summary="Get all orders",
 *     @OA\Parameter(
 *         name="user_id",
 *         in="query",
 *         required=false,
 *         description="Optional user ID to filter orders",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Parameter(
 *         name="status",
 *         in="query",
 *         required=false,
 *         description="Optional status to filter orders",
 *         @OA\Schema(type="string")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Array of all orders in the database"
 *     )
 * )
 */
Flight::route('GET /orders', function(){
    $query = Flight::request()->query->getData();
    Flight::json(Flight::orderService()->getAll($query));
});

/**
 * GET order by ID
 * @OA\Get(
 *     path="/orders/{id}",
 *     tags={"orders"},
 *     summary="Get an order by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Order ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Details of a single order"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Order not found"
 *     )
 * )
 */
Flight::route('GET /orders/@id', function($id){
    Flight::json(Flight::orderService()->getById($id));
});

/**
 * POST a new order
 * @OA\Post(
 *     path="/orders",
 *     tags={"orders"},
 *     summary="Add a new order",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="user_id", type="integer", example=1),
 *             @OA\Property(property="unit_price", type="number", format="float", example=45.75),
 *             @OA\Property(property="quantityOrdered", type="integer", example=5),
 *             @OA\Property(property="total_price", type="number", format="float", example=228.75)
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="New order created"
 *     )
 * )
 */
Flight::route('POST /orders', function(){
    $data = Flight::request()->data->getData();
    Flight::json(Flight::orderService()->addOrders($data));
});

/**
 * PUT update an existing order
 * @OA\Put(
 *     path="/orders/{id}",
 *     tags={"orders"},
 *     summary="Update an existing order by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Order ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="user_id", type="integer", example=1),
 *             @OA\Property(property="unit_price", type="number", format="float", example=45.75),
 *             @OA\Property(property="quantityOrdered", type="integer", example=5),
 *             @OA\Property(property="total_price", type="number", format="float", example=228.75)
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Order updated"
 *     )
 * )
 */
Flight::route('PUT /orders/@id', function($id){
    $data = Flight::request()->data->getData();
    Flight::json(Flight::orderService()->updateOrder($id, $data));
});

/**
 * PATCH partially update an order
 * @OA\Patch(
 *     path="/orders/{id}",
 *     tags={"orders"},
 *     summary="Partially update an order by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Order ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="user_id", type="integer", example=1),
 *             @OA\Property(property="unit_price", type="number", format="float", example=80.0),
 *             @OA\Property(property="quantityOrdered", type="integer", example=5),
 *             @OA\Property(property="total_price", type="number", format="float", example=400.0)
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Order partially updated"
 *     )
 * )
 */
Flight::route('PATCH /orders/@id', function($id){
    $data = Flight::request()->data->getData();
    Flight::json(Flight::orderService()->partial_update_order($id, $data));
});

/**
 * DELETE an order
 * @OA\Delete(
 *     path="/orders/{id}",
 *     tags={"orders"},
 *     summary="Delete an order by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Order ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Order deleted"
 *     )
 * )
 */
Flight::route('DELETE /orders/@id', function($id){
    Flight::json(Flight::orderService()->deleteOrder($id));
});