<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\User;
use App\Category;
use Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Language;
use App\Http\Controllers\Controller;
use App\Like;
use App\Commentlike;
use App\Replylike;
use App\Video;
use App\Playlist;
use App\Channel;
use App\Channelcontent;
use App\Subscribe;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:user');
    }

    public function commentlikes($id)
    {
        $chck = Commentlike::where('comment_id','=',$id)->where('user_id','=',Auth::guard('user')->user()->id)->first();
        if($chck)
        {
            $lk = Commentlike::findOrFail($chck->id);
            if($lk->is_like == 1)
                {
                    $lk->delete();            
                }
            else
                {
                    $lk->is_dislike = 0;
                    $lk->is_like =1;
                    $lk->update();            
                }
        return redirect()->route('front.video',$lk->comment->video->id);
        }
        else
        {
            $like = new Commentlike;
            $like->comment_id = $id;
            $like->user_id = Auth::guard('user')->user()->id;
            $like->is_like = 1;
            $like->save();
            return redirect()->route('front.video',$like->comment->video->id);
        }
    }
    public function commentdislikes($id)
    {
        $chck = Commentlike::where('comment_id','=',$id)->where('user_id','=',Auth::guard('user')->user()->id)->first();
        if($chck)
        {
            $lk = Commentlike::findOrFail($chck->id);
            if($lk->is_dislike == 1)
            {
                $lk->delete();            
            }
            else
            {
                $lk->is_dislike = 1;
                $lk->is_like =0;
                $lk->update();            
            }
        return redirect()->route('front.video',$lk->comment->video->id);
        }
        else
        {
            $like = new Commentlike;
            $like->comment_id = $id;
            $like->user_id = Auth::guard('user')->user()->id;
            $like->is_dislike = 1;
            $like->save();
            return redirect()->route('front.video',$like->comment->video->id);
        }      
    }
    public function replylikes($id)
    {
    $chck = Replylike::where('reply_id','=',$id)->where('user_id','=',Auth::guard('user')->user()->id)->first();
        if($chck)
        {
            $lk = Replylike::findOrFail($chck->id);
            if($lk->is_like == 1)
                {
                    $lk->delete();            
                }
            else
                {
                    $lk->is_dislike = 0;
                    $lk->is_like =1;
                    $lk->update();            
                }
        return redirect()->route('front.video',$lk->reply->comment->video->id);
        }
        else
        {
            $like = new Replylike;
            $like->reply_id = $id;
            $like->user_id = Auth::guard('user')->user()->id;
            $like->is_like = 1;
            $like->save();
            return redirect()->route('front.video',$like->reply->comment->video->id);
        }     
    }
    public function replydislikes($id)
    {
        $chck = Replylike::where('reply_id','=',$id)->where('user_id','=',Auth::guard('user')->user()->id)->first();
        if($chck)
        {
            $lk = Replylike::findOrFail($chck->id);
            if($lk->is_dislike == 1)
            {
                $lk->delete();            
            }
            else
            {
                $lk->is_dislike = 1;
                $lk->is_like =0;
                $lk->update();            
            }
        return redirect()->route('front.video',$lk->reply->comment->video->id);
        }
        else
        {
            $like = new Replylike;
            $like->reply_id = $id;
            $like->user_id = Auth::guard('user')->user()->id;
            $like->is_dislike = 1;
            $like->save();
            return redirect()->route('front.video',$like->reply->comment->video->id);
        }       
    }

    public function likes($id)
    {
        $chck = Like::where('video_id','=',$id)->where('user_id','=',Auth::guard('user')->user()->id)->first();
        if($chck)
        {
            $lk = Like::findOrFail($chck->id);
            if($lk->is_like == 1)
                {
                    $lk->delete();            
                }
            else
                {
                    $lk->is_dislike = 0;
                    $lk->is_like =1;
                    $lk->update();            
                }
        return redirect()->route('front.video',$id);
        }
        else
        {
            $like = new Like;
            $like->video_id = $id;
            $like->user_id = Auth::guard('user')->user()->id;
            $like->is_like = 1;
            $like->save();
            return redirect()->route('front.video',$id);
        }
    }

    public function dislikes($id)
    {
        $chck = Like::where('video_id','=',$id)->where('user_id','=',Auth::guard('user')->user()->id)->first();
        if($chck)
        {
            $lk = Like::findOrFail($chck->id);
            if($lk->is_dislike == 1)
            {
                $lk->delete();            
            }
            else
            {
                $lk->is_dislike = 1;
                $lk->is_like =0;
                $lk->update();            
            }
        return redirect()->route('front.video',$id);
        }
        else
        {
            $like = new Like;
            $like->video_id = $id;
            $like->user_id = Auth::guard('user')->user()->id;
            $like->is_dislike = 1;
            $like->save();
            return redirect()->route('front.video',$id);
        }
    }

    public function index()
    {
    	$user = Auth::guard('user')->user();
        $fvideos = Video::where('user_id',$user->id)->where('type','=',1)->get();
        $uvideos = Video::where('user_id',$user->id)->where('type','=',0)->get();
        $playlists = Playlist::where('user_id',$user->id)->get();
        $channels = Channel::where('user_id',$user->id)->get();
        $likes = Like::where('user_id',$user->id)->get();
        $subscribes = Subscribe::where('user_id',$user->id)->get();
        return view('user.index',compact('user','fvideos','uvideos','playlists','channels','likes','subscribes'));
    }

    public function subscription()
    {
        $user = Auth::guard('user')->user();
        $subscribes = Subscribe::where('user_id',$user->id)->get();
        return view('user.subscription',compact('user','subscribes'));
    }
    public function likedvideos()
    {
        $user = Auth::guard('user')->user();
        $likes = Like::where('user_id',$user->id)->orderBy('id','desc')->get();
        return view('user.likedvideos',compact('user','likes'));
    }

    public function subscribe($id1,$id2)
    {
        $chck = Subscribe::where('channel_id','=',$id1)->where('user_id','=',Auth::guard('user')->user()->id)->first();
        if($chck)
        {
            $ck = Subscribe::findOrFail($chck->id);
            $ck->delete(); 
            return redirect()->route('front.video',$id2);
        }
        $subscribe = new Subscribe();
        $subscribe->channel_id = $id1;
        $subscribe->user_id = Auth::guard('user')->user()->id;
        $subscribe->save();
        return redirect()->route('front.video',$id2);

    }

    public function profile()
    {
    	$user = Auth::guard('user')->user();
        $title = '';
        $details = '';
        if($user->title!=null && $user->details!=null)
        {
            $title = explode(',', $user->title);
            $details = explode(',', $user->details);
        }
        $cats = Category::all();
        return view('user.profile',compact('user','cats','title','details'));
    }

    public function resetform()
    {
        $user = Auth::guard('user')->user();
        return view('user.password',compact('user'));
    }

    public function reset(Request $request)
    {
        $input = $request->all();  
        $user = Auth::guard('user')->user();
        if ($request->cpass){
            if (Hash::check($request->cpass, $user->password)){
                if ($request->newpass == $request->renewpass){
                    $input['password'] = Hash::make($request->newpass);
                }else{
                    Session::flash('unsuccess', 'Confirm password does not match.');
                    return redirect()->back();
                }
            }else{
                Session::flash('unsuccess', 'Current password Does not match.');
                return redirect()->back();
            }
        }
        $user->update($input);
        Session::flash('success', 'Successfully updated your password');
        return redirect()->back();
    }

    public function profileupdate(Request $request)
    { 
        $input = $request->all(); 
        $user = Auth::guard('user')->user(); 
            if($file = $request->file('photo')) 
            {              
                $name = time().$file->getClientOriginalName();
                $file->move('assets/files/images',$name);
                if($user->photo != null)
                {
                    unlink(public_path().'/assets/files/images/'.$user->photo);
                }            
            $input['photo'] = $name;
            } 
        $user->update($input);
        Session::flash('success', "Successfully Updated The Profile.");
        return redirect()->route('user-profile');
    }

