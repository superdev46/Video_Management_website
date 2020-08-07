<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Generalsetting;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\StoreValidationRequest;
use App\Http\Controllers\Controller;

class GeneralSettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function logo()
    {
        $data = Generalsetting::findOrFail(1);
        return view('admin.generalsetting.logo',compact('data'));
    }

    public function logoup(StoreValidationRequest $request)
    {
        $input = $request->all(); 
        $logo = Generalsetting::findOrFail(1);        
            if ($file = $request->file('logo')) 
            {              
                $name = time().$file->getClientOriginalName();
                $file->move('assets/files/images/',$name);
                if($logo->logo != null)
                {
                    unlink(public_path().'/assets/files/images/'.$logo->logo);
                }            
            $input['logo'] = $name;
            }         
        $logo->update($input);
        Session::flash('success', 'Successfully updated the logo');
        return redirect()->route('admin-gs-logo');
    }

  public function fav()
    {
        $data = Generalsetting::findOrFail(1);
        return view('admin.generalsetting.favicon',compact('data'));
    }

    public function favup(StoreValidationRequest $request)
    {
        $input = $request->all(); 
        $fav = Generalsetting::findOrFail(1);        
            if ($file = $request->file('favicon')) 
            {              
                $name = time().$file->getClientOriginalName();
                $file->move('assets/files/images',$name);
                if($fav->fav != null)
                {
                    unlink(public_path().'/assets/files/images/'.$fav->fav);
                }            
            $input['favicon'] = $name;
            }         
        $fav->update($input);
        Session::flash('success', 'Successfully updated the Favicon');
        return redirect()->route('admin-gs-fav');
    }

    public function bgimg()
    {
        $data = Generalsetting::findOrFail(1);
        return view('admin.generalsetting.backgroundimage',compact('data'));
    }

    public function bgimgup(StoreValidationRequest $request)
    {
        $input = $request->all(); 
        $bgimg = Generalsetting::findOrFail(1);        
            if ($file = $request->file('bgimg')) 
            {              
                $name = time().$file->getClientOriginalName();
                $file->move('assets/files/images',$name);
                if($bgimg->bgimg != null)
                {
                    unlink(public_path().'/assets/files/images/'.$bgimg->bgimg);
                }            
            $input['bgimg'] = $name;
            }         
        $bgimg->update($input);
        Session::flash('success', 'Successfully updated the background image');
        return redirect()->route('admin-gs-bgimg');
    }

    public function contents()
    {
        $data = Generalsetting::findOrFail(1);
        return view('admin.generalsetting.websitecontent',compact('data'));
    }

    public function contentsup(Request $request)
    {
        $content = Generalsetting::findOrFail(1);
        $content->update($request->all());
        Session::flash('success', 'Successfully updated the title');
        return redirect()->route('admin-gs-contents');
    }

    public function payments()
    {
        $data = Generalsetting::findOrFail(1);
        return view('admin.generalsetting.payments',compact('data'));
    }

    public function paymentsup(Request $request)
    {
        $data = Generalsetting::findOrFail(1);
        $data->update($request->all());
        Session::flash('success', 'Successfully updated the title');
        return redirect()->route('admin-gs-payments');
    }

    public function about()
    {
        $data = Generalsetting::findOrFail(1);
        return view('admin.generalsetting.about',compact('data'));
    }

    public function aboutup(Request $request)
    {
        $about = Generalsetting::findOrFail(1);
        $about->update($request->all());
        Session::flash('success', 'Successfully updated the about section');
        return redirect()->route('admin-gs-about');
    }

    public function address()
    {
        $data = Generalsetting::findOrFail(1);
        return view('admin.generalsetting.address',compact('data'));
    }

    public function addressup(Request $request)
    {
        $address = Generalsetting::findOrFail(1);
        $address->update($request->all());
        Session::flash('success', 'Successfully updated the address section');
        return redirect()->route('admin-gs-address');
    }

    public function footer()
    {
        $data = Generalsetting::findOrFail(1);
        return view('admin.generalsetting.footer',compact('data'));
    }

    public function footerup(Request $request)
    {
        $footer = Generalsetting::findOrFail(1);
        $footer->update($request->all());
        Session::flash('success', 'Successfully updated the footer section');
        return redirect()->route('admin-gs-footer');
    }
    public function bginfo()
    {
        $data = Generalsetting::findOrFail(1);
        return view('admin.generalsetting.bg-info',compact('data'));
    }

    public function bginfoup(Request $request)
    {
        $bginfo = Generalsetting::findOrFail(1);
        $bginfo->update($request->all());
        Session::flash('success', 'Background Information content updated successfully.');
        return redirect()->route('admin-gs-bginfo');
    }
}
