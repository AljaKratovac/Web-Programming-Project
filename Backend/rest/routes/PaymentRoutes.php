<?php
/**
 * @OA\Get(
 *      path="/payments",
 *      tags={"payments"},
 *      summary="Get all payments",
 *      @OA\Parameter(
 *          name="user_id",
 *          in="query",
 *          required=false,
 *          @OA\Schema(type="integer"),
 *          description="Optional user ID to filter payments"
 *      ),
 *      @OA\Parameter(
 *          name="status",
 *          in="query",
 *          required=false,
 *          @OA\Schema(type="string"),
 *          description="Optional status to filter payments"
 *      ),
 *      @OA\Response(
 *           response=200,
 *           description="Array of all payments in the database"
 *      )
 * )
 */
Flight::route('GET /payments/@id', function($id){
   Flight::json(Flight::paymentService()->getById($id));
});


/**
 * @OA\Post(
 *     path="/payments",
 *     tags={"payments"},
 *     summary="Add a new payment",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"user_id", "amount", "payment_method"},
 *             @OA\Property(property="user_id", type="integer", example=1),
 *             @OA\Property(property="amount", type="number", format="float", example=25.50),
 *             @OA\Property(property="payment_method", type="string", example="credit_card"),
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="New payment created"
 *     )
 * )
 */
Flight::route('POST /payments', function(){
   $data = Flight::request()->data->getData();
   Flight::json(Flight::paymentService()->addPayment($data));
});

/**
 * @OA\Put(
 *     path="/payment/{id}",
 *     tags={"payments"},
 *     summary="Update an existing payment by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Payment ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"user_id", "amount", "payment_method"},
 *             @OA\Property(property="user_id", type="integer", example=1),
 *             @OA\Property(property="amount", type="number", format="float", example=30.75),
 *             @OA\Property(property="payment_method", type="string", example="paypal"),
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Payment updated"
 *     )
 * )
 */
Flight::route('PUT /payments/@id', function($id){
   $data = Flight::request()->data->getData();
   Flight::json(Flight::paymentService()->updatePayment($id, $data));
});

/**
 * @OA\Patch(
 *     path="/payment/{id}",
 *     tags={"payments"},
 *     summary="Partially update a payment by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Payment ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="string", example="completed"),
 *             @OA\Property(property="amount", type="number", format="float", example=28.25),
 *             @OA\Property(property="payment_method", type="string", example="PayPal"),
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Payment partially updated"
 *     )
 * )
 */
Flight::route('PATCH /payments/@id', function($id){
    $data = Flight::request()->data->getData();
    Flight::json(Flight::paymentService()->partial_update_payment($id, $data));
});

/**
 * @OA\Delete(
 *     path="/payment/{id}",
 *     tags={"payments"},
 *     summary="Delete a payment by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Payment ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Payment deleted"
 *     )
 * )
 */
Flight::route('DELETE /payments/@id', function($id){
   Flight::json(Flight::paymentService()->deletePayment($id));
});
?>