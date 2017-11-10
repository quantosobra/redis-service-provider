<?php

namespace QuantoSobra\Silex\Redis;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class RedisServiceProvider implements ServiceProviderInterface
{
    const REDIS = 'redis';
    const REDIS_OPTIONS = 'redis.options';
    const OPT_HOST = 'host';
    const OPT_PORT = 'port';
    const OPT_TIMEOUT = 'timeout';
    const OPT_PERSISTENT = 'persistent';
    const OPT_AUTH = 'auth';
    const OPT_SERIALIZER = 'serializer';
    const OPT_PREFIX = 'prefix';
    const OPT_DATABASE = 'database';

    public function register(Container $container)
    {
        $options = new OptionsLoader($container, RedisServiceProvider::REDIS_OPTIONS);

        $container[static::REDIS] = function() use ($options) {
            $host = $options->getStringOption(RedisServiceProvider::OPT_HOST, 'localhost');
            $port = $options->getIntOption(RedisServiceProvider::OPT_PORT, 6379);
            $timeout = $options->getIntOption(RedisServiceProvider::OPT_TIMEOUT, 0);
            $persistent = $options->getBoolOption(RedisServiceProvider::OPT_PERSISTENT, false);
            $auth = $options->getStringOption(RedisServiceProvider::OPT_AUTH, null);
            $serializer = $options->getIntOption(RedisServiceProvider::OPT_SERIALIZER, null);
            $prefix = $options->getStringOption(RedisServiceProvider::OPT_PREFIX, null);
            $database = $options->getIntOption(RedisServiceProvider::OPT_DATABASE, null);

            $redis = new \Redis();

            if ($persistent) {
                $redis->pconnect($host, $port, $timeout);
            }
            else {
                $redis->connect($host, $port, $timeout);
            }

            if ($auth !== null) {
                $redis->auth($auth);
            }

            if ($database !== null) {
                $redis->select($database);
            }

            if ($serializer !== null) {
                $redis->setOption(\Redis::OPT_SERIALIZER, $serializer);
            }

            if ($prefix !== null) {
                $redis->setOption(\Redis::OPT_PREFIX, $prefix);
            }

            return $redis;
        };
    }
}
