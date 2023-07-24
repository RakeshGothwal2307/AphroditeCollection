<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Upgrade_pricing;


class City extends Model
{
    use HasFactory;
    protected $table="cities";
    protected $fillable = [
        'name', 'state_id'
    ];
    public function upgrade_pricing(){
        return $this->belongsTo(Upgrade_pricing::class);
    }
}
