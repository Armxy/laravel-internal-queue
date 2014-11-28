<?php
/**
 * Created by PhpStorm.
 * User: Renderer
 * Date: 11/28/2014
 * Time: 12:45 PM
 */

namespace Armxy\Queue\Models;


class InternalQueue extends \Eloquent{

    protected $table = 'laq_async_queue';

    function getFirstQueue(){

        $firstQueue = InternalQueue::where('status', '=', Job::STATUS_OPEN)->orderBy('created_at')->first();

        if(!is_null($firstQueue)){

            $job = Job::find($firstQueue->id);

            return $job;
        }
    }
} 