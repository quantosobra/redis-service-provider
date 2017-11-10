# Redis Service Provider

Redis service provider for Silex/Pimple using [PhpRedis](https://github.com/phpredis/phpredis) extension.


## Usage

Register the service provider in your application and configure Redis options:

```php
use QuantoSobra\Silex\Redis\RedisServiceProvider;

$app->register(new RedisServiceProvider(), [
    RedisServiceProvider::REDIS_OPTIONS => [
        RedisServiceProvider::OPT_HOST => 'localhost',
        RedisServiceProvider::OPT_PORT => 6379,
        RedisServiceProvider::OPT_TIMEOUT => 30,
        RedisServiceProvider::OPT_PERSISTENT => true,
        RedisServiceProvider::OPT_AUTH => 'pas$word',
        RedisServiceProvider::OPT_SERIALIZER => \Redis::SERIALIZER_NONE, // or \Redis::SERIALIZER_PHP or \Redis::SERIALIZER_IGBINARY
        RedisServiceProvider::OPT_PREFIX => 'myprefix:',
        RedisServiceProvider::OPT_DATABASE => 0
    ]
]);
```

## License

This project is developed at [QuantoSobra](https://www.quantosobra.com.br) and licensed under the MIT license.
See the [LICENSE.md](LICENSE.md) file for the full license text.

QuantoSobra &copy; 2017