//Will Work On These Functions Later

    public function advertising()
    {
        $user = Auth::guard('user')->user();
        return view('user.advertising',compact('user'));
    }

    public function avatar()
    {
        $user = Auth::guard('user')->user();
        return view('user.avatar',compact('user'));
    }

    public function channelabout()
    {
        $user = Auth::guard('user')->user();
        return view('user.channel-about',compact('user'));
    }

    public function channelliked()
    {
        $user = Auth::guard('user')->user();
        return view('user.channel-liked',compact('user'));
    }

    public function channelmanage()
    {
        $user = Auth::guard('user')->user();
        return view('user.channel-manage',compact('user'));
    }

    public function playlist()
    {
        $user = Auth::guard('user')->user();
        return view('user.channel-playlist',compact('user'));
    }

    public function channel()
    {
        $user = Auth::guard('user')->user();
        return view('user.channel',compact('user'));
    }

    public function password()
    {
        $user = Auth::guard('user')->user();
        return view('user.password',compact('user'));
    }

    public function createad()
    {
        $user = Auth::guard('user')->user();
        return view('user.create-ad',compact('user'));
    }

    public function deleteaccount()
    {
        $user = Auth::guard('user')->user();
        return view('user.delete-account',compact('user'));
    }

    public function generalsetting()
    {
        $user = Auth::guard('user')->user();
        return view('user.generalsetting',compact('user'));
    }

    public function history()
    {
        $user = Auth::guard('user')->user();
        return view('user.history',compact('user'));
    }



    public function managevideos()
    {
        $user = Auth::guard('user')->user();
        return view('user.managevideos',compact('user'));
    }

    public function monetization()
    {
        $user = Auth::guard('user')->user();
        return view('user.monetization',compact('user'));
    }

    public function propackage()
    {
        $user = Auth::guard('user')->user();
        return view('user.pro-package',compact('user'));
    }



    public function verification()
    {
        $user = Auth::guard('user')->user();
        return view('user.verification',compact('user'));
    }

    public function withdraw()
    {
        $user = Auth::guard('user')->user();
        return view('user.withdraw',compact('user'));
    }


}
