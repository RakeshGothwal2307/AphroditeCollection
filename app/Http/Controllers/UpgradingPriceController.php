<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Upgrade_pricing;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use Illuminate\Support\Facades\DB;


class UpgradingPriceController extends Controller
{
    public function upgrading_price()
    {
        $country = Country::all();
        $names = Upgrade_pricing::with('city')->with('state')->with('country')->get();

        return view('admin.upgrades.upgrading_price', [
            'country' => $country,
            'names' => $names,
        ]);
    }



    public function fetchState(Request $request)
    {
        $data['states'] = State::where("country_id", $request->country_id)
            ->get(["name", "id"]);

        return response()->json($data);
    }

    public function fetchCity(Request $request)
    {
        $data['cities'] = City::where("state_id", $request->state_id)
            ->get(["name", "id"]);

        return response()->json($data);
    }

    public function price_insert(Request $request)
    {
        $insert = new Upgrade_pricing;
        $insert->country = $request->country;
        $insert->state = $request->state;
        $insert->city = $request->city;
        $insert->placement_cost = $request->placement_cost;
        $insert->featured_ad_cost = $request->featured_ad_cost;
        $insert->animated_gif_cost = $request->animated_gif_cost;
        $insert->save();
        return redirect()->back();
    }

    public function upgeade_delete($id){
        Upgrade_pricing::find($id)->delete();
        return redirect()->back();
    }
}
