<?php

namespace App\Http\Controllers\Json;

use Illuminate\Support\Facades\Request;
use App\Http\Controllers\Controller;
use App\Video;
use App\Like;
use App\Comment;
use App\Reply;
use App\Subscriber;
use App\Commentlike;
use App\Replylike;
use App\Playlistvideo;
use App\Channel;
use App\Channelcontent;
use App\Playlist;
use Auth;
use App\Subscribe;
class JsonRequestController extends Controller
{

    public function showcnt()
    {
        $id = $_GET['id'];
        if($id == 1)
        {
            $playlist = Playlist::where('user_id','=',Auth::guard('user')->user()->id)->get();
            return response()->json($playlist);            
        }
        if($id == 2)
        {
            $video = Video::where('user_id','=',Auth::guard('user')->user()->id)->get();
            foreach($video as $vid)
            {
                $vid->title = substr($vid->title,0,50);
            }
            return response()->json($video);    
        }

    }

    public function subscribe()
    {

        $id = $_GET['id'];
        $data = 0;
        $chck = Subscribe::where('channel_id','=',$id)->where('user_id','=',Auth::guard('user')->user()->id)->first();
        if($chck)
        {
            $ck = Subscribe::findOrFail($chck->id);
            $ck->delete(); 
            $data = 1;
            return response()->json($data);  
        }
        $subscribe = new Subscribe();
        $subscribe->channel_id = $id;
        $subscribe->user_id = Auth::guard('user')->user()->id;
        $subscribe->save();
        return response()->json($data);  
    }

    public function usersubscribe()
    {
        $scribed_id = $_GET['uid'];
        $scriber_id = Auth::guard('user')->user()->id;
        $sub_cond['scribed_id'] = $scribed_id;
        $sub_cond['scriber_id'] = $scriber_id;
        $myscribe = Subscriber::where($sub_cond);
        $result = 0;
        if($myscribe->count() == 0)
        {
            $subscriber = new Subscriber();
            $subscriber->scribed_id = $scribed_id;
            $subscriber->scriber_id = $scriber_id;
            $subscriber->email = '';
            $subscriber->save();
            $result = 1;

        }else if($myscribe->count() > 0){
            $myscribe->first()->delete();
            $result = 0;
        }
        return response()->json($result);  

    }

    public function showimg()
    {
        $id = $_GET['id'];
        $video = Video::findOrFail($id);
        return response()->json($video);
    }

    public function showply()
    {
        $id = $_GET['id'];
        $video = Playlist::findOrFail($id);
        return response()->json($video);
    }

    public function comment()
    {
    $comment = new Comment;
    $comment->user_id = $_POST['uid'];
    $comment->video_id = $_POST['vid'];
    $comment->text = $_POST['cmnt'];
    $comment->save();
    $comments = Comment::where('video_id','=',$_POST['vid'])->get()->count();
    $data[0] = $comment->user->photo;
    $data[1] = $comment->user->name;
    $data[2] = $comment->created_at->diffForHumans();
    $data[3] = $comment->text;
    $data[4] = $comment->id;
    $data[5] = $comment->user->id;
    $data[6] = $comments;
    return response()->json($data);
    } 

    public function commentedit()
    {
    $id = $_POST['id'];
    $txt = $_POST['txt'];
    $comment =Comment::findOrFail($id);
    $comment->text = $txt;
    $comment->update();
    return response()->json($comment);
    } 

    public function commentdelete()
    {
    $id = $_GET['id'];
    $comment =Comment::findOrFail($id);
    if($comment->replies->count() > 0)
    {
        foreach ($comment->replies as $reply) {
            $reply->delete();
        }
    }
    if($comment->commentlikes->count() > 0)
    {
        foreach ($comment->commentlikes as $like) {
            $like->delete();
        }
    }
    $comment->delete();
    } 

    public function replyedit()
    {
    $id = $_POST['id'];
    $txt = $_POST['txt'];
    $reply =Reply::findOrFail($id);
    $reply->text = $txt;
    $reply->update();
    return response()->json($reply);
    } 

    public function replydelete()
    {
    $id = $_GET['id'];
    $reply =Reply::findOrFail($id);
    $comment = $reply->comment;
    if($reply->replylikes->count() > 0)
    {
        foreach ($reply->replylikes as $like) {
            $like->delete();
        }
    }
    $reply->delete();
    $data[0] = $comment->id;
    $data[1] = $comment->replies->count();
    return response()->json($data);
    } 

