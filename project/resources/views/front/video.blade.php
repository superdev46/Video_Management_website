@extends('layouts.front')

@section('styles')
<style type="text/css">
.lactive{
  color: #2ec0bc;
}  
</style>

@if($channel == null)
<style type="text/css">
  
  .single-video-content li.visited {
    width: 525px;
}
</style>
@endif
@endsection

@section('contents')
<div class="container" style="height: 30px;"></div>
<div class="container">
  <div class="row single-video-area">
    <div class="col-md-8">
      <div class="single-video-img-area">
        @if($video->type == 0)
        @php
            $val = strpos($video->path,".");
            $ext = substr($video->path,$val+1);
        @endphp
  <!--*****************************************DISPLAYING VIDEO ************************************-->
        <div id="my-video"></div>              
        @else
         @if (strpos($video->url, 'youtube') !== false)
         @php
            $queryString = parse_url($video->url, PHP_URL_QUERY);
            parse_str($queryString, $params);
            if (isset($params['v']) && strlen($params['v']) > 0) {
                $id =  $params['v'];
            } 
         @endphp
            <iframe src="https://www.youtube.com/embed/{{$id}}" allowfullscreen>
                          </iframe>
         @endif
         @if (strpos($video->url, 'dailymotion') !== false)
         @php
        $pos = strpos($video->url,"video");
        $id = substr($video->url,$pos+6);                 
         @endphp
            <iframe src="https://www.dailymotion.com/embed/video/{{$id}}" allowfullscreen></iframe>
         @endif
         @if (strpos($video->url, 'vimeo') !== false)
         @php
         $id = preg_replace('/[^0-9]/', '', $video->url);                
         @endphp
            <iframe src="https://player.vimeo.com/video/{{$id}}" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
         @endif
        @endif
      </div>
  <!--*****************************************DISPLAYING ENDS ************************************-->
      
      <div class="single-video-likes">
        <ul>
          <li class="visited">{{$video->views}} views</li>
  <!--*****************************************USER AUTHENTICATION************************************-->

          <li class="float-right"><a class="a2a_dd" href=""><i class="fa fa fa-share"></i> Share</a>
          <script async src="https://static.addtoany.com/menu/page.js"></script>
          </li>

          @if(Auth::guard('user')->check())
          <li class="float-right">
            <a><i class="fa fa fa-thumbs-down {{isset($val2) ? 'lactive':''}}" id="dislike" style="cursor: pointer;"></i> <span id="dn">{{count($dislikes)}}</span></a>
          </li>
          <input type="hidden" id="dcheck" value="{{isset($val2) ? '1':'0'}}">

          <li class="float-right">
            <a><i class="fa fa fa-thumbs-up {{isset($val1) ? 'lactive':''}}" id="like" style="cursor: pointer;"></a></i> <span id="ln">{{count($likes)}}</span>
          </li>
          <input type="hidden" id="lcheck" value="{{isset($val1) ? '1':'0'}}">
          
          @else

          <li class="float-right"><a href="{{route('user.dislikes',$video->id)}}"><i class="fa fa fa-thumbs-down {{isset($val2) ? 'lactive':''}}"></i></a> {{count($dislikes)}}</li>

          <li class="float-right"><a href="{{route('user.likes',$video->id)}}"><i class="fa fa fa-thumbs-up {{isset($val1) ? 'lactive':''}}"></i></a> {{count($likes)}}</li>
          
          @endif
          
          @if($channel != null)
          @if($channel->count() > 0)                  
          <li>
            @if(Auth::guard('user')->check())
            @php
            if($schck == 1)
            $color = "style='color: #2ec0bc; cursor:pointer;'";
            else
            $color ="style='cursor:pointer;'"; 
            @endphp
            <a class="fa fa-youtube-play" id="subscribe" {!!$color!!}> {{$schck == 1 ? 'Subscribed':'Subscribe'}}</a>
            <input type="hidden" id="channel" value="{{$channel->channel->id}}">
            @else
            @php
            if($schck == 1)
            $color = "style='color: #2ec0bc;'";
            else
            $color =""; 
            @endphp
            <a href="{{route('user.subscribe',['id1' => $channel->channel->id , 'id2' => $video->id])}}" class="fa fa-youtube-play" {!!$color!!}> {{$schck == 1 ? 'Subscribed':'Subscribe'}}</a>                    
            @endif
          </li>
          @endif
          @endif
        </ul>
      </div>

  <!--*****************************************DISPLAYING VIDEO  INFO************************************-->
      <div class="single-video-content">
        <div class="video-content-bottom">
              @if($video->user_id != null)
              <img src="{{$video->user->photo != null ? asset('assets/files/images/'.$video->user->photo) : 'http://fulldubai.com/SiteImages/noimage.png'}}" alt="Logo" class="img-responsive">
              @endif

            <div class="video-content-rightside">
              <h4><a href="{{route('front.userinfo',$video->user->id)}}">{{$video->user_id == null ? "Admin":$video->user->name}} <i class="fa fa fa-check-circle"></i><a> <span>Published {{$video->created_at->diffForHumans()}}</span></h4>

              <h3>{{ $video->title }}</h3>  
              <span>{!! $video->text !!}</span>
           <!--    @php
              $string = "";
              $size = strlen($video->text);
              if($size > 200)
              {
                $string = substr($video->text,201,$size);
              }
              @endphp

              <span> {!! strlen($video->text) > 200  ? substr($video->text,0,200) :  $video->text!!}<span id="more" style="display: none;">{!!$string!!}</span></span> -->
          
            </div>
        </div>
