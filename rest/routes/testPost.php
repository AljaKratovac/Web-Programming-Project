Flight::route('POST /test-post', function() {
    $data = Flight::request()->data->getData();
    Flight::json(['message' => 'POST is working!', 'data' => $data, 'timestamp' => date('Y-m-d H:i:s')]);
});