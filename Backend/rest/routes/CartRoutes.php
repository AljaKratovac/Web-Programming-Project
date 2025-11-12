<?php
// Get a specific cart by ID
Flight::route('GET /cart/@id', function($id){
   Flight::json(Flight::CartService()->get_cart_by_id($id));
});

// Add a new cart..
Flight::route('POST /cart', function(){
   $data = Flight::request()->data->getData();
   Flight::json(Flight::CartService()->add_cart($data));
});
// Update cart by ID
Flight::route('PUT /cart/@id', function($id){
   $data = Flight::request()->data->getData();
   Flight::json(Flight::CartService()->update_cart($id, $data));
});
// Partially update cart by ID
Flight::route('PATCH /cart/@id', function($id){
   $data = Flight::request()->data->getData();
   Flight::json(Flight::CartService()->partial_cart_user($id, $data));
});
// Delete cart by ID
Flight::route('DELETE /cart/@id', function($id){
   Flight::json(Flight::CartService()->delete_cart($id));
});
?>