<!--***************************************DISPLAYING VIDEO  INFO ENDS***********************************-->
<!--********************************************COMMENT SECTION**************************************-->

<div class="video-comments-section" style="margin-top: 10px;">
                @if(Auth::guard('user')->check())

<!--*****************************************COMMENT COUNTS************************************-->
                  <p><span id="cmnt-count" style="font-size: 16px; margin: 0 0 10px;">{{count($video->comments)}} {{ count($video->comments) > 1 ? "Comments":"Comment"}}</span></p>
<!--*****************************************COMMENT COUNTS END************************************-->                  
                  <div class="video-comments-form">
                    <form action="" method="POST" id="cmnt">
                      {{csrf_field()}}
                      <div class="row">
                        <div class="col-md-1 col-sm-1 col-xs-2">
                          <img src="{{$user->photo != null  ? asset('assets/files/images/'.$user->photo) : 'http://fulldubai.com/SiteImages/noimage.png'}}" alt="Profile image">
                        </div>
                        <div class="col-md-11 col-sm-11 col-xs-10">
                          <div class="form-group">
                            <input type="hidden" name="video_id" value="{{$video->id}}">
                            <input type="hidden" name="user_id" value="{{Auth::guard('user')->user()->id}}">
                            <textarea class="form-control" placeholder="Write Your Comments Here..." id="txtcmnt" rows="3" name="text" required=""></textarea>
                          </div>
                          <div class="form-group text-right">
                            <button type="submit" class="btn btn-bordered" id="cmnt-btn">COMMENT</button>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                @endif
                @if($video->comments)
                @foreach($video->comments()->orderBy('created_at','desc')->get() as $comment)
                  <div class="user-comments-area">
                    <div class="single-user-comments">
                      <div class="row">
                        <div class="col-md-1 col-sm-1 col-xs-2">
                          <img src="{{$comment->user->photo != null ? asset('assets/files/images/'.$comment->user->photo): 'http://fulldubai.com/SiteImages/noimage.png'}}" alt="Profile image">
                        </div>
                        <div class="col-md-11 col-sm-11 col-xs-10">
                          <h5 class="user-name">{{$comment->user->name}}
                            <span class="comments-meta-date" style="font-size: 10px;">{{ $comment->created_at->diffForHumans()}}</span>
                          </h5>
                          <p id="ctext{{$comment->id}}">{{$comment->text}}</p>
                          <ul>
                        @if(Auth::guard('user')->check())
                        <li>
                          <div class="cmntlikes">
                          <a><i class="fa fa fa-thumbs-up {{count($comment->commentlikes()->where('comment_id',$comment->id)->where('user_id',Auth::guard('user')->user()->id)->where('is_like',1)->get()) == 1 ? 'lactive':''}}" id="cmntlike{{$comment->id}}" style="cursor: pointer;"></i>
                          </a>
                          <span id="cmntlktext{{$comment->id}}">{{count($comment->commentlikes()->where('is_like',1)->get())}}</span>
                        <input type="hidden" value="{{$comment->id}}">  
                        <input type="hidden" id="clkchck{{$comment->id}}" value="{{count($comment->commentlikes()->where('comment_id',$comment->id)->where('user_id',Auth::guard('user')->user()->id)->where('is_like',1)->get()) == 1 ? '1':'0'}}">
                        </div>                     
                        </li>
                        <li>
                          <div class="cmntdislikes">
                          <a><i class="fa fa fa-thumbs-down {{count($comment->commentlikes()->where('comment_id',$comment->id)->where('user_id',Auth::guard('user')->user()->id)->where('is_dislike',1)->get()) == 1 ? 'lactive':''}}" id="cmntdislike{{$comment->id}}" style="cursor: pointer;"></i></a> 
                          <span id="cmntdktext{{$comment->id}}">{{count($comment->commentlikes()->where('is_dislike',1)->get())}}</span>
                        <input type="hidden" value="{{$comment->id}}">
                        <input type="hidden" id="cdkchck{{$comment->id}}" value="{{count($comment->commentlikes()->where('comment_id',$comment->id)->where('user_id',Auth::guard('user')->user()->id)->where('is_dislike',1)->get()) == 1 ? '1':'0'}}">
                          </div>
                        </li>
                        @if($comment->user->id == $user->id)
                        <li>
                          <div class="cmntedit">
                            <a  style="cursor: pointer;">Edit</a>
                            <input type="hidden" value="{{$comment->id}}">
                          </div>
                          <div class="cmntcancel" style="display: none;">
                            <a  style="cursor: pointer;">Cancel</a>
                            <input type="hidden" value="{{$comment->id}}">
                          </div>
                        </li>
                        <li>
                          <div class="cmntdelete">
                          <a id="dlt{{$comment->id}}" style="cursor: pointer;">Delete</a>
                            <input type="hidden" value="{{$comment->id}}">                            
                          </div>

                        </li>
                        <li>
                          <form action="" method="post" id="edtfrm{{$comment->id}}">
                            {{csrf_field()}}
                          <input type="text" class="form-control" id="edt{{$comment->id}}" placeholder="Write Your Comment & Press Enter" required="" style="width: 450px; display: none;">
                        </form>
                      </li>
                      @endif
                        @else
    
