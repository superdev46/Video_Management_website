<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Language;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
class LanguageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function lang()
    {
        $data = Language::findOrFail(1);
        return view('admin.language.index',compact('data'));
    }

    public function langup(Request $request)
    {       
        $input = $request->all(); 
        $lang = Language::findOrFail(1);                 
        $lang->update($input);
        Session::flash('success', 'Successfully updated the Language');
        return redirect()->route('admin-lang-index');
    }
}
