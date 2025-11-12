<?php
// Get a specific user by ID
Flight::route('GET /users/@id', function($id){
   Flight::json(Flight::userService()->get_user_by_id($id));
});

// Add a new user..
Flight::route('POST /user', function(){
   $data = Flight::request()->data->getData();
   Flight::json(Flight::UserService()->add_user($data));
});
// Update user by ID
Flight::route('PUT /user/@id', function($id){
   $data = Flight::request()->data->getData();
   Flight::json(Flight::UserService()->update_user($id, $data));
});
// Partially update user by ID
Flight::route('PATCH /user/@id', function($id){
   $data = Flight::request()->data->getData();
   Flight::json(Flight::UserService()->partial_update_user($id, $data));
});
// Delete user by ID
Flight::route('DELETE /user/@id', function($id){
   Flight::json(Flight::UserService()->delete_user($id));
});
?>