<li><a href="{{route('comment.likes',$comment->id)}}"><i class="fa fa fa-thumbs-up"></i></a> {{count($comment->commentlikes()->where('is_like',1)->get())}}</li>

<li><a href="{{route('comment.dislikes',$comment->id)}}"><i class="fa fa fa-thumbs-down"></i></a> {{count($comment->commentlikes()->where('is_dislike',1)->get())}}</li>                  
                        @endif
                          </ul>
                          <hr style="margin-top: 8px; margin-bottom: 0px; border-top: 1px solid #FFF;">
                            <a style="cursor: pointer;" class="toggle-reply"><b id="r{{$comment->id}}">
{{count($comment->replies) > 0 ? count($comment->replies) > 1 ? count($comment->replies)." Replies": "1 Reply" : "Reply"}}</b></a>

<!--******************************************COMMENT SECTION ENDS**************************************-->
<!--*********************************************REPLY SECTION*******************************************-->                  
                  <div class="video-comments-form" style="display: none;">
                    @if($comment->replies)
                      <div id="reply-block{{$comment->id}}">
                      <input type="hidden"  id="cmnt_id{{$comment->id}}" value="{{$comment->id}}">
                      @foreach($comment->replies()->orderBy('created_at','desc')->get() as $reply)

                     <div class="row">
                        <div class="col-md-1 col-sm-1 col-xs-2">
                          <img src="{{$reply->user->photo != null ?asset('assets/files/images/'.$reply->user->photo) : 'http://fulldubai.com/SiteImages/noimage.png'}}" alt="Profile image">
                        </div>
                        <div class="col-md-11 col-sm-11 col-xs-10">
                          <h5 class="user-name">{{$reply->user->name}}
                            <span class="comments-meta-date" style="font-size: 10px;">{{ $reply->created_at->diffForHumans()}}</span>
                          </h5>
                          <p id="rtxt{{$reply->id}}">{{$reply->text}}</p>
                          <ul>
                        @if(Auth::guard('user')->check())
                        <li>
                          <div class="rpllikes">
                          <a><i class="fa fa fa-thumbs-up {{count($reply->replylikes()->where('reply_id',$reply->id)->where('user_id',Auth::guard('user')->user()->id)->where('is_like',1)->get()) == 1 ? 'lactive':''}}" id="rpllike{{$reply->id}}" style="cursor: pointer;"></i>
                          </a>
                          <span id="rpllktext{{$reply->id}}">{{count($reply->replylikes()->where('is_like',1)->get())}}</span>
                        <input type="hidden" value="{{$reply->id}}">  
                        </div>                     
                        </li>
                        <li>
                          <div class="rpldislikes">
                          <a><i class="fa fa fa-thumbs-down {{count($reply->replylikes()->where('reply_id',$reply->id)->where('user_id',Auth::guard('user')->user()->id)->where('is_dislike',1)->get()) == 1 ? 'lactive':''}}" id="rpldislike{{$reply->id}}" style="cursor: pointer;"></i></a> 
                          <span id="rpldktext{{$reply->id}}">{{count($reply->replylikes()->where('is_dislike',1)->get())}}</span>
                        <input type="hidden" value="{{$reply->id}}">
                          </div>
                        </li>
                        @if($reply->user->id == $user->id)
                        <li>
                          <div class="rpledit">
                            <a  style="cursor: pointer;">Edit</a>
                            <input type="hidden" value="{{$reply->id}}">
                          </div>
                          <div class="rplcancel" style="display: none;">
                            <a  style="cursor: pointer;">Cancel</a>
                            <input type="hidden" value="{{$reply->id}}">
                          </div>
                        </li>
                        <li>
                          <div class="rpldelete">
                          <a id="dlt{{$reply->id}}" style="cursor: pointer;">Delete</a>
                            <input type="hidden" value="{{$reply->id}}">                            
                          </div>

                        </li>
                        <li>
                          <form action="" method="post" id="rpledtfrm{{$reply->id}}">
                            {{csrf_field()}}
                          <input type="text" class="form-control" id="rpledt{{$reply->id}}" placeholder="Write Your Reply & Press Enter" required="" style="width: 380px; display: none;">
                        </form>
                      </li>
                        @endif
                        </ul
                          @else
<li><a href="{{route('reply.likes',$reply->id)}}"><i class="fa fa fa-thumbs-up"></i></a> {{count($reply->replylikes()->where('is_like',1)->get())}}</li>

<li><a href="{{route('reply.dislikes',$reply->id)}}"><i class="fa fa fa-thumbs-down"></i></a> {{count($reply->replylikes()->where('is_dislike',1)->get())}}</li>
                        @endif
                          </ul>

                        </div>
                      </div>
                    <hr style="margin-top: 8px; margin-bottom: 5px; border-top: 1px solid #FFF;">
                      @endforeach
                    </div>
                  @endif
                      
                    @if(Auth::guard('user')->check())     
                    <hr style="margin-top: 8px; margin-bottom: 5px; border-top: 1px solid #FFF;">                
                    <form action="" method="POST" id="rpl{{$comment->id}}">
                      <input type="hidden" name="comment_id"  value="{{$comment->id}}">
                      {{csrf_field()}}
                      <div class="row">
                        <div class="col-md-1 col-sm-1 col-xs-2">
                          <img src="{{$user->photo != null  ? asset('assets/files/images/'.$user->photo) : 'http://fulldubai.com/SiteImages/noimage.png'}}" alt="Profile image">
                        </div>
                        <div class="col-md-11 col-sm-11 col-xs-10">

                          <input type="hidden" name="user_id" id="usr_id{{$comment->id}}" value="{{Auth::guard('user')->user()->id}}">
                          <div class="form-group">
                            <textarea class="form-control" name="text" placeholder="Write Your Replies Here..." id="txtrpl{{$comment->id}}" rows="2" required=""></textarea>
                          </div>

                          <div class="form-group text-right">
                            <button type="submit" id="rpl-btn{{$comment->id}}" class="btn btn-bordered">REPLY</button>
                          </div>
                        </div>
                      </div>
                    </form>
                    @endif
                  </div>
                        </div>
                      </div>
                    </div>

                  </div>
                  @endforeach

                @endif
                </div>
              </div>
            </div>
