<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Video;
use App\Category;
use App\Http\Requests\VideoValidationRequest;
use App\Http\Requests\VideoUpdateValidationRequest;
use Auth;

class VideoFetchController extends Controller
{
public function __construct()
    {
        $this->middleware('auth:user');
    }

  public function index()
    {
        $videos = Video::where('user_id',Auth::guard('user')->user()->id)->where('type','=',1)->get();
        return view('user.videofetch.index',compact('videos'));
    }


    public function create()
    {
        return view('user.videofetch.create',compact('cats'));
    }


//***********************FETCH SECTION******************************

    public function createfetch(Request $request)
    {

        $url = $request->url;

//If the url has youtube, dailymotion and vimeo then execute the if statement


        if (
            (strpos($url, 'youtube') !== false) || 
            (strpos($url, 'vimeo') !== false) || 
            (strpos($url, 'dailymotion') !== false)
           ) 

        {

//********************************YOUTUBE SECTION******************************
//If the url has youtube then execute the if statement

            if (strpos($url, 'youtube') !== false) {
                $arrContextOptions=array(
                    "ssl"=>array(
                        "verify_peer"=>false,
                        "verify_peer_name"=>false,
                    ),
                );  

                $api_key = 'AIzaSyAFcpdykcwU4zKaqHoWQVy0v3MQNCJLUso';
                  
                $queryString = parse_url($url, PHP_URL_QUERY);
                    parse_str($queryString, $params);
                    if (isset($params['v']) && strlen($params['v']) > 0) {
                        $id =  $params['v'];
                    } else {
                    return redirect()->route('user-fetch-create')->with('unsuccess','The URL is Invaild.');;
                    }
                $api_url = 'https://www.googleapis.com/youtube/v3/videos?key='.$api_key.'&fields=items(snippet(title,description,tags,thumbnails))&part=snippet&id='.$id;                        
                  $data = json_decode(file_get_contents($api_url, false, stream_context_create($arrContextOptions)));
                 $fetch = $data->items[0]->snippet;
                 $link = "youtube";
                 // dd($fetch);
                 return view('user.videofetch.createfetch',compact('link','fetch','id','url'));

            }

//********************************DAILYMOTION SECTION******************************
//If the url has dailymotion then execute the if statement
            if (strpos($url, 'dailymotion') !== false) {

                $pos = strpos($url,"video");
                $id = substr($url,$pos+6);
                $api_url = "http://www.dailymotion.com/services/oembed?format=json&url=http://www.dailymotion.com/embed/video/".$id;
                $curl = curl_init($api_url);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                $dai = curl_exec($curl);
                curl_close($curl);
                $fetch =  json_decode($dai, true);
                $link = "dailymotion";
                return view('user.videofetch.createfetch',compact('link','fetch','id','url'));
            }

//********************************VIMEO SECTION******************************
//If the url has vimeo then execute the if statement
            if (strpos($url, 'vimeo') !== false) {
                $id = preg_replace('/[^0-9]/', '', $url);
                $api_url = "https://vimeo.com/api/oembed.json?url=https%3A//vimeo.com/".$id;
                $curl = curl_init($api_url);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                $dai = curl_exec($curl);
                curl_close($curl);
                $fetch =  json_decode($dai, true);
                $link = "vimeo";
                return view('user.videofetch.createfetch',compact('link','fetch','id','url'));
            }

        }

//Otherwise return with an error message

        else
        {
        return redirect()->route('user-fetch-create')->with('unsuccess','The URL is Invaild.');
        }


}

//***********************EDIT FETCH SECTION******************************
 public function editfetch(Request $request,$id)
    {
        $video = Video::findOrFail($id);
        $url = $request->url;

//If the url has youtube, dailymotion and vimeo then execute the if statement


        if (
            (strpos($url, 'youtube') !== false) || 
            (strpos($url, 'vimeo') !== false) || 
            (strpos($url, 'dailymotion') !== false)
           ) 

        {

//********************************YOUTUBE SECTION******************************
//If the url has youtube then execute the if statement

            if (strpos($url, 'youtube') !== false) {
                $arrContextOptions=array(
                    "ssl"=>array(
                        "verify_peer"=>false,
                        "verify_peer_name"=>false,
                    ),
                );  

                $api_key = 'AIzaSyAFcpdykcwU4zKaqHoWQVy0v3MQNCJLUso';
                  
                $queryString = parse_url($url, PHP_URL_QUERY);
                    parse_str($queryString, $params);
                    if (isset($params['v']) && strlen($params['v']) > 0) {
                        $id =  $params['v'];
                    } else {
                    return redirect()->route('user-fetch-create')->with('unsuccess','The URL is Invaild.');;
                    }
                $api_url = 'https://www.googleapis.com/youtube/v3/videos?key='.$api_key.'&fields=items(snippet(title,description,tags,thumbnails))&part=snippet&id='.$id;                        
                  $data = json_decode(file_get_contents($api_url, false, stream_context_create($arrContextOptions)));

                 $fetch = $data->items[0]->snippet;
                 $link = "youtube";
                 // dd($fetch);
                 return view('user.videofetch.edit',compact('link','fetch','id','url','video'));

            }

//********************************DAILYMOTION SECTION******************************
//If the url has dailymotion then execute the if statement
            if (strpos($url, 'dailymotion') !== false) {
              $pos = strpos($url,"video");
                $id = substr($url,$pos+6);
                //$data = json_decode(file_get_contents("http://api.www.dailymotion.com/video/".$id."")); 
                $api_url = "http://www.dailymotion.com/services/oembed?format=json&url=http://www.dailymotion.com/embed/video/".$id;
                $curl = curl_init($api_url);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                $dai = curl_exec($curl);
                curl_close($curl);
                $fetch =  json_decode($dai, true);
                $link = "dailymotion";
                return view('user.videofetch.edit',compact('link','fetch','id','url','video'));
            }

//********************************VIMEO SECTION******************************
//If the url has vimeo then execute the if statement
            if (strpos($url, 'vimeo') !== false) {
                $id = preg_replace('/[^0-9]/', '', $url); 
                $api_url = "https://vimeo.com/api/oembed.json?url=https%3A//vimeo.com/".$id;
                $curl = curl_init($api_url);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                $dai = curl_exec($curl);
                curl_close($curl);
                $fetch =  json_decode($dai, true);
                $link = "vimeo";
                return view('user.videofetch.edit',compact('link','fetch','id','url','video'));
            }
        }

//Otherwise return with an error message

        else
        {
        return redirect()->route('user-fetch-edit',['id'=>$video->id])->with('unsuccess','The URL is Invaild.');
        }


}

    
    public function store(Request $request)
    {
        $this->validate($request, array(
            'text' => 'string',
            ));
        $video = new Video();
        $data = $request->all();
        if ($request->tags) 
         {
            $data['tags'] = implode(',', $request->tags);       
         }
        $video->fill($data)->save();
        return redirect()->route('user-fetch-index')->with('success','New Video Added Successfully.');
    }


