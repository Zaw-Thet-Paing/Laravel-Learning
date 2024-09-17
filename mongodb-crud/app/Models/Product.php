<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use MongoDB\Laravel\Eloquent\Model as EloquentModel;

class Product extends EloquentModel
{
    use HasFactory, SoftDeletes;

    protected $connection = 'mongodb';

    protected $fillable = ['name', 'detail'];
}