<!--******************************************REPLY SECTION ENDS****************************************-->

<!--******************************************SIDE VIDEOS****************************************-->
            <div class="col-md-4">
              <div class="load-more">
            @php
            $i = 1;
            @endphp
              @foreach($vids as $vid)
              @if($video->id != $vid->id)
              <div class="single-video-next-area">
                <div class="col-md-6">
                <a href="{{route('front.video',$vid->id)}}">
                  @if($vid->type == 0)
                   <img src="{{asset('assets/files/images/'.$vid->thumbnail)}}" class="img-responsive">
                   @else
                   <img src="{{$vid->thumbnail}}" class="img-responsive">                   
                   @endif
                </a>
                </div>
                <div class="col-md-6 video-next-content-area">
                  <a href="{{route('front.video',$vid->id)}}"><h4>{{($vid->title)}}</h4></a>
                  <p class="video-next-meta">{{$vid->user_id == null ? "Admin":$vid->user->name}} <span>{{$vid->views}} Views</span></p>
                </div>
              </div>
              @php
              if($i == 5)
              break;
              $i++;
              @endphp
              @endif
              @endforeach
              </div>
              <br>
              <div class="text-center">
              <button type="button" class="btn btn-default" id="load" value="$vid->id">
                <img src="{{asset('assets/front/img/btn-loader.gif')}}" id="loader" style="float: right; margin-top: 2px; display: none;">
              LOAD MORE&nbsp;</button>
              </div>
            </div>
          </div>
      </div>
<div class="container" style="height: 20px;"></div>
<!--******************************************SIDE VIDEOS ENDS****************************************-->

<!--************************************** HIDDEN INPUTS FOR AJAX ***********************************-->
<input type="hidden"  id="tid" value="{{$cat->id}}">

<input type="hidden"  id="vid" value="{{$video->id}}">
@if(Auth::guard('user')->check())
<input type="hidden"  id="uid" value="{{Auth::guard('user')->user()->id}}">
@endif
<!--******************************* HIDDEN INPUTS FOR AJAX ENDS ***************************-->
@endsection

@section('scripts')

<script type="text/javascript">
  //***************************** SUBSCRIBE******************************
$(document).ready(function(){

  $("#subscribe").click(function(){

    var chid = $("#channel").val();

    $.ajax({
            type: "GET",
            url:"{{URL::to('subscribe')}}",
            data:{id:chid},
            success:function(data){
               if(data == 0){
               $("#subscribe").css({"cursor":"icon"});
               $("#subscribe").css({"color":"#2ec0bc"});
               $("#subscribe").html(" Subscribed");
               }
               else
               {
               $("#subscribe").css({"cursor":"icon"});
               $("#subscribe").css({"color":"#555"});
               $("#subscribe").html(" Subscribe");

               }
              }
      });
  });
    
});  
  //***************************** SUBSCRIBE ENDS******************************
</script>



<script type="text/javascript">
//**************************************COMMENT EDIT***************************************  
$(document).on("click", ".cmntedit" , function(){
var cid = $(this).find('input[type=hidden]').val();
$("#edt"+cid).show();
$(this).next().show();
$(this).hide();
$("#edtfrm"+cid).submit( function () {
          var txt = $("#edt"+cid).val();
          $("#edt"+cid).prop('disabled',true);                   
          $.ajax({
                  type: "POST",
                  url:"{{URL::to('commentedit')}}",
                  data:{
                    '_token': $('input[name=_token]').val(),
                    'id':cid ,
                    'txt':txt
                      },
                  success:function(data){
                    $("#ctext"+cid).html(data['text']); 
                    $("#edt"+cid).val(""); 
                    $("#edt"+cid).prop('disabled',false);
                    }
            });  
            $("#edt"+cid).hide();
            $(this).parent().prev().prev().find('.cmntcancel').hide();
            $(this).parent().prev().prev().find('.cmntedit').show();
            return false;
   });    
});
//**************************************COMMENT EDIT ENDS*************************************** 
</script>

<script type="text/javascript">
//**************************************COMMENT CANCEL***************************************  
$(document).on("click", ".cmntcancel" , function(){
var cid = $(this).find('input[type=hidden]').val();
$("#edt"+cid).hide();
$(this).prev().show();
$(this).hide();
//**************************************COMMENT CANCEL ENDS***************************************          
});
</script>


