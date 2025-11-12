<?php
// Get a specific order by ID
Flight::route('GET /order/@id', function($id){
   Flight::json(Flight::OrderService()->get_order_by_id($id));
});

// Add a new order..
Flight::route('POST /order', function(){
   $data = Flight::request()->data->getData();
   Flight::json(Flight::OrderService()->add_order($data));
});
// Update order by ID
Flight::route('PUT /order/@id', function($id){
   $data = Flight::request()->data->getData();
   Flight::json(Flight::OrderService()->update_order($id, $data));
});
// Partially update order by ID
Flight::route('PATCH /order/@id', function($id){
   $data = Flight::request()->data->getData();
   Flight::json(Flight::OrderService()->partial_order_user($id, $data));
});
// Delete order by ID
Flight::route('DELETE /order/@id', function($id){
   Flight::json(Flight::OrderService()->delete_order($id));
});
?>