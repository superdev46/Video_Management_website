@extends('layouts.dashboard')

@section('contents')

<div class="right-side">
                <div class="container-fluid">
<div id="loader"></div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <!-- Starting of General settings area -->
                        <div class="panel panel-default general-setting">
                            <div class="panel-heading">
                                <i class="fa fa-upload"></i> Edit Content
                                <a href="{{route('user-channel-show',$cid->channel->id)}}" style="float: right; color: white;"><i class="fa fa-arrow-left"></i> Back</a>
                            </div>
                            <div class="panel-body">

                                        <form class="form-horizontal" action="{{route('user-channel-show-create-update',$cid->id)}}" method="POST" enctype="multipart/form-data">
                                          @include('includes.form-error')
                                          {{csrf_field()}}

                                          <div class="form-group">
                                            <label class="control-label col-sm-4" for="edit_title">Select a Type*</label>
                                            <div class="col-sm-6">
                                              <select class="form-control" id="type" name="type" required="">
                                                <option value="">Choose a type</option>
                                                <option value="1" {{$cid->type == 1 ? "selected":""}}>Playlist</option>
                                                <option value="2" {{$cid->type == 2 ? "selected":""}}>VIdeo</option>
                                            </select>
                                            </div>
                                          </div>

                                          <div class="form-group">
                                            <label class="control-label col-sm-4" for="edit_title">Select a Content*</label>
                                            <div class="col-sm-6">
                                              <select class="form-control" id="content" name="{{$cid->type == 1 ? "playlist_id":"video_id"}}" required="">
                                                @if($cid->type == 1)
                                                <option value="">Choose a Playlist</option>
                                                @foreach($playlists as $playlist)
                                                <option value="{{$playlist->id}}" {{$playlis->id == $playlist->id ? "selected":""}}>{{substr($playlist->title,0,50)}}</option>
                                                @endforeach
                                                @else
                                                <option value="">Choose a Video</option>
                                                @foreach($videos as $video)
                                                <option value="{{$video->id}}" {{$vide->id == $video->id ? "selected":""}}>{{substr($video->title,0,50)}}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                            </div>
                                          </div>

                                          <div class="form-group">
                                            <label class="control-label col-sm-4" for="edit_current_photo">Thumnail*</label>
                                            <div class="col-sm-6">
                                          @if($cid->type == 1)
                                        <img width="500px" height="350px" src="{{ $cid->playlist->photo ? asset('assets/files/images/'.$cid->playlist->photo):'http://fulldubai.com/SiteImages/noimage.png'}}" alt="Video's Thumbnail" id="adminimg">                                          @else
                                          @if($cid->video->type == 0)
                                        <img width="500px" height="350px" src="{{ $cid->video->thumbnail ? asset('assets/files/images/'.$cid->video->thumbnail):'http://fulldubai.com/SiteImages/noimage.png'}}" alt="Video's Thumbnail" id="adminimg">
                                        @else
                                        <img width="500px" height="350px" src="{{ $cid->video->thumbnail ? $cid->video->thumbnail:'http://fulldubai.com/SiteImages/noimage.png'}}" alt="Video's Thumbnail" id="adminimg">
                                        @endif
                                        @endif
                                            </div>
                                          </div>

                                          <input type="hidden" name="channel_id" value="{{$cid->channel->id}}">
                                            <hr>
                                            <div class="add-product-footer">
                                                <button name="addProduct_btn" type="submit" class="btn add-product_btn">Update Content</button>
                                            </div>
                                        </form>
                            </div>
                        </div>
                        <!-- Ending of General settings area -->
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')

<script type="text/javascript">

  $('#type').on('change', function() {
    var type = $(this).val();
    if (type == "") 
    {
      $('#content').html('<option>Choose a Content</option>');
      $('#content').prop('disabled', true);   
    }
    else
    {
        $.ajax({
            type: "GET",
            url:"{{URL::to('showcnt')}}",
            data:{id:type},
            success:function(data){
                if(type == 1)
                {
                  $('#content').attr('name', 'playlist_id');
                  $('#content').attr('required', '');

                  $('#content').html('<option value="">Choose a Playlist</option>');
                   for(var k in data)
                    {
                      $('#content').append('<option value="'+data[k]['id']+'">'+data[k]['title']+'</option>');                      
                    }                 
                  $('#content').prop('disabled', false);                  
                }
                if(type == 2)
                {
                  $('#content').attr('name', 'video_id');
                  $('#content').attr('required', '');
                  $('#content').html('<option value="">Choose a Video</option>');
                   for(var k in data)
                    {
                      $('#content').append('<option value="'+data[k]['id']+'">'+data[k]['title']+'</option>');                      
                    } 
                  $('#content').prop('disabled', false);                  
                }
  
              }
      });      
    }


});
</script>


<script type="text/javascript">

  $('#content').on('change', function() {

    var type = $(this).val();
    if (type == "") 
    {
      $('#adminimg').attr('src','');
      $('#content').attr('required', '');
    }

    if($('#type').val() == 1)
    {
        var id = $(this).val();
        $.ajax({
                type: "GET",
                url:"{{URL::to('showply')}}",
                data:{id:id},
                success:function(data){
                  console.log(data);
                  $("#adminimg").attr('src', '{{asset("assets/files/images")}}'+"/"+data['photo']);
                  }
          });
    }
    if($('#type').val() == 2)
    {
        var id = $(this).val();
        $.ajax({
                type: "GET",
                url:"{{URL::to('showimg')}}",
                data:{id:id},
                success:function(data){
                  if(data['type'] == 0)
                  {
                  $("#adminimg").attr('src', '{{asset("assets/files/images")}}'+"/"+data['thumbnail']);
                  }
                  else{
                  $("#adminimg").attr('src', data['thumbnail']);
                  }    
                  }
          });
    }
});
</script>

@endsection