    public function edit($id)
    {
        $video = Video::findOrFail($id);
        $url = $video->url;

        if (strpos($url, 'youtube') !== false) {
        $queryString = parse_url($url, PHP_URL_QUERY);
            parse_str($queryString, $params);
                if (isset($params['v']) && strlen($params['v']) > 0) {
                    $id =  $params['v'];
                }
        }
          
        if (strpos($url, 'dailymotion') !== false) {
            $pos = strpos($url,"video");
            $id = substr($url,$pos+6);                 
        }

        if (strpos($url, 'vimeo') !== false) {
            $id = preg_replace('/[^0-9]/', '', $url);               
        }
                  
    	$cats = Category::all();
        if($video->tags != null)
        {
            $tags = explode(',', $video->tags);            
        }
        $val = strpos($video->path,".");
        $ext = substr($video->path,$val+1);
        return view('user.videofetch.edit',compact('video','cats','tags','ext','id'));
    }

    public function update(Request $request, $id)
    {
        $video = Video::findOrFail($id);
        $data = $request->all();

            if ($request->tags) 
            {
                $data['tags'] = implode(',', $request->tags);       
            }

        $video->update($data);
        return redirect()->route('user-fetch-index')->with('success','Video Updated Successfully.');
    }


    public function destroy($id)
    {
        $video = Video::findOrFail($id);
        if($video->likes)
        {
            foreach ($video->likes as $key) {
                $key->delete();
            }
        }
        if($video->comments)
        {
            foreach ($video->comments as $key1) {
                if($key1->commentlikes)
                    {
                        foreach ($key1->commentlikes as $key2) {
                            $key2->delete();
                        }                
                    }
            if($key1->replies)
            {
                foreach ($key1->replies as $key3) {
                if($key3->replylikes)
                {
                    foreach ($key3->replylikes as $key4) {
                        $key4->delete();
                    }                    
                }
                
                    $key3->delete();
                }      
            }
            
                $key1->delete();
            }        
        }
        if(count($video->playlist) > 0)
        {
            foreach ($video->playlist as $key ) {
                $key->delete();
            }
 
        }
        if(count($video->channel) > 0)
        {
            foreach ($video->channel as $key ) {
                $key->delete();
            } 
        }
        $video->delete();
        return redirect()->route('user-fetch-index')->with('success','Video Deleted Successfully.');
    }
}
