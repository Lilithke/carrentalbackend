<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $hidden=["created_at","updated_at"];
    protected $fillable =["license_plate_number","brand","model","daily_cost"];
}
