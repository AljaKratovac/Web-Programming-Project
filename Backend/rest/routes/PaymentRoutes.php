<?php
// Get a specific payment by ID
Flight::route('GET /payment/@id', function($id){
   Flight::json(Flight::UserService()->get_payment_by_id($id));
});

// Add a new payment..
Flight::route('POST /payment', function(){
   $data = Flight::request()->data->getData();
   Flight::json(Flight::PaymentService()->add_payment($data));
});
// Update user by ID
Flight::route('PUT /payment/@id', function($id){
   $data = Flight::request()->data->getData();
   Flight::json(Flight::PaymentService()->update_payment($id, $data));
});
// Partially update user by ID
Flight::route('PATCH /payment/@id', function($id){
   $data = Flight::request()->data->getData();
   Flight::json(Flight::PaymentService()->partial_payment_user($id, $data));
});
// Delete user by ID
Flight::route('DELETE /payment/@id', function($id){
   Flight::json(Flight::PaymentService()->delete_payment($id));
});
?>