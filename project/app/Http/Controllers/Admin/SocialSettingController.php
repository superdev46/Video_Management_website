<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Sociallink;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;

class SocialSettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
    	$socialdata = Sociallink::findOrFail(1);
        return view('admin.socialsetting.socialsetting',compact('socialdata'));
    }

    public function update(Request $request)
    {
        $socialdata = SocialLink::findOrFail(1);
        $input = $request->all();
        if ($request->f_status == ""){
            $input['f_status'] = 0;
        }
        if ($request->t_status == ""){
            $input['t_status'] = 0;
        }

        if ($request->g_status == ""){
            $input['g_status'] = 0;
        }

        if ($request->l_status == ""){
            $input['l_status'] = 0;
        }

        $socialdata->update($input);
        Session::flash('success', 'Social links updated successfully.');
        return redirect()->route('admin-social-index');
    }

}
