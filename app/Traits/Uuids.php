<?php

namespace App\Traits;

use Illuminate\Support\Str;
use Modules\Academics\Entities;

trait Uuids
{
    /**
     * Boot function from Laravel.
     */


    /*
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = Str::uuid()->toString();
            }
//            if (empty($model->{$model->getKeyName()})) {
//                $model->{$model->getKeyName()} = Str::uuid()->toString();
//            }


        });
    */


    /*
        static::updating(function ($model) {

            if (empty($model->uuid)) {
                $model->uuid = Str::uuid()->toString();
            }
//            if (empty($model->{$model->getKeyName()})) {
//                $model->{$model->getKeyName()} = Str::uuid()->toString();
//            }


        });
    }
*/
    /**
     * Get the value indicating whether the IDs are incrementing.
     *
     * @return bool
     */

    /*
    public function getIncrementing()
    {
        return false;
    }
    */

    /**
     * Get the auto-incrementing key type.
     *
     * @return string
     */


    public function getKeyType()
    {
        return 'string';
    }


    protected static function bootUuids()
    {
        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = Str::uuid();
            }

        });

        static::updating(function ($model) {

            if (empty($model->uuid)) {
                $model->uuid = Str::uuid();
            }
        });
    }



}
