@extends('layouts.admin')

@section('styles')

<link href="{{asset('assets/admin/css/jquery.tagit.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('assets/admin/css/jquery-ui.css')}}" rel="stylesheet" type="text/css">
<style type="text/css">
  #loader {
    background: url("{{asset('assets/admin/img/fileloader.gif')}}") no-repeat scroll  center #FFF;
    position: fixed;
    height: 100%;
    width: 80%;
    z-index: 9999;
    display: none;
}
</style>

@endsection

@section('contents')

<div class="right-side">
                <div class="container-fluid">
<div id="loader"></div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <!-- Starting of Dashboard area -->
                        <div class="section-padding add-product-1">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="add-product-box">
                                        <div class="add-product-header">
                                            <h2>Create Video</h2>
                                            <a href="{{route('admin-video-index')}}" class="btn add-back-btn"><i class="fa fa-arrow-left"></i> Back</a>  
                                        </div>
                                        <hr>
                                        <form id="frmsubmit" class="form-horizontal" action="{{route('admin-video-create')}}" method="POST" enctype="multipart/form-data">
                                          @include('includes.form-error')
                                          {{csrf_field()}}

                                          <div class="form-group">
                                            <label class="control-label col-sm-4" for="edit_title">Choose a video *</label>
                                            <div class="col-sm-6">

                                    <input type="file" id="uploadVideoFile" class="hidden" name="path" value="">
                                              <button type="button" id="uploadVideoTrigger" onclick="uploadVideoClick()" class="form-control"><i class="fa fa-download"></i> Upload a Video</button>
                                              <p class="text-center">(MP4, WebM, Ogg)</p>
                                            </div>
                                          </div>


                                          <div class="form-group">
                                            <label class="control-label col-sm-4" for="edit_title">Title*</label>
                                            <div class="col-sm-6">
                                              <input class="form-control" name="title" id="edit_title" placeholder="Enter Title " required="" type="text" value="">
                                            </div>
                                          </div>


                                         <div class="form-group">
                                            <label class="control-label col-sm-4" for="blood_group">Category*</label>
                                            <div class="col-sm-6"> 
                                            <select class="form-control" name="category_id" id="blood_group" required="">
                                                  <option value="">Select Category</option>
                                              @foreach($cats as $cat)
                                                  <option value="{{$cat->id}}">{{$cat->cat_name}}</option>
                                              @endforeach
                                              </select>
                                            </div>
                                          </div>

                                          <div class="form-group">
                                            <label class="control-label col-sm-4" for="edit_current_photo">Current Thumbnail*</label>
                                            <div class="col-sm-6">
     
                                              <img width="130px" height="90px" src="" alt="" id="adminimg">
                                            </div>
                                          </div>

                                          <div class="form-group">
                                            <label class="control-label col-sm-4" for="edit_current_photo">Thumbnail*</label>
                                            <div class="col-sm-6">
                                    <input type="file" id="uploadImageFile" class="hidden" name="thumbnail" value="">
                                              <button type="button" id="uploadImageTrigger" onclick="uploadImageClick()" class="form-control"><i class="fa fa-download"></i> Upload a Photo</button>
                                            </div>
                                          </div>

                                          <div class="form-group">
                                            <label class="control-label col-sm-4" for="edit_profile_description">Description*</label>
                                            <div class="col-sm-6"> 
                                              <textarea class="form-control" name="text" id="edit_profile_description" rows="10" style="resize: vertical;" placeholder="Enter Video Description"></textarea>
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="control-label col-sm-4" for="edit_language">Tags* <span>Separated By Comma</span></label>
                                            <div class="col-sm-6">
                                              <ul id="myTags">
                                                  <!-- Existing list items will be pre-added to the tags -->
                                              </ul>
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="control-label col-sm-4" for="email"></label>
                                            <div class="col-sm-6">
                                          <div class="btn btn-default checkbox1">
                                          <input type="checkbox" id="check1" name="is_slider" value="1" > 
                                          <label for="check1">Add Video To Slider</label>
                                          </div>
                                            </div>                                              
                                          </div>
                                          <input type="hidden" name="type" value="0">
                                            <hr>
                                            <div class="add-product-footer">
                                                <button name="addProduct_btn" type="submit" class="btn add-product_btn">Create Video</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <!-- Ending of Dashboard area --> 
                </div>
            </div>
        </div>
    </div>


@endsection

@section('scripts')

<script type="text/javascript">
$('#frmsubmit').submit(function() {
    $('#loader').show(); // show animation
    return true; // allow regular form submission
});
</script>

<script src="{{asset('assets/admin/js/jquery152.min.js')}}"></script>
<script src="{{asset('assets/admin/js/jqueryui.min.js')}}"></script> 
<script src="{{asset('assets/admin/js/tag-it.js')}}" type="text/javascript" charset="utf-8"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $("#myTags").tagit({
          fieldName: "tags[]",
          allowSpaces: true 
        });
    });
</script>

<script type="text/javascript">
//<![CDATA[
        bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
  //]]>
</script>

<script type="text/javascript">
  
  function uploadVideoClick(){
    $("#uploadVideoFile").click();
    $("#uploadVideoFile").change(function(event) {
          readVideoURL(this);
        $("#uploadVideoTrigger").html($("#uploadVideoFile").val());
    });

}

  function readVideoURL(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.readAsDataURL(input.files[0]);
        }
    }

</script>


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

