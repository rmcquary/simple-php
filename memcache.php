<?php

function createServer()
{
    $m = new Memcached();

    $m->setOption(Memcached::OPT_CLIENT_MODE, Memcached::DYNAMIC_CLIENT_MODE);
    $m->addServer('10.251.48.67', 11211);

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
