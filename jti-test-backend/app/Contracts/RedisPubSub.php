<?php

namespace App\Contracts;

use Closure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Redis;

class RedisPubSub
{
    protected const PUBSUB_CHANNEL = 'pubsub';

    /**
     * @param  string  $event
     * @param  \Illuminate\Database\Eloquent\Model  $model
     */
    public static function publish($event, Model $model)
    {
        $channelSuffix = config('app.env') === 'testing' ? ':testing' : '';

        Redis::connection('pubsub')->publish(
            config('app.account') . ':' . self::PUBSUB_CHANNEL . $channelSuffix,
            json_encode([
                'event' => config('app.name') . '.' . $event,
                'data' => $model->attributesToArray(),
            ])
        );
    }

    /**
     * @param  \Closure  $successCallback
     * @param  \Closure|null  $errorCallback
     */
    public static function subscribe(Closure $successCallback, Closure|null $errorCallback = null)
    {
        $channelSuffix = config('app.env') === 'testing' ? ':testing' : '';

        Redis::connection('pubsub')->subscribe(
            config('app.account') . ':' . self::PUBSUB_CHANNEL . $channelSuffix,
            function ($message, $channel) use ($successCallback, $errorCallback) {
                try {
                    $parsedMessage = json_decode($message, true);
                    $successCallback($parsedMessage['event'], $parsedMessage['data']);
                } catch (\Exception $ex) {
                    if ($errorCallback)
                        $errorCallback($ex);
                }
            }
        );
    }
}
