<?php
// app/Models/Route.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    protected $fillable = ['user_id', 'origin', 'destination', 'suggested_route', 'eco_score'];
}
