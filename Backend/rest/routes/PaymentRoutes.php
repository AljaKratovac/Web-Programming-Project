<?php
/**
 * GET all payments
 * @OA\Get(
 *     path="/payments",
 *     tags={"payments"},
 *     summary="Get all payments",
 *     @OA\Parameter(
 *         name="user_id",
 *         in="query",
 *         required=false,
 *         description="Optional user ID to filter payments",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Parameter(
 *         name="status",
 *         in="query",
 *         required=false,
 *         description="Optional status to filter payments",
 *         @OA\Schema(type="string")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Array of all payments in the database"
 *     )
 * )
 */
Flight::route('GET /payments', function(){
    $query = Flight::request()->query->getData(); 
    Flight::json(Flight::paymentService()->getAll($query));
});

/**
 * GET payment by ID
 * @OA\Get(
 *     path="/payments/{id}",
 *     tags={"payments"},
 *     summary="Get a payment by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Payment ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Details of a single payment"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Payment not found"
 *     )
 * )
 */
Flight::route('GET /payments/@id', function($id){
    Flight::json(Flight::paymentService()->getById($id));
});

/**
 * POST a new payment
 * @OA\Post(
 *     path="/payments",
 *     tags={"payments"},
 *     summary="Add a new payment",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             type="object",
 *             required={"user_id", "amount", "payment_method"},
 *             @OA\Property(property="user_id", type="integer", example=1),
 *             @OA\Property(property="amount", type="number", format="float", example=25.50),
 *             @OA\Property(property="payment_method", type="string", example="credit_card")
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
 * PUT update an existing payment
 * @OA\Put(
 *     path="/payments/{id}",
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
 *             type="object",
 *             required={"user_id", "amount", "payment_method"},
 *             @OA\Property(property="user_id", type="integer", example=1),
 *             @OA\Property(property="amount", type="number", format="float", example=30.75),
 *             @OA\Property(property="payment_method", type="string", example="paypal")
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
 * PATCH partially update a payment
 * @OA\Patch(
 *     path="/payments/{id}",
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
 *             type="object",
 *             @OA\Property(property="status", type="string", example="completed"),
 *             @OA\Property(property="amount", type="number", format="float", example=28.25),
 *             @OA\Property(property="payment_method", type="string", example="paypal")
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
 * DELETE a payment
 * @OA\Delete(
 *     path="/payments/{id}",
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
