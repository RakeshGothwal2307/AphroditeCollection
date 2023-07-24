<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\{City,State,Country};



class Upgrade_Pricing extends Model
{
    use HasFactory;

    

    protected $fillable=[
        'country',
        'state',
        'city',
        'placement_cost',
        'featured_ad_cost',
        'animated_gif_cost',
    ];


    public function city(){
        
        return $this->hasMany(City::class,'id','city');
    }
    public function state(){
        
        return $this->hasMany(State::class,'id','state');
    }
    public function country(){
        
        return $this->hasMany(Country::class,'id','country');
    }

}
