<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateValidationRequest;
use Auth;
use App\Playlist;
use App\Playlistvideo;
use App\Video;
use App\Channel;
use App\Channelcontent;

class UserChannelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:user');
    }

	public function index()
	{
		$channels = Channel::where('user_id','=',Auth::guard('user')->user()->id)->get();
		return view('user.channel.index',compact('channels'));
	}

    public function create()
    {
        return view('user.channel.create');
    }

    public function show($id)
    {
        $channel = Channel::findOrFail($id);
        return view('user.channel.show',compact('channel'));
    }

   public function showcreate($id)
    {
        $channel = Channel::findOrFail($id);
        $videos = Video::where('user_id',Auth::guard('user')->user()->id)->get();
        return view('user.channel.showcreate',compact('channel','videos'));
    }

   public function showedit($id)
    {
        $cid = Channelcontent::findOrFail($id);
        if($cid->type == 1)
        {
        $playlis = Playlist::findOrFail($cid->playlist->id);
        $playlists = Playlist::where('user_id','=',Auth::guard('user')->user()->id)->get();
        return view('user.channel.showedit',compact('cid','playlis','playlists')); 
        }
        else{
        $vide = Video::findOrFail($cid->video->id);
        $videos = Video::where('user_id','=',Auth::guard('user')->user()->id)->get();
        return view('user.channel.showedit',compact('cid','vide','videos'));           
        }
    }

   public function showcreatestore(Request $request, $id)
    {
        $channelcontent = new Channelcontent();
        $channelcontent->fill($request->all())->save();
        return redirect()->route('user-channel-show',['id' => $id ])->with('success','New Content Added To Channel.');
    }

   public function showupdate(Request $request, $id)
    {
        $cid = Channelcontent::findOrFail($id);        
        $cid->update($request->all());
        return redirect()->route('user-channel-show',['id' => $cid->channel->id ])->with('success','Content Updated Successfully.');
    }

   public function viddelete($id)
    {
        $cid = Channelcontent::findOrFail($id);
        $cid->delete();
        return redirect()->route('user-channel-show',['id' => $cid->channel->id ])->with('success','Content Removed Successfully');
    }


    public function store(UpdateValidationRequest $request)
    {
		$this->validate($request, [
	        'photo' => 'required'
	    ]);
        $channel = new Channel();
        $data = $request->all();
        if ($file = $request->file('photo')) 
         {      
            $name = time().$file->getClientOriginalName();
            $file->move('assets/files/images',$name);           
            $data['photo'] = $name;
         } 
        $channel->fill($data)->save();
        return redirect()->route('user-channel-index')->with('success','New Channel Added Successfully.');
    }


    public function edit($id)
    {
        $channel = Channel::findOrFail($id);    	
        return view('user.channel.edit',compact('channel'));
    }

    public function update(UpdateValidationRequest $request, $id)
    {
        $channel = Channel::findOrFail($id);
        $data = $request->all();
            if ($file = $request->file('photo')) 
            {              
                $name = time().$file->getClientOriginalName();
                $file->move('assets/files/images',$name);
                if($channel->photo != null)
                {
                    unlink(public_path().'/assets/files/images/'.$channel->photo);
                }            
            $data['photo'] = $name;
            } 
        $channel->update($data);
        return redirect()->route('user-channel-index')->with('success','Channel Updated Successfully.');
    }


    public function destroy($id)
    {
        $channel = Channel::findOrFail($id);
        if($channel->contents->count()>0)
        {
        return redirect()->route('user-channel-index')->with('unsuccess','Remove Contents First!!');
        }
        if($channel->subscribes->count()>0)
        {
            foreach($channel->subscribes as $subs)
            {
                $subs->delete();
            }
        }
        unlink(public_path().'/assets/files/images/'.$channel->photo);
        $channel->delete();
        return redirect()->route('user-channel-index')->with('success','Channel Deleted Successfully.');
    }
}
