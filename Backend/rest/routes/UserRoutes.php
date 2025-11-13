<?php
// Get a specific user by ID
Flight::route('GET /users/@id', function($id){
   Flight::json(Flight::userService()->getById($id));
});
// Get a users
Flight::route('GET /users', function(){
   Flight::json(Flight::userService()->getAllUsers());
});
// Add a new user..
Flight::route('POST /user', function(){
   $data = Flight::request()->data->getData();
   Flight::json(Flight::userService()->add_user($data));
});
// Update user by ID
Flight::route('PUT /user/@id', function($id){
   $data = Flight::request()->data->getData();
   Flight::json(Flight::userService()->update_user($id, $data));
});
// Partially update user by ID
Flight::route('PATCH /user/@id', function($id){
   $data = Flight::request()->data->getData();
   Flight::json(Flight::userService()->partial_update_user($id, $data));
});
// Delete user by ID
Flight::route('DELETE /user/@id', function($id){
   Flight::json(Flight::userService()->delete_user($id));
});
?>