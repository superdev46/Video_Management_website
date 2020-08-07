<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Category;
use App\Reply;
use App\Generalsetting;
use App\Pagesetting;
use App\Faq;
use App\Subscriber;
use App\User;
use App\Advertise;
use App\Video;
use App\Like;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Auth;
use App\Comment;
use App\Playlist;
use App\Channel;
use App\Channelcontent;
use App\Subscribe;
use App\Counter;
class FrontendController extends Controller
{

    public function __construct()
    {
        if(isset($_SERVER['HTTP_REFERER'])){
            $referral = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST);
            if ($referral != $_SERVER['SERVER_NAME']){

                $brwsr = Counter::where('type','browser')->where('referral',$this->getOS());
                if($brwsr->count() > 0){
                    $brwsr = $brwsr->first();
                    $tbrwsr['total_count']= $brwsr->total_count + 1;
                    $brwsr->update($tbrwsr);
                }else{
                    $newbrws = new Counter();
                    $newbrws['referral']= $this->getOS();
                    $newbrws['type']= "browser";
                    $newbrws['total_count']= 1;
                    $newbrws->save();
                }

                $count = Counter::where('referral',$referral);
                if($count->count() > 0){
                    $counts = $count->first();
                    $tcount['total_count']= $counts->total_count + 1;
                    $counts->update($tcount);
                }else{
                    $newcount = new Counter();
                    $newcount['referral']= $referral;
                    $newcount['total_count']= 1;
                    $newcount->save();
                }
            }
        }else{
            $brwsr = Counter::where('type','browser')->where('referral',$this->getOS());
            if($brwsr->count() > 0){
                $brwsr = $brwsr->first();
                $tbrwsr['total_count']= $brwsr->total_count + 1;
                $brwsr->update($tbrwsr);
            }else{
                $newbrws = new Counter();
                $newbrws['referral']= $this->getOS();
                $newbrws['type']= "browser";
                $newbrws['total_count']= 1;
                $newbrws->save();
            }
        }
    }


    function getOS() {

        $user_agent     =   $_SERVER['HTTP_USER_AGENT'];

        $os_platform    =   "Unknown OS Platform";

        $os_array       =   array(
            '/windows nt 10/i'     =>  'Windows 10',
            '/windows nt 6.3/i'     =>  'Windows 8.1',
            '/windows nt 6.2/i'     =>  'Windows 8',
            '/windows nt 6.1/i'     =>  'Windows 7',
            '/windows nt 6.0/i'     =>  'Windows Vista',
            '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
            '/windows nt 5.1/i'     =>  'Windows XP',
            '/windows xp/i'         =>  'Windows XP',
            '/windows nt 5.0/i'     =>  'Windows 2000',
            '/windows me/i'         =>  'Windows ME',
            '/win98/i'              =>  'Windows 98',
            '/win95/i'              =>  'Windows 95',
            '/win16/i'              =>  'Windows 3.11',
            '/macintosh|mac os x/i' =>  'Mac OS X',
            '/mac_powerpc/i'        =>  'Mac OS 9',
            '/linux/i'              =>  'Linux',
            '/ubuntu/i'             =>  'Ubuntu',
            '/iphone/i'             =>  'iPhone',
            '/ipod/i'               =>  'iPod',
            '/ipad/i'               =>  'iPad',
            '/android/i'            =>  'Android',
            '/blackberry/i'         =>  'BlackBerry',
            '/webos/i'              =>  'Mobile'
        );

        foreach ($os_array as $regex => $value) {

            if (preg_match($regex, $user_agent)) {
                $os_platform    =   $value;
            }

        }
        return $os_platform;
    }

	public function index()
	{
		$cats = Category::all();
		$top = Video::where('is_slider','=',1)->orderBy('created_at','desc')->first();
		$id1 = $top->id;
		$lastvids = Video::where('is_top','=',1)->orderBy('created_at','desc')->take(3)->get();
		$topvids = Video::where('id','<',$id1)->where('is_slider','=',1)->orderBy('created_at','desc')->get();
		return view('front.index',compact('cats','topvids','top','lastvids'));
	}

	public function playlists()
	{
		$playlists = Playlist::paginate(12);
		return view('front.playlists',compact('playlists'));
	}

	public function playlist($id)
	{
		$playlist = Playlist::findOrFail($id);
		return view('front.playlist',compact('playlist'));
	}

	public function channels()
	{
		$channels = Channel::paginate(12);
		return view('front.channels',compact('channels'));
	}

	public function channel($id)
	{
		$channel = Channel::findOrFail($id);
		return view('front.channel',compact('channel'));
	}

	public function playlistvideo($id1,$id2)
	{
		$video = Video::findOrFail($id2);
		$schck = 0;
		$channel = Channelcontent::where('playlist_id','=',$id1)->first();
		if($channel != null)
		{
		if(Auth::guard('user')->check())
			{
		$subscribe = Subscribe::where('channel_id',$channel->channel->id)->where('user_id','=',Auth::guard('user')->user()->id)->first();

			if(!empty($subscribe))
			{
				$schck = 1;
			}
		}
		}
		$likes = Like::where('video_id','=',$id2)->where('is_like','=',1)->get();
		$dislikes = Like::where('video_id','=',$id2)->where('is_dislike','=',1)->get();
		if(Auth::guard('user')->check())
		{
		$lcheck = Like::where('video_id','=',$id2)->where('user_id','=',Auth::guard('user')->user()->id)->where('is_like','=',1)->first();
		$dcheck = Like::where('video_id','=',$id2)->where('user_id','=',Auth::guard('user')->user()->id)->where('is_dislike','=',1)->first();
		}
		$video->views+=1;
		$video->update();
		$playlist = Playlist::findOrFail($id1);
		if(isset($lcheck)){
		if($lcheck->is_like == 1){
		$val1 = "set";	
		return view('front.playlistvideo',compact('video','playlist','likes','dislikes','val1','channel','schck'));			
		}
	}
		if(isset($dcheck)){
		if($dcheck->is_dislike == 1){
		$val2 = "set";	
		return view('front.playlistvideo',compact('video','playlist','likes','dislikes','val2','channel','schck'));			
		}
	}
		return view('front.playlistvideo',compact('video','playlist','likes','dislikes','channel','schck'));
	}

	public function comment(Request $request)
	{
        $cmnt = new Comment;
        $input = $request->all();
        $cmnt->fill($input)->save();
        return redirect()->back();

	}

	public function reply(Request $request)
	{
        $rpl = new Reply;
        $input = $request->all();
        $rpl->fill($input)->save();
        return redirect()->back();

	}

	public function video($id)
	{
		$user = Auth::guard('user')->user();
		$video = Video::findOrFail($id);
		$schck = 0;
		$channel = Channelcontent::where('video_id','=',$id)->first();
		if($channel != null)
		{
		if(Auth::guard('user')->check())
			{
		$subscribe = Subscribe::where('channel_id',$channel->channel->id)->where('user_id','=',Auth::guard('user')->user()->id)->first();

			if(!empty($subscribe))
			{
				$schck = 1;
			}
		}
		}
		$likes = Like::where('video_id','=',$id)->where('is_like','=',1)->get();
		$dislikes = Like::where('video_id','=',$id)->where('is_dislike','=',1)->get();
		if(Auth::guard('user')->check())
		{
		$lcheck = Like::where('video_id','=',$id)->where('user_id','=',Auth::guard('user')->user()->id)->where('is_like','=',1)->first();
		$dcheck = Like::where('video_id','=',$id)->where('user_id','=',Auth::guard('user')->user()->id)->where('is_dislike','=',1)->first();
		}
		$video->views+=1;
		$video->update();
		$cat = Category::findOrFail($video->category->id);
		$vids = $cat->videos()->where('is_top','=',0)->where('is_slider','=',0)->get(); 
		if(isset($lcheck)){
		if($lcheck->is_like == 1){
		$val1 = "set";	
		return view('front.video',compact('user','video','vids','cat','likes','dislikes','val1','channel','schck'));			
		}
	}
		if(isset($dcheck)){
		if($dcheck->is_dislike == 1){
		$val2 = "set";	
		return view('front.video',compact('user','video','vids','cat','likes','dislikes','val2','channel','schck'));			
		}
	}
		return view('front.video',compact('user','video','vids','cat','likes','dislikes','channel','schck'));

	}

