# Laravel 4/5 Internal Queue Driver

## Push a function to the background.

This is internal queue which store queue into database.
The only difference is that the closure is sent to the background without waiting for the response.
This package is more usable as an alternative for running incidental tasks in the background, without setting up a 'real' queue driver.

### Install

Require the latest version of this package with Composer

    composer require armxy/laravel-internal-queue

Add the Service Provider to the providers array in config/app.php

    'Armxy\Queue\InternalQueueServiceProvider',

You need to run the migrations for this package

    $ php artisan migrate --package="armxy/laravel-internal-queue"

Or publish them, so they are copied to your regular migrations

    $ php artisan migrate:publish armxy/laravel-internal-queue

You should now be able to use the internal driver in config/queue.php

    'default' => 'internal',

    'connections' => array(
        ...
        'internal' => array(
            'driver' => 'internal',
        ),
        ...
    }

By default, `php` is used as the binary path to PHP. You can change this by adding the `binary` option to the queue config. You can also add extra arguments (for HHVM for example)

    'connections' => array(
        ...
        'internal' => array(
            'driver' => 'internal',
            'binary' => 'php',
            'binary_args' => '',
        ),
        ...
    }

It should work the same as the sync driver, so no need to run a queue listener. Downside is that you cannot actually queue or plan things.
Queue::later() is also fired directly, but just runs `sleep($delay)` in background..
For more info see http://laravel.com/docs/queues