    public function reply()
    {
    $reply = new Reply;
    $reply->user_id = $_POST['uid'];
    $reply->comment_id = $_POST['cid'];
    $reply->text = $_POST['rpl'];
    $reply->save();
    $replies = Reply::where('comment_id','=',$_POST['cid'])->get()->count();
    $data[0] = $reply->user->photo;
    $data[1] = $reply->user->name;
    $data[2] = $reply->created_at->diffForHumans();
    $data[3] = $reply->text;
    $data[4] = $replies;
    $data[5] = $reply->id;
    return response()->json($data);
    } 

    public function playlist()
    {
    $videos = null;
    $id = $_GET['id'];
    $pid = $_GET['pid'];
    $video = Playlistvideo::where('playlist_id','=',$pid)->where('id','>', $id)->get();
    $i = 0;
    foreach ($video as $vid) {
        if($vid->video->is_top == 0 && $vid->video->is_slider == 0)
        {
            $videos[$i]['title'] = $vid->video->title;
            $videos[$i]['user_id'] = $vid->video->user->name;
            $videos[$i]['type'] = $vid->video->type;
            $videos[$i]['thumbnail'] = $vid->video->thumbnail;
            $videos[$i]['views'] = $vid->video->views;
            $videos[$i]['id'] = $vid->video->id;   
            $videos[$i]['playlist_id'] = $vid->playlist_id;    
            $i++;
        }
    }
    return response()->json($videos);
    }

	public function loadmore()
	{
    	$id = $_GET['id'];
    	$cid = $_GET['cat_id'];
    	$video = Video::where('category_id','=',$cid)->where('id','>', $id)->where('is_top','=',0)->where('is_slider','=',0)->take(4)->get();
    	
    	foreach ($video as $vid) {
    			$vid->user_id = $vid->user->name;
    	}
    	return response()->json($video);
	}

	public function like()
	{
	$uid = $_GET['uid'];
	$vid = $_GET['vid'];
	$status = 0;
    $chck = Like::where('video_id','=',$vid)->where('user_id','=',$uid)->first();
        if($chck)
        {
            $lk = Like::findOrFail($chck->id);
            if($lk->is_like == 1)
                {
                    $lk->delete();
                    $status = 2;             
                }
            else
                {
                    $lk->is_dislike = 0;
                    $lk->is_like =1;
                    $lk->update();    
                    $status = 1;        
                }
            $likes = Like::where('video_id','=',$vid)->where('is_like','=',1)->get()->count();
        }
        else
        {
            $like = new Like;
            $like->video_id = $vid;
            $like->user_id = $uid;
            $like->is_like = 1;
            $like->save();
            $likes = Like::where('video_id','=',$vid)->where('is_like','=',1)->get()->count();
        }	
	}

    public function commentlike()
    {
    $uid = $_GET['uid'];
    $cid = $_GET['cid'];
    $status = 0;

    $chck = Commentlike::where('comment_id','=',$cid)->where('user_id','=',$uid)->first();
        if($chck)
        {

            $lk = Commentlike::findOrFail($chck->id);
            if($lk->is_like == 1)
                {
                    $lk->delete();
                    $status = 2;             
                }
            else
                {
                    $lk->is_dislike = 0;
                    $lk->is_like =1;
                    $lk->update();    
                    $status = 1;        
                }
            $likes = Commentlike::where('comment_id','=',$cid)->where('is_like','=',1)->get()->count();
            $dislikes = Commentlike::where('comment_id','=',$cid)->where('is_dislike','=',1)->get()->count();
            $data[0] = $likes;
            $data[1] = $status;
            $data[2] = $dislikes;
            return response()->json($data);
        }
        else
        {
            $like = new CommentLike;
            $like->comment_id = $cid;
            $like->user_id = $uid;
            $like->is_like = 1;
            $like->save();
            $likes = Commentlike::where('comment_id','=',$cid)->where('is_like','=',1)->get()->count();
            $data[0] = $likes;
            $data[1] = $status;
            return response()->json($data);
        }   
    }