// Will Work On This Later

	// public function ads($id)
	// {
	// 	$ad = Advertise::findOrFail($id);
	// 	$old = $ad->clicks;
	// 	$new = $old + 1;
	// 	$ad->clicks = $new;
	// 	$ad->update();
	// 	return redirect($ad->url);

	// }

	public function types($slug)
	{
	    $cat = Category::where('cat_slug', '=', $slug)->first();
		$videos = 	$cat->videos()->where('is_top','=',0)->where('is_slider','=',0)->orderBy('created_at','desc')->paginate(12);
		return view('front.typevideos',compact('videos','cat'));
	}


	public function test($test)
	{
		echo $test;
	}



	public function subscribe(Request $request)
	{
        $this->validate($request, array(
            'email'=>'unique:subscribers',
        ));
        $subscribe = new Subscriber;
        $subscribe->fill($request->all());
        $subscribe->save();
        Session::flash('subscribe', 'You are subscribed Successfully.');
        return redirect()->route('front.index');
	}



	public function faq()
	{
		$ps = Pagesetting::findOrFail(1);
		if($ps->f_status == 0){
			return redirect()->route('front.index');
		}
		$faqs = Faq::all();
		return view('front.faq',compact('faqs'));
	}

	public function about()
	{
		$ps = Pagesetting::findOrFail(1);
		if($ps->a_status == 0){
			return redirect()->route('front.index');
		}
		$about = $ps->about;
		return view('front.about',compact('about'));
	}

	public function contact()
	{
		$ps = Pagesetting::findOrFail(1);
		if($ps->c_status == 0){
			return redirect()->route('front.index');
		}
		return view('front.contact',compact('ps'));
	}

    //Send email to user
    public function contactemail(Request $request)
    {
		$ps = Pagesetting::findOrFail(1);
        $subject = "Email From Of ".$request->name;
        $to = $request->to;
        $name = $request->name;
        $phone = $request->phone;
        $department = $request->department;
        $from = $request->email;
        $msg = "Name: ".$name."\nEmail: ".$from."\nPhone: ".$request->phone."\nMessage: ".$request->text;
        mail($to,$subject,$msg);
        Session::flash('success', $ps->contact_success);
        return redirect()->route('front.contact');
    }

    public function userinfo($id)
    {
    	$owner =  Auth::guard('user')->user();
    	if(!$owner){
    		return redirect()->route('user-login');
    	}
    	$user = User::findOrFail($id);  
    	$subscribers = Subscriber::where('scribed_id', '=', $user->id)->count();
    	$sub_cond['scribed_id'] = $user->id;
    	$sub_cond['scriber_id'] = $owner->id;
    	$myscribe = Subscriber::where($sub_cond)->count();
    	$uservideos = $user->videos();
    	return view('front.user', compact('user', 'subscribers', 'myscribe', 'uservideos'));
    }
}
