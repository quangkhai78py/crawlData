<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Wp_locations extends Model
{
    protected $table = 'wp_locations';
    protected $fillable = ['name', 'yomi', 'island_id'];
}
