<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = [
        'name','min_labels','max_labels'
    ];
}