<script type="text/javascript">
//**************************************COMMENT DELETE***************************************  
$(document).on("click", ".cmntdelete" , function(){
      var cid = $(this).find('input[type=hidden]').val();   
      var count = $("#cmnt-count").html().match(/\d+/);
                $.ajax({
                        type: "GET",
                        url:"{{URL::to('commentdelete')}}",
                        data:{id:cid},
                        success:function(data){
                          }
                  }); 
count--;
  if(count > 1){
    $("#cmnt-count").html(count + " Comments");
  }
  else{
    $("#cmnt-count").html(count + " Comment");
  }                

 $(this).parent().parent().parent().parent().hide("slow");   
//**************************************COMMENT DELETE ENDS***************************************   
});
</script>

<script type="text/javascript">
//**************************************REPLY EDIT***************************************  
$(document).on("click", ".rpledit" , function(){
var cid = $(this).find('input[type=hidden]').val();
$("#rpledt"+cid).show();
$(this).next().show();
$(this).hide();
$("#rpledtfrm"+cid).submit( function () {
          var txt = $("#rpledt"+cid).val();
          $("#rpledt"+cid).prop('disabled',true);                   
          $.ajax({
                  type: "POST",
                  url:"{{URL::to('replyedit')}}",
                  data:{
                    '_token': $('input[name=_token]').val(),
                    'id':cid ,
                    'txt':txt
                      },
                  success:function(data){
                    $("#rtxt"+cid).html(data['text']); 
                    $("#rpledt"+cid).val(""); 
                    $("#rpledt"+cid).prop('disabled',false);
                    }
            });  
            $("#rpledt"+cid).hide();
            $(this).parent().prev().prev().find('.rplcancel').hide();
            $(this).parent().prev().prev().find('.rpledit').show();
            return false;
   });    
//**************************************REPLY EDIT ENDS***************************************  
});
</script>

<script type="text/javascript">
//**************************************REPLY CANCEL***************************************  
$(document).on("click", ".rplcancel" , function(){
var cid = $(this).find('input[type=hidden]').val();
$("#rpledt"+cid).hide();
$(this).prev().show();
$(this).hide();
//**************************************REPLY CANCEL ENDS***************************************          
});
</script>


<script type="text/javascript">
//**************************************REPLY DELETE ***************************************  
$(document).on("click", ".rpldelete" , function(){
      var cid = $(this).find('input[type=hidden]').val();   
                $.ajax({
                        type: "GET",
                        url:"{{URL::to('replydelete')}}",
                        data:{id:cid},
                        success:function(data){
                          if(data[1] > 1 )
                          {
                            $("#r"+data[0]).html(data[1]+" Replies");
                          }
                          else
                          {
                            $("#r"+data[0]).html(data[1]+" Reply");           
                          }
                          }
                  }); 
 $(this).parent().parent().parent().parent().hide("slow");   
});
//**************************************REPLY DELETE ***************************************  
</script>

<script type="text/javascript">
//**************************************COMMENTLIKES***************************************  
$(document).on("click", ".cmntlikes" , function(){
var cid = $(this).find('input[type=hidden]').val();
var uid = $("#uid").val();
var l = $("#clkchck"+cid).val();
var d = $("#cdkchck"+cid).val();
var a = $("#cmntlktext"+cid).html();
var b = $("#cmntdktext"+cid).html();
if(l == 1)
{
  $("#cmntlike"+cid).css({"color":"#555"});
  a--;
  $("#cmntlktext"+cid).html(a);
  $("#clkchck"+cid).val("0");
}
else
{
  $("#cmntlike"+cid).css({"color":"#2ec0bc"});
  a++;
  $("#cmntlktext"+cid).html(a);
  $("#clkchck"+cid).val("1");
}

//$("#cmntlike"+cid).css({"color":"#555"});
    // $.ajax({
    //         type: "GET",
    //         url:"{{URL::to('commentlike')}}",
    //         data:{cid:cid , uid:uid},
    //         success:function(data){
    //           $("#cmntlktext"+cid).html(data[0]);
    //            if(data[1] == 0){
    //            $("#cmntlike"+cid).css({"color":"#2ec0bc"});
    //            }
    //            else if (data[1] == 1){
    //            $("#cmntlike"+cid).css({"color":"#2ec0bc"});
    //            $("#cmntdislike"+cid).css({"color":"#555"});
    //            $("#cmntdktext"+cid).html(data[2]);                 
    //            }
    //            else
    //            {
    //            $("#cmntlike"+cid).css({"color":"#555"});                
    //            }
    //           }
    //   });           
});
//**************************************COMMENTLIKES ENDS***************************************  
</script>


<script type="text/javascript">
//**************************************COMMENTDISLIKES***************************************  
$(document).on("click", ".cmntdislikes" , function(){
var cid = $(this).find('input[type=hidden]').val();
var uid = $("#uid").val();
    $.ajax({
            type: "GET",
            url:"{{URL::to('commentdislike')}}",
            data:{cid:cid , uid:uid},
            success:function(data){
              $("#cmntdktext"+cid).html(data[0]);
               if(data[1] == 0){
               $("#cmntdislike"+cid).css({"color":"#2ec0bc"});
               }
               else if (data[1] == 1){
               $("#cmntdislike"+cid).css({"color":"#2ec0bc"});
               $("#cmntlike"+cid).css({"color":"#555"});
               $("#cmntlktext"+cid).html(data[2]);                 
               }
               else
               {
               $("#cmntdislike"+cid).css({"color":"#555"});                
               }
              }
      }); 
});
</script>

