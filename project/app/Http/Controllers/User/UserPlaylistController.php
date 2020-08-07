<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateValidationRequest;
use Auth;
use App\Playlist;
use App\Playlistvideo;
use App\Video;

class UserPlaylistController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:user');
    }

	public function index()
	{
		$playlists = Playlist::where('user_id','=',Auth::guard('user')->user()->id)->get();
		return view('user.playlists.index',compact('playlists'));
	}

    public function create()
    {
        return view('user.playlists.create');
    }

    public function show($id)
    {
        $playlist = Playlist::findOrFail($id);
        return view('user.playlists.show',compact('playlist'));
    }

   public function showcreate($id)
    {
        $playlist = Playlist::findOrFail($id);
        $videos = Video::where('user_id',Auth::guard('user')->user()->id)->get();
        return view('user.playlists.showcreate',compact('playlist','videos'));
    }

   public function showedit($id)
    {
        $vid = Playlistvideo::findOrFail($id);
        $playlist = Playlist::findOrFail($vid->playlist->id);
        $videos = Video::where('user_id',Auth::guard('user')->user()->id)->get();
        return view('user.playlists.showedit',compact('vid','playlist','videos'));
    }

   public function showcreatestore(Request $request, $id)
    {
        $playlistvideo = new Playlistvideo();
        $playlistvideo->fill($request->all())->save();
        return redirect()->route('user-playlist-show',['id' => $id ])->with('success','New Video Added To Playlist.');
    }

   public function showupdate(Request $request, $id)
    {
        $vid = Playlistvideo::findOrFail($id);        
        $vid->update($request->all());
        return redirect()->route('user-playlist-show',['id' => $vid->playlist->id ])->with('success','Video Updated Successfully.');
    }

   public function viddelete($id)
    {
        $vid = Playlistvideo::findOrFail($id);
        $vid->delete();
        return redirect()->route('user-playlist-show',['id' => $vid->playlist->id ])->with('success','Video Removed Successfully');
    }


    public function store(UpdateValidationRequest $request)
    {
		$this->validate($request, [
	        'photo' => 'required'
	    ]);
        $playlist = new Playlist();
        $data = $request->all();
        if ($file = $request->file('photo')) 
         {      
            $name = time().$file->getClientOriginalName();
            $file->move('assets/files/images',$name);           
            $data['photo'] = $name;
         } 
        $playlist->fill($data)->save();
        return redirect()->route('user-playlist-index')->with('success','New Playlist Added Successfully.');
    }


    public function edit($id)
    {
        $playlist = Playlist::findOrFail($id);    	
        return view('user.playlists.edit',compact('playlist'));
    }

    public function update(UpdateValidationRequest $request, $id)
    {
        $playlist = Playlist::findOrFail($id);
        $data = $request->all();
            if ($file = $request->file('photo')) 
            {              
                $name = time().$file->getClientOriginalName();
                $file->move('assets/files/images',$name);
                if($playlist->photo != null)
                {
                    unlink(public_path().'/assets/files/images/'.$playlist->photo);
                }            
            $data['photo'] = $name;
            } 
        $playlist->update($data);
        return redirect()->route('user-playlist-index')->with('success','Playlist Updated Successfully.');
    }


    public function destroy($id)
    {
        $playlist = Playlist::findOrFail($id);
        if($playlist->videos->count()>0)
        {
        return redirect()->route('user-playlist-index')->with('unsuccess','Remove Videos First!!');
        }
        unlink(public_path().'/assets/files/images/'.$playlist->photo);
        $playlist->delete();
        return redirect()->route('user-playlist-index')->with('success','Playlist Deleted Successfully.');
    }
}
