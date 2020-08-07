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
                                <i class="fa fa-upload"></i> Edit Video
                                <a href="{{route('user-playlist-show',$playlist->id)}}" style="float: right; color: white;"><i class="fa fa-arrow-left"></i> Back</a>
                            </div>
                            <div class="panel-body">

                                        <form class="form-horizontal" action="{{route('user-playlist-show-create-update',$vid->id)}}" method="POST" enctype="multipart/form-data">
                                          @include('includes.form-error')
                                          {{csrf_field()}}

                                          <div class="form-group">
                                            <label class="control-label col-sm-4" for="edit_current_photo">Thumnail*</label>
                                            <div class="col-sm-6">
                                          @if($vid->video->type == 0)
                                        <img width="450px" height="350px" src="{{ $vid->video->thumbnail ? asset('assets/files/images/'.$vid->video->thumbnail):'http://fulldubai.com/SiteImages/noimage.png'}}" alt="Video's Thumbnail" id="adminimg">
                                        @else
                                        <img width="450px" height="350px" src="{{ $vid->video->thumbnail ? $vid->video->thumbnail:'http://fulldubai.com/SiteImages/noimage.png'}}" alt="Video's Thumbnail" id="adminimg">
                                        @endif

                                            </div>
                                          </div>


                                          <div class="form-group">
                                            <label class="control-label col-sm-4" for="edit_title">Select a Video*</label>
                                            <div class="col-sm-6">
                                              <select class="form-control" id="video" name="video_id" required="">
                                                <option value="">Choose a video</option>
                                              @foreach($videos as $video)
                                              <option value="{{$video->id}}" {{$video->id == $vid->video->id ?"selected":""}}>{{substr($video->title,0,50)}}</option>
                                              @endforeach
                                            </select>
                                            </div>
                                          </div>

                                          <input type="hidden" name="playlist_id" value="{{$playlist->id}}">
                                            <hr>
                                            <div class="add-product-footer">
                                                <button name="addProduct_btn" type="submit" class="btn add-product_btn">Add Video To Playlist</button>
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

  $('select').on('change', function() {
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
});
</script>

@endsection


