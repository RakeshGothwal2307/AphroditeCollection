<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use App\Models\City;

class Upgrade_Pricing extends Model
{
    use HasFactory;

    // protected $appends = ['states'];

    protected $fillable=[
        'country',
        'state',
        'city',
        'placement_cost',
        'featured_ad_cost',
        'animated_gif_cost',
    ];


    // public function getStatesAttributes()
    // {
    //     $stateData = DB::table('states')->where('id',$this->state)->get();
    //     return $stateData;
    // }

}