<script type="text/javascript">
//**************************************REPLYLIKES***************************************  
$(document).on("click", ".rpllikes" , function(){
var cid = $(this).find('input[type=hidden]').val();
var uid = $("#uid").val();
    $.ajax({
            type: "GET",
            url:"{{URL::to('replylike')}}",
            data:{cid:cid , uid:uid},
            success:function(data){
              $("#rpllktext"+cid).html(data[0]);
               if(data[1] == 0){
               $("#rpllike"+cid).css({"color":"#2ec0bc"});
               }
               else if (data[1] == 1){
               $("#rpllike"+cid).css({"color":"#2ec0bc"});
               $("#rpldislike"+cid).css({"color":"#555"});
               $("#rpldktext"+cid).html(data[2]);                 
               }
               else
               {
               $("#rpllike"+cid).css({"color":"#555"});                
               }
              }
      });           
});
</script>


<script type="text/javascript">
//**************************************REPLYDISLIKES***************************************  
$(document).on("click", ".rpldislikes" , function(){
var cid = $(this).find('input[type=hidden]').val();
var uid = $("#uid").val();
    $.ajax({
            type: "GET",
            url:"{{URL::to('replydislike')}}",
            data:{cid:cid , uid:uid},
            success:function(data){
              $("#rpldktext"+cid).html(data[0]);
               if(data[1] == 0){
               $("#rpldislike"+cid).css({"color":"#2ec0bc"});
               }
               else if (data[1] == 1){
               $("#rpldislike"+cid).css({"color":"#2ec0bc"});
               $("#rpllike"+cid).css({"color":"#555"});
               $("#rpllktext"+cid).html(data[2]);                 
               }
               else
               {
               $("#rpldislike"+cid).css({"color":"#555"});                
               }
              }
      }); 
});
</script>

<script type="text/javascript">
//*****************************COMMENT******************************  
        $("#cmnt").submit(function(){
          var uid = $("#uid").val();
          var vid = $("#vid").val();
          var cmnt = $("#txtcmnt").val();
          $("#txtcmnt").prop('disabled', true);
          $('#cmnt-btn').prop('disabled', true);
     $.ajax({
            type: 'post',
            url: "{{URL::to('comment')}}",
            data: {
                '_token': $('input[name=_token]').val(),
                'vid'   : vid,
                'uid'   : uid,
                'cmnt'  : cmnt
                  },
            success: function(data) {
              $(".video-comments-section").append(
                '<div class="user-comments-area">'+
                '<div class="single-user-comments">'+
                '<div class="row">'+
                '<div class="col-md-1 col-sm-1 col-xs-2">'+
                '<img src="'+'{{asset("assets/files/images")}}'+"/"+data[0]+'" alt="No Image">'+
                '</div>'+
                '<div class="col-md-11 col-sm-11 col-xs-10">'+
                '<h5 class="user-name">'+data[1]+
                '<span class="comments-meta-date" style="font-size: 10px;"> '+data[2]+'</span>'+
                '</h5>'+
                '<p id="ctext'+data[4]+'">'+data[3]+'</p>'+
                '<ul>'+
                '<li>'+
                '<div class="cmntlikes">'+
                '<a><i class="fa fa fa-thumbs-up" id="cmntlike'+data[4]+'" style="cursor: pointer;"></i>'+
                '</a>'+        
                '<span id="cmntlktext'+data[4]+'">0</span>'+          
                '<input type="hidden" value="'+data[4]+'">'+          
                '</div>'+        
                '</li>'+          
                '<li>'+         
                '<div class="cmntdislikes">'+                             
                '<a><i class="fa fa fa-thumbs-down" id="cmntdislike'+data[4]+'" style="cursor: pointer;"></i>'+
                '</a>'+        
                '<span id="cmntdktext'+data[4]+'">0</span>'+        
                '<input type="hidden" value="'+data[4]+'">'+          
                '</div>'+           
                '</li>'+ 
                '<li>'+        
                '<div class="cmntedit">'+          
                '<a id="edit'+data[4]+'" style="cursor: pointer;">Edit</a>'+            
                '<input type="hidden" value="'+data[4]+'">'+            
                '</div>'+          
                '<div class="cmntcancel" style="display: none;">'+          
                '<a id="edit'+data[4]+'" style="cursor: pointer;">Cancel</a>'+            
                '<input type="hidden" value="'+data[4]+'">'+            
                '</div>'+          
                '</li>'+        
                '<li>'+        
                '<div class="cmntdelete">'+          
                '<a id="dlt'+data[4]+'" style="cursor: pointer;">Delete</a>'+          
                '<input type="hidden" value="'+data[4]+'"> '+
                '</div>'+                                       
                '</li>'+          
                '<li>'+
                '<form action="" method="post" id="edtfrm'+data[4]+'">'+        
                '{{csrf_field()}}'+        
                '<input type="text" class="form-control" id="edt'+data[4]+'" placeholder="Write Your'+          
                'Comment & Press Enter" required="" style="width: 450px; display: none;">'+            
                '</form>'+           
                '</li>'+                                       
                '</ul>'+
                '<hr style="margin-top: 8px; margin-bottom: 0px; border-top: 1px solid #FFF;">'+
                '<a style="cursor: pointer;" class="toggle-reply"><b id="r'+data[4]+'">REPLY</b></a>'+
                '<div class="video-comments-form" style="display: none;">'+
                '<div id="reply-block'+data[4]+'">'+
                '<hr style="margin-top: 8px; margin-bottom: 5px; border-top: 1px solid #FFF;">'+
                '<form action="" method="POST" id="rpl'+data[4]+'">'+
               '<input type="hidden" name="comment_id" id="cmnt_id'+data[4]+'" value="'+data[4]+'">'+
                '{{csrf_field()}}'+
                '<div class="row">'+
                '<div class="col-md-1 col-sm-1 col-xs-2">'+
                '<img src="'+'{{asset("assets/files/images")}}'+"/"+data[0]+'" alt="No Image">'+
                '</div>'+
                '<div class="col-md-11 col-sm-11 col-xs-10">'+
                '<input type="hidden" name="usr_id" id="usr_id'+data[4]+'" value="'+data[5]+'">'+
                '<div class="form-group">'+
                '<textarea class="form-control" name="text" placeholder="Write Your Replies Here..."'+
                'id="txtrpl'+data[4]+'" rows="2" required=""></textarea>'+
                '</div>'+
                '<div class="form-group text-right">'+
                '<button type="submit" id="rpl-btn'+data[4]+'" class="btn btn-bordered">REPLY</button>'+
                '</div>'+
                '</div>'+
                '</div>'+
                '</div>'+
                '</form>'+        
                '</div>'+      
                '</div>'+              
                '</div>'+            
                '</div>'+          
                '</div>');
            if (data[6] > 1){
              $("#cmnt-count").html(data[6]+" Comments");
            }
            else{
              $("#cmnt-count").html(data[6]+" Comment");              
            }
        $("#txtcmnt").prop('disabled', false);
        $("#txtcmnt").val("");
        $('#cmnt-btn').prop('disabled', false);
            }
        });          
          return false;
        });



