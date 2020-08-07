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
                                <i class="fa fa-upload"></i> Edit Channel
                                <a href="{{route('user-channel-index')}}" style="float: right; color: white;"><i class="fa fa-arrow-left"></i> Back</a>
                            </div>
                            <div class="panel-body">

                                        <form class="form-horizontal" action="{{route('user-channel-edit',$channel->id)}}" method="POST" enctype="multipart/form-data">
                                          @include('includes.form-error')
                                          {{csrf_field()}}

                                          <div class="form-group">
                                            <label class="control-label col-sm-4" for="edit_current_photo">Current Image*</label>
                                            <div class="col-sm-6">
     
                                              <img width="130px" height="90px" id="adminimg" src="{{ $channel->photo ? asset('assets/files/images/'.$channel->photo):'http://fulldubai.com/SiteImages/noimage.png'}}" alt="" id="adminimg">
                                            </div>
                                          </div>

                                          <div class="form-group">
                                            <label class="control-label col-sm-4" for="edit_current_photo">Image*</label>
                                            <div class="col-sm-6">
                                    <input type="file" id="uploadImageFile" class="hidden" name="photo" value="">
                                              <button type="button" id="uploadImageTrigger" onclick="uploadImageClick()" class="form-control"><i class="fa fa-download"></i> Upload an Image</button>
                                            </div>
                                          </div>

                                          <div class="form-group">
                                            <label class="control-label col-sm-4" for="edit_title">Title*</label>
                                            <div class="col-sm-6">
                                              <input class="form-control" name="title" id="edit_title" placeholder="Enter Title " required="" type="text" value="{{$channel->title}}">
                                            </div>
                                          </div>

                                          <input type="hidden" name="user_id" value="{{Auth::guard('user')->user()->id}}">
                                            <hr>
                                            <div class="add-product-footer">
                                                <button name="addProduct_btn" type="submit" class="btn add-product_btn">Update Channel</button>
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
  
  function uploadImageClick(){
    $("#uploadImageFile").click();
    $("#uploadImageFile").change(function(event) {
          readImageURL(this);
        $("#uploadImageTrigger").html($("#uploadImageFile").val());
    });

  }

  function readImageURL(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function (e)
            {
                $('#adminimg').attr('src', e.target.result);
            }
          reader.readAsDataURL(input.files[0]);
        }
    }
</script>

@endsection