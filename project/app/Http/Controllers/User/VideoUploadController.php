<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Video;
use App\Category;
use App\Http\Requests\VideoValidationRequest;
use App\Http\Requests\VideoUpdateValidationRequest;
use Auth;

class VideoUploadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:user');
    }

    public function index()
    {
        $videos = Video::where('user_id',Auth::guard('user')->user()->id)->where('type','=',0)->get();
        return view('user.videoupload.index',compact('videos'));
    }


    public function create()
    {
    	$cats = Category::all();
        return view('user.videoupload.create',compact('cats'));
    }


    public function store(VideoValidationRequest $request)
    {
        $video = new Video();
        $data = $request->all();
        if ($request->tags) 
         {
            $data['tags'] = implode(',', $request->tags);       
         }
        if ($file = $request->file('path')) 
         {      
            $name = time().$file->getClientOriginalName();
            $file->move('assets/files/videos',$name);           
            $data['path'] = $name;
         } 
        if ($file1 = $request->file('thumbnail')) 
         {      
            $name1 = time().$file1->getClientOriginalName();
            $file1->move('assets/files/images',$name1);           
            $data['thumbnail'] = $name1;
         } 
        $video->fill($data)->save();
        return redirect()->route('user-video-index')->with('success','New Video Added Successfully.');
    }


    public function edit($id)
    {
        $video = Video::findOrFail($id);
    	$cats = Category::all();
        if($video->tags != null)
        {
            $tags = explode(',', $video->tags);            
        }
        $val = strpos($video->path,".");
        $ext = substr($video->path,$val+1);
        return view('user.videoupload.edit',compact('video','cats','tags','ext'));
    }

    public function update(VideoUpdateValidationRequest $request, $id)
    {
        $video = Video::findOrFail($id);
        $data = $request->all();

            if ($request->tags) 
            {
                $data['tags'] = implode(',', $request->tags);       
            }

            if ($file = $request->file('thumbnail')) 
            {              
                $name = time().$file->getClientOriginalName();
                $file->move('assets/files/images',$name);
                if($video->thumbnail != null)
                {
                    unlink(public_path().'/assets/files/images/'.$video->thumbnail);
                }            
            $data['thumbnail'] = $name;
            } 

            if ($file1 = $request->file('path')) 
            {              
                $name1 = time().$file1->getClientOriginalName();
                $file1->move('assets/files/videos',$name1);
                if($video->path != null)
                {
                    unlink(public_path().'/assets/files/videos/'.$video->path);
                }            
            $data['path'] = $name1;
            } 

        $video->update($data);
        return redirect()->route('user-video-index')->with('success','Video Updated Successfully.');
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
        if($video->path == null){
        unlink(public_path().'/assets/files/images/'.$video->thumbnail);
        $video->delete();
        return redirect()->route('user-video-index')->with('success','Video Deleted Successfully.');
        }
        unlink(public_path().'/assets/files/images/'.$video->thumbnail);
        unlink(public_path().'/assets/files/videos/'.$video->path);
        $video->delete();
        return redirect()->route('user-video-index')->with('success','Video Deleted Successfully.');
    }
}