//*****************************COMMENT ENDS******************************  
</script>



<script type="text/javascript">
//***************************** REPLY TOGGLE******************************

          $(document).on("click", ".toggle-reply" , function(){
          $(this).next().slideToggle();
          var id = $(this).next().find('input[type=hidden]').val();
              $('#rpl'+id).submit(function(){
                var cid = $('#cmnt_id'+id).val();
                var uid = $('#usr_id'+id).val();
                var rpl = $('#txtrpl'+id).val();  
                $('#txtrpl'+id).prop('disabled', true);
                $('#rpl-btn'+id).prop('disabled', true);
                $.ajax({
                type: 'post',
                url: "{{URL::to('reply')}}",
                data: {
                '_token': $('input[name=_token]').val(),
                'cid'   : cid,
                'uid'   : uid,
                'rpl'  : rpl
                  },
                success: function(data) { 
                $("#reply-block"+id).prepend(
                  '<hr style="margin-top: 8px; margin-bottom: 5px; border-top: 1px solid #FFF;">'+
                  '<div class="row">'+
                  '<div class="col-md-1 col-sm-1 col-xs-2">'+
                  '<img src="'+'{{asset("assets/files/images")}}'+"/"+data[0]+'" alt="No Image">'+
                  '</div>'+
                  '<div class="col-md-11 col-sm-11 col-xs-10">'+
                  '<h5 class="user-name">'+data[1]+
                  '<span class="comments-meta-date" style="font-size: 10px;"> '+data[2]+
                  '</span>'+
                  '</h5>'+
                  '<p id="rtxt'+data[5]+'">'+data[3]+'</p>'+
                  '<ul>'+
                  '<li>'+      
                  '<div class="rpllikes">'+        
                  '<a><i class="fa fa fa-thumbs-up" id="rpllike'+data[5]+'" style="cursor: pointer;"></i></a>'+
                  '<span id="rpllktext'+data[5]+'">0</span>'+
                  '<input type="hidden" value="'+data[5]+'">'+
                  '</div>'+                    
                  '</li>'+
                  '<li>'+
                  '<div class="rpldislikes">'+
                  '<a><i class="fa fa fa-thumbs-down" id="rpldislike'+data[5]+'" style="cursor: pointer;">'+
                  '</i>'+
                  '</a>'+
                  '<span id="rpldktext'+data[5]+'">0</span>'+                           
                  '<input type="hidden" value="'+data[5]+'">'+
                  '</div>'+
                  '</li>'+
                  '<li>'+      
                  '<div class="rpledit">'+        
                  '<a  style="cursor: pointer;">Edit</a>'+          
                  '<input type="hidden" value="'+data[5]+'">'+          
                  '</div>'+        
                  '<div class="rplcancel" style="display: none;">'+        
                  '<a  style="cursor: pointer;">Cancel</a>'+          
                  '<input type="hidden" value="'+data[5]+'">'+          
                  '</div>'+        
                  '</li>'+      
                  '<li>'+      
                  '<div class="rpldelete">'+        
                  '<a id="dlt'+data[5]+'" style="cursor: pointer;">Delete</a>'+        
                  '<input type="hidden" value="'+data[5]+'">'+                                      
                  '</div>'+        
                  '</li>'+
                  '<li>'+      
                  '<form action="" method="post" id="rpledtfrm'+data[5]+'">'+      
                  '{{csrf_field()}}'+        
                  '<input type="text" class="form-control" id="rpledt'+data[5]+'" placeholder="Write Your'+
                  'Reply & Press Enter" required="" style="width: 380px; display: none;">'+          
                  '</form>'+         
                  '</li>'+                           
                  '</ul>'+
                  '<hr style="margin-top: 8px; margin-bottom: 5px; border-top: 1px solid #FFF;">'+
                  '</div>'+
                  '</div>');   

                    if (data[4] > 1){
                      $("#r"+id).html(data[4]+" Replies");
                    }
                    else{
                      $("#r"+id).html(data[4]+" Reply");              
                    }  
              $('#txtrpl'+id).prop('disabled', false);
              $('#txtrpl'+id).val("");
              $('#rpl-btn'+id).prop('disabled', false);                                       
              }
              });
                return false;
              });
          });
