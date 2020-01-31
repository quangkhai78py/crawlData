<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Wp_tokyo_stations extends Model
{
    protected $table = 'wp_tokyo_stations';
    protected $fillable = ['name', 'parent_name', 'yomi', 'code', 'code_searching', 'type', 'remark', 'island_id'];
}
