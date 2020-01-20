<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Wp_service_companies extends Model
{
    protected $table = 'wp_service_companies';
    protected $fillable = ['name', 'type', 'logo', 'contact_phone_number', 'reception_hours', 'note'];
}