</script>

<script type="text/javascript">

//***************************** LIKE & DISLIKE******************************
$(document).ready(function(){

  $("#like").click(function(){
    var uid = $("#uid").val();
    var vid = $("#vid").val();
    var s = $("#dn").html();
    var a = $("#ln").html();
    var l = $("#lcheck").val();
    var d = $("#dcheck").val();
    if(d == 1)
    {
    $("#dislike").css({"color":"#555"});
    s--;
    $("#dn").html(s);
    $("#dcheck").val("0"); 
    }
    if(l == 1)
    {
    $("#like").css({"color":"#555"});
    a--;
    $("#ln").html(a);
    $("#lcheck").val("0");      
    }
    else{
    $("#like").css({"color":"#2ec0bc"});
    a++;
    $("#ln").html(a); 
    $("#lcheck").val("1");   
    }
    $.ajax({
            type: "GET",
            url:"{{URL::to('like')}}",
            data:{uid:uid , vid:vid}
      });
  });
    
});  

$(document).ready(function(){

  $("#dislike").click(function(){

    var uid = $("#uid").val();
    var vid = $("#vid").val();
    var s = $("#dn").html();
    var a = $("#ln").html();
    var l = $("#lcheck").val();
    var d = $("#dcheck").val();
    if(l == 1)
    {
    $("#like").css({"color":"#555"});
    a--;
    $("#ln").html(a);
    $("#lcheck").val("0"); 
    }
    if(d == 1)
    {
    $("#dislike").css({"color":"#555"});
    s--;
    $("#dn").html(s);
    $("#dcheck").val("0");      
    }
    else{
    $("#dislike").css({"color":"#2ec0bc"});
    s++;
    $("#dn").html(s); 
    $("#dcheck").val("1");   
    }
    $.ajax({
            type: "GET",
            url:"{{URL::to('dislike')}}",
            data:{uid:uid , vid:vid}
      });
  });
    
});  
//***************************** LIKE & DISLIKE ENDS******************************
</script>

<script type="text/javascript">

//***************************** SHOW MORE ******************************
$(document).ready(function(){

  $("#show").click(function(){

    var i = $("#sm").val();
    if(i==0){
      $("#more").show();
      $("#sm").val(1);  
      $("#show").html("SHOW LESS");        
    }
    else{
      $("#more").hide();
      $("#sm").val(0);  
      $("#show").html("SHOW MORE");      
    }    
});  

});  

//***************************** SHOW MORE ENDS ******************************

//***************************** MORE VIDEOS ******************************
$(document).ready(function(){
  
  $("#load").click(function(){
 
    var lid = $(this).val();
    var cid = $("#tid").val();
    var uid = $("#vid").val();
    var x = 0;
    $("#loader").show();
    $.ajax({
        type: "GET",
        url:"{{URL::to('loadmore')}}",
        data:{id:lid , cat_id:cid},
        success:function(data){
          for(var k in data)
          {
            if( uid != data[k]['id'])
            {
          if(data[k]['type'] == 1)
          {

          $(".load-more").append(
            '<div class="single-video-next-area">'+
                '<div class="col-md-6">'+
                '<a href="{{url('/')}}/video/'+data[k]['id']+'">'+
                 '<img src="'+data[k]['thumbnail']+'" alt="Video Image">'+
                '</a>'+
                '</div>'+
                   '<div class="col-md-6 video-next-content-area">'+
                   '<a href="{{url('/')}}/video/'+data[k]['id']+'"><h4>'+data[k]['title']+'</h4></a>'+
                   '<p class="video-next-meta">'+data[k]['user_id']+' <span>'+data[k]['views']+' Views</span></p>'+
                  '</div>'+
                  '</div>');
          }
          else{
          $(".load-more").append(
            '<div class="single-video-next-area">'+
                '<div class="col-md-6">'+
                '<a href="{{url('/')}}/video/'+data[k]['id']+'">'+
                 '<img src="'+'{{asset("assets/files/images")}}'+"/"+data[k]['thumbnail']+'" alt="Video Image">'+
                '</a>'+
                '</div>'+
                   '<div class="col-md-6 video-next-content-area">'+
                   '<a href="{{url('/')}}/video/'+data[k]['id']+'"><h4>'+data[k]['title']+'</h4></a>'+
                   '<p class="video-next-meta">'+data[k]['user_id']+' <span>'+data[k]['views']+' Views</span></p>'+
                  '</div>'+
                  '</div>');
          }
          x++;
          }
          $("#load").val(data[k]['id']);
          }
          $("#loader").hide();
          if(x!=4)
          {
          $("#load").html("NO VIDEO AVAILABLE");
          $('#load').prop('disabled', true);          
          }
        }
    });

  });
});
//***************************** MORE VIDEOS END ******************************


//***************************** Video Controls ******************************
$(document).ready(function() {
      jwplayer("my-video").setup({
          file: "{{asset('assets/files/videos/'.$video->path)}}",
          image: "{{asset('assets/files/images/'.$video->thumbnail)}}",
          width: '100%',
          height: 480,
      });
  });

</script>
@endsection