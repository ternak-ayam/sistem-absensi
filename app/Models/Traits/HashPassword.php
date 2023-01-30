<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

trait HashPassword
{
    public static function bootHashPassword(): void
    {
        static::saving(function (Model $model) {
            $model->setAttribute($model->column(), Hash::needsRehash($model->{$model->column()}) ? Hash::make($model->{$model->column()}) : $model->{$model->column()});
        });
    }

    public function column(): string
    {
        return 'password';
    }
}
