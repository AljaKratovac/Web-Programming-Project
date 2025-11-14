<?php
/**
 * @OA\Get(
 *      path="/order",
 *      tags={"orders"},
 *      summary="Get all orders",
 *      @OA\Parameter(
 *          name="user_id",
 *          in="query",
 *          required=false,
 *          @OA\Schema(type="integer"),
 *          description="Optional user ID to filter orders"
 *      ),
 *      @OA\Parameter(
 *          name="status",
 *          in="query",
 *          required=false,
 *          @OA\Schema(type="string"),
 *          description="Optional status to filter orders"
 *      ),
 *      @OA\Parameter(
 *          name="restaurant_id",
 *          in="query",
 *          required=false,
 *          @OA\Schema(type="integer"),
 *          description="Optional restaurant ID to filter orders"
 *      ),
 *      @OA\Response(
 *           response=200,
 *           description="Array of all orders in the database"
 *      )
 * )
 */
Flight::route('GET /order/@id', function($id){
   Flight::json(Flight::orderService()->getById($id));
});

/**
 * @OA\Post(
 *     path="/order",
 *     tags={"orders"},
 *     summary="Add a new order",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"order_id", "restaurant_id", "total_amount"},
 *             @OA\Property(property="user_id", type="integer", example=1),
 *             @OA\Property(property="unit_price", type="number", format="float", example=45.75),         
 *             @OA\Property(property="quantityOrderd", type="integer", example="5"),
 *             @OA\Property(property="total_price", type="integer", example="50")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="New order created"
 *     )
 * )
 */
Flight::route('POST /order', function(){
   $data = Flight::request()->data->getData();
   Flight::json(Flight::orderService()->addOrders($data));
});

/**
 * @OA\Put(
 *     path="/order/{id}",
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
 *             required={"user_id", "restaurant_id", "total_amount"},
 *             @OA\Property(property="user_id", type="integer", example=1),
 *             @OA\Property(property="unit_price", type="number", format="float", example=45.75),         
 *             @OA\Property(property="quantityOrderd", type="integer", example="5"),
 *             @OA\Property(property="total_price", type="integer", example="50")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Order updated"
 *     )
 * )
 */
Flight::route('PUT /order/@id', function($id){
   $data = Flight::request()->data->getData();
   Flight::json(Flight::orderService()->updateOrder($id, $data));
});

/**
 * @OA\Patch(
 *     path="/order/{id}",
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
 *         @OA\Property(property="user_id", type="integer", example=1),
 *         @OA\Property(property="unit_price", type="number", format="float", example=80.0),         
 *         @OA\Property(property="quantityOrderd", type="integer", example="5"),
 *         @OA\Property(property="total_price", type="integer", example="50")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Order partially updated"
 *     )
 * )
 */
Flight::route('PATCH /order/@id', function($id){
   $data = Flight::request()->data->getData();
   Flight::json(Flight::orderService()->partial_update_order($id, $data));
});

/**
 * @OA\Delete(
 *     path="/order/{id}",
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
Flight::route('DELETE /order/@id', function($id){
   Flight::json(Flight::orderService()->deleteOrder($id));
});
?>