<?php

function createServer()
{
    $m = new Memcached();
    $m->addServer("10.10.10.13", 11211);
    return $m;
}

function set($key, $value, $expiration = 3600) 
{
    $m = createServer();

    return $m->set($key, $value, $expiration);
}

function get($key)
{
    $m = createServer();

    return $m->get($key);
}

?>