    public function replylike()
    {
    $uid = $_GET['uid'];
    $cid = $_GET['cid'];
    $status = 0;

    $chck = Replylike::where('reply_id','=',$cid)->where('user_id','=',$uid)->first();
        if($chck)
        {

            $lk = Replylike::findOrFail($chck->id);
            if($lk->is_like == 1)
                {
                    $lk->delete();
                    $status = 2;             
                }
            else
                {
                    $lk->is_dislike = 0;
                    $lk->is_like =1;
                    $lk->update();    
                    $status = 1;        
                }
            $likes = Replylike::where('reply_id','=',$cid)->where('is_like','=',1)->get()->count();
            $dislikes = Replylike::where('reply_id','=',$cid)->where('is_dislike','=',1)->get()->count();
            $data[0] = $likes;
            $data[1] = $status;
            $data[2] = $dislikes;
            return response()->json($data);
        }
        else
        {
            $like = new Replylike;
            $like->reply_id = $cid;
            $like->user_id = $uid;
            $like->is_like = 1;
            $like->save();
            $likes = Replylike::where('reply_id','=',$cid)->where('is_like','=',1)->get()->count();
            $data[0] = $likes;
            $data[1] = $status;
            return response()->json($data);
        }   
    }

	public function dislike()
	{
	$uid = $_GET['uid'];
	$vid = $_GET['vid'];
	$status = 0;
    $chck = Like::where('video_id','=',$vid)->where('user_id','=',$uid)->first();
        if($chck)
        {
            $lk = Like::findOrFail($chck->id);
            if($lk->is_dislike == 1)
                {
                    $lk->delete();  
                    $status = 2;           
                }
            else
                {
                    $lk->is_like = 0;
                    $lk->is_dislike =1;
                    $lk->update();
                    $status = 1;            
                }
            $dislikes = Like::where('video_id','=',$vid)->where('is_dislike','=',1)->get()->count();

        }
        else
        {
            $like = new Like;
            $like->video_id = $vid;
            $like->user_id = $uid;
            $like->is_dislike = 1;
            $like->save();
            $dislikes = Like::where('video_id','=',$vid)->where('is_dislike','=',1)->get()->count();

        }	
	}
    public function commentdislike()
    {
    $uid = $_GET['uid'];
    $cid = $_GET['cid'];
    $status = 0;

    $chck = Commentlike::where('comment_id','=',$cid)->where('user_id','=',$uid)->first();
        if($chck)
        {

            $lk = Commentlike::findOrFail($chck->id);
            if($lk->is_dislike == 1)
                {
                    $lk->delete();
                    $status = 2;             
                }
            else
                {
                    $lk->is_dislike = 1;
                    $lk->is_like =0;
                    $lk->update();    
                    $status = 1;        
                }
            $dislikes = Commentlike::where('comment_id','=',$cid)->where('is_dislike','=',1)->get()->count();
            $likes = Commentlike::where('comment_id','=',$cid)->where('is_like','=',1)->get()->count();
            $data[0] = $dislikes;
            $data[1] = $status;
            $data[2] = $likes;           
            return response()->json($data);
        }
        else
        {
            $like = new CommentLike;
            $like->comment_id = $cid;
            $like->user_id = $uid;
            $like->is_dislike = 1;
            $like->save();
            $likes = Commentlike::where('comment_id','=',$cid)->where('is_dislike','=',1)->get()->count();
            $data[0] = $likes;
            $data[1] = $status;
            return response()->json($data);
        }   
    }
    public function replydislike()
    {
    $uid = $_GET['uid'];
    $cid = $_GET['cid'];
    $status = 0;

    $chck = Replylike::where('reply_id','=',$cid)->where('user_id','=',$uid)->first();
        if($chck)
        {

            $lk = Replylike::findOrFail($chck->id);
            if($lk->is_dislike == 1)
                {
                    $lk->delete();
                    $status = 2;             
                }
            else
                {
                    $lk->is_dislike = 1;
                    $lk->is_like =0;
                    $lk->update();    
                    $status = 1;        
                }
            $dislikes = Replylike::where('reply_id','=',$cid)->where('is_dislike','=',1)->get()->count();
            $likes = Replylike::where('reply_id','=',$cid)->where('is_like','=',1)->get()->count();
            $data[0] = $dislikes;
            $data[1] = $status;
            $data[2] = $likes;           
            return response()->json($data);
        }
        else
        {
            $like = new Replylike;
            $like->reply_id = $cid;
            $like->user_id = $uid;
            $like->is_dislike = 1;
            $like->save();
            $likes = Replylike::where('reply_id','=',$cid)->where('is_dislike','=',1)->get()->count();
            $data[0] = $likes;
            $data[1] = $status;
            return response()->json($data);
        }   
    }
}
