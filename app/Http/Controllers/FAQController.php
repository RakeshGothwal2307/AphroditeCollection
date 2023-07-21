<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FAQ;

class FAQController extends Controller
{
    public function faq()
    {
        $faqs = FAQ::all();
        return view('admin.pages.faq', compact('faqs'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string',
        ]);

        FAQ::create([
            'question' => $request->input('question'),
            'answer' => $request->input('answer'),
        ]);

        return redirect()->route('faq.index')->with('success', 'FAQ created successfully!');
    }

    public function faq_delete($id){

        $delete = FAQ::find($id)->delete();
        return redirect()->route('faq.index')->with('success', 'FAQ Delete successfully!');

    }

    public function faq_edit(Request $request){
        $update = FAQ::first();
        $update->question = $request->question;
        $update->answer = $request->answer;
        $update->save();
    }
}
