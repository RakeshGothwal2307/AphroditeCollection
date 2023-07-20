<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PagesModel;
use App\Models\Privacy_Policy;
use App\Models\TermsCondation;

class PagesController extends Controller
{
    public function privacy(){
        $data = Privacy_Policy::all();
        return view('admin.pages.privacy_policy',compact('data'));
    }

    public function insert_privacy(Request $request){
        $insert = Privacy_Policy::first();
        $insert->title = $request->title;
        $insert->content = $request->content;
        $insert->save();
        return redirect()->route('privacy');
    }

    public function terms_conditions(){
        $data = TermsCondation::all();
        return view('admin.pages.term_condation',compact('data'));
    }

    public function insert_conditions(Request $request){
        // dd($request->all());
        $insert = TermsCondation::first();
        $insert->title = $request->title;
        $insert->content = $request->content;
        $insert->save();
        return redirect()->route('terms_conditions');

    }
}
