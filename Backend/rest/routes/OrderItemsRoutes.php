<?php
// Get a specific order items by ID
Flight::route('GET /orderItems/@id', function($id){
   Flight::json(Flight::OrderItemsService()->get_orderItems_by_id($id));
});

// Add a new order item..
Flight::route('POST /orderItems', function(){
   $data = Flight::request()->data->getData();
   Flight::json(Flight::OrderItemsService()->add_orderItems($data));
});
// Update order item by ID
Flight::route('PUT /orderItems/@id', function($id){
   $data = Flight::request()->data->getData();
   Flight::json(Flight::OrderItemsService()->update_orderItems($id, $data));
});
// Partially update order item by ID
Flight::route('PATCH /orderItems/@id', function($id){
   $data = Flight::request()->data->getData();
   Flight::json(Flight::OrderItemsService()->partial_orderItems_user($id, $data));
});
// Delete order item by ID
Flight::route('DELETE /orderItems/@id', function($id){
   Flight::json(Flight::OrderItemsService()->delete_orderItems($id));
});
?>