<?php
require_once "memcache.php";
require_once "mysql.php";

// Define available routes and their corresponding callback functions
$routes = [
    '/'          => 'handle_home',
    '/health'     => 'handle_health',
    '/cache-set' => 'handle_cache_set',
    '/cache-get' => 'handle_cache_get',
    '/db'       => 'handle_db',
    '/nfs'      => 'handle_nfs'
];

// Get the current request URI and remove query parameters
$request_uri = strtok($_SERVER['REQUEST_URI'], '?');

/**
 * Routes the request to the appropriate handler function.
 * 
 * @param string $uri The requested URI.
 * @param array $routes The array of defined routes.
 * @return bool True if a route match was found and handled, false otherwise.
 */
function route_request($uri, $routes) {
    if (array_key_exists($uri, $routes)) {
        // A match was found, call the handler function
        $routes[$uri]();
        return true; // The route was handled
    } else {
        // No match found
        header("HTTP/1.0 404 Not Found");
        echo "<h1>404 Not Found</h1>";
        return false; // The route was not handled
    }
}

// --- Handler Functions ---

function handle_home() {
    echo "Hello, World!";
}

function handle_health() {
    echo "Success!";
}

function handle_cache_set() {
    $value = date('Y-m-d H:i:s');

    if(set("my_key", $value)) {
        echo "Cached value: " . $value;
    } else {
        echo "Failed to cache value!";
    }
}

function handle_cache_get() {
    $value = get("my_key");

    if($value){
        echo $value;
    } else {
        echo "Key not found!";
    }
}

function handle_db()
{
    testConnection();
}

function handle_nfs()
{
    $content = file_get_contents("/mnt/files/hello.txt");

    echo $content;
}

// Run the router
$route_found = route_request($request_uri, $routes);

// You can use the returned boolean value for further logic if needed
if (!$route_found) {
    // Optional: Log the 404 error
    // error_log("404 Not Found for URI: " . $request_uri);
}
?>

