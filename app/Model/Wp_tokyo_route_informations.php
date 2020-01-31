<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Wp_tokyo_route_informations extends Model
{
    protected $table = 'wp_tokyo_route_informations';
    protected $fillable = ['departure_id', 'arrival_id', 'departure_time', 'date', 'arrival_time', 'transportation_type_id', 'status', 'price', 'price_label', 'service_company_id', 'remark'];
}
