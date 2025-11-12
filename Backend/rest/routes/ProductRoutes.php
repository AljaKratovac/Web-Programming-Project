<?php
// Get a specific product by ID
Flight::route('GET /product/@id', function($id){
   Flight::json(Flight::UserService()->get_product_by_id($id));
});

// Add a new product ..
Flight::route('POST /product', function(){
   $data = Flight::request()->data->getData();
   Flight::json(Flight::ProductService()->add_product($data));
});
// Update product  by ID
Flight::route('PUT /user/@id', function($id){
   $data = Flight::request()->data->getData();
   Flight::json(Flight::UserService()->update_user($id, $data));
});
// Partially update product  by ID
Flight::route('PATCH /user/@id', function($id){
   $data = Flight::request()->data->getData();
   Flight::json(Flight::UserService()->partial_update_user($id, $data));
});
// Delete product by ID
Flight::route('DELETE /user/@id', function($id){
   Flight::json(Flight::UserService()->delete_user($id));
});
?>