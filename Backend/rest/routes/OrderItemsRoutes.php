<?php
/**
 * @OA\Get(
 *      path="/orderItems",
 *      tags={"order-items"},
 *      summary="Get all order items",
 *      @OA\Parameter(
 *          name="order_id",
 *          in="query",
 *          required=false,
 *          @OA\Schema(type="integer"),
 *          description="Optional order ID to filter order items"
 *      ),
 *      @OA\Parameter(
 *          name="product_id",
 *          in="query",
 *          required=false,
 *          @OA\Schema(type="integer"),
 *          description="Optional product ID to filter order items"
 *      ),
 *      @OA\Response(
 *           response=200,
 *           description="Array of all order items in the database"
 *      )
 * )
 */
Flight::route('GET /orderItems/@id', function($id){
   Flight::json(Flight::orderItemsService()->getById($id));
});



/**
 * @OA\Post(
 *     path="/orderItems",
 *     tags={"order-items"},
 *     summary="Add a new order item",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"order_id", "product_id", "quantity", "price"},
 *             @OA\Property(property="order_id", type="integer", example=1),
 *             @OA\Property(property="product_id", type="integer", example=1),
 *             @OA\Property(property="quantityOrderd", type="integer", example=2),
 *             @OA\Property(property="unit_price", type="number", format="float", example=12.99),
 *             @OA\Property(property="total_price", type="number", format="float", example=25.98)
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="New order item created"
 *     )
 * )
 */
Flight::route('POST /orderItems', function(){
   $data = Flight::request()->data->getData();
   Flight::json(Flight::orderItemsService()->addOrderItem($data));
});

/**
 * @OA\Put(
 *     path="/orderItems/{id}",
 *     tags={"order-items"},
 *     summary="Update an existing order item by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Order item ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"order_id", "product_id", "quantity", "price"},
 *             @OA\Property(property="order_id", type="integer", example=3),
 *             @OA\Property(property="product_id", type="integer", example=5),
 *             @OA\Property(property="quantityOrderd", type="integer", example=6),
 *             @OA\Property(property="unit_price", type="number", format="float", example=70.00),
 *             @OA\Property(property="total_price", type="number", format="float", example=40.00)
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Order item updated"
 *     )
 * )
 */
Flight::route('PUT /orderItems/@id', function($id){
   $data = Flight::request()->data->getData();
   Flight::json(Flight::orderItemsService()->updateOrderItem($id, $data));
});

/**
 * @OA\Patch(
 *     path="/orderItems/{id}",
 *     tags={"order-items"},
 *     summary="Partially update an order item by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Order item ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="order_id", type="integer", example=3),
 *             @OA\Property(property="product_id", type="integer", example=5),
 *             @OA\Property(property="quantityOrderd", type="integer", example=6),
 *             @OA\Property(property="unit_price", type="number", format="float", example=70.00),
 *             @OA\Property(property="total_price", type="number", format="float", example=40.00)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Order item partially updated"
 *     )
 * )
 */
Flight::route('PATCH /orderItems/@id', function($id){
   $data = Flight::request()->data->getData();
   Flight::json(Flight::orderItemsService()->partial_update_orderItems($id, $data));
});

/**
 * @OA\Delete(
 *     path="/orderItems/{id}",
 *     tags={"order-items"},
 *     summary="Delete an order item by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Order item ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Order item deleted"
 *     )
 * )
 */
Flight::route('DELETE /orderItems/@id', function($id){
   Flight::json(Flight::orderItemsService()->deleteOrderItem($id));
});
?>