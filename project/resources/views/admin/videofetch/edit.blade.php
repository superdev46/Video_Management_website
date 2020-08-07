@extends('layouts.admin')

@section('styles')

<link href="{{asset('assets/admin/css/jquery.tagit.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('assets/admin/css/jquery-ui.css')}}" rel="stylesheet" type="text/css">
@endsection

@section('contents')

<div class="right-side">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <!-- Starting of Dashboard area -->
                        <div class="section-padding add-product-1">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="add-product-box">
                                        <div class="add-product-header">
                                            <h2>Edit Video</h2>
                                            <a href="{{route('admin-fetch-index')}}" class="btn add-back-btn"><i class="fa fa-arrow-left"></i> Back</a>  
                                        </div>
                                        <hr>
                                          <form class="form-horizontal" action="{{route('admin-fetch-editfetch',$video->id)}}" method="POST">
                                 @include('includes.form-success')
                                          {{csrf_field()}}

                                          <div class="form-group">
                                            <label class="control-label col-sm-4" for="edit_title">URL* <span>(Youtube, Dailymotion, Vimeo)</span></label>
                                            <div class="col-sm-6">
                                              <input class="form-control" name="url" id="edit_title" placeholder="https://www.youtube.com/watch?v=d6vC4ahVdk4" required="" type="text" value="">
                                            </div>
                                          </div>
                                            <hr>
                                            <div class="add-product-footer">
                                                <button name="addProduct_btn" type="submit" class="btn add-product_btn">Fetch Video</button>
                                            </div>
                                        </form>
                                        <hr>
                                        <form class="form-horizontal" action="{{route('admin-fetch-update',$video->id)}}" method="POST" enctype="multipart/form-data">
                                          @include('includes.form-error')
                                          {{csrf_field()}}
      <!-- If this edit page is fetched then execute this if statement -->
              @if(isset($link))
      <!-- If the link has youtube then execute this script -->
              @if($link == "youtube")

                                          <div class="form-group">
                                            <label class="control-label col-sm-4" for="edit_title">Video *</label>
                                            <div class="col-sm-6">
                                    <input type="hidden" id="uploadVideoFile" class="hidden" name="url" value="{{$url}}">
                                  <iframe width="525" height="345" src="https://www.youtube.com/embed/{{$id}}" allowfullscreen>
                                  </iframe>
                                            </div>
                                          </div>


                                          <div class="form-group">
                                            <label class="control-label col-sm-4" for="edit_title">Title*</label>
                                            <div class="col-sm-6">
                                              <input class="form-control" name="title" id="edit_title" placeholder="Enter Title " required="" type="text" value="{{$fetch->title}}">
                                            </div>
                                          </div>


                                         <div class="form-group">
                                            <label class="control-label col-sm-4" for="blood_group">Category*</label>
                                            <div class="col-sm-6"> 
                                            <select class="form-control" name="category_id" id="blood_group" required="">
                                                  <option value="">Select Category</option>
                                              @foreach($cats as $cat)
                                                  <option value="{{$cat->id}}" {{$cat->cat_name == $video->category->cat_name?"selected":""}}>{{$cat->cat_name}}</option>
                                              @endforeach
                                              </select>
                                            </div>
                                          </div>
      @php
      $desc = preg_replace("/\r\n|\r|\n/",'<br/>',$fetch->description);
      $thumbnail = preg_replace("/\r\n|\r|\n/",'<br/>',$fetch->thumbnails->standard->url);
      @endphp
                                          <div class="form-group">
                                            <label class="control-label col-sm-4" for="edit_current_photo">Current Thumbnail*</label>
                                            <div class="col-sm-6">
                                     <input type="hidden" id="uploadVideoFile" class="hidden" name="thumbnail" value="{{$thumbnail}}">
                                              <img  id="adminimg" src="{{$thumbnail}}" alt="" id="adminimg">
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="control-label col-sm-4" for="edit_profile_description">Description*</label>
                                            <div class="col-sm-6"> 
                                              <textarea class="form-control" name="text" id="edit_profile_description" rows="10" style="resize: vertical;" placeholder="Enter Video Description">{{$desc}}</textarea>
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="control-label col-sm-4" for="edit_language">Tags* <span>Separated By Comma</span></label>
                                            <div class="col-sm-6">
                                              <ul id="myTags">
                                              @if(isset($fetch->tags))
                                              @foreach($fetch->tags as $tag)
                                              <li>{{$tag}}</li>
                                              @endforeach
                                              @endif
                                              </ul>
                                            </div>
                                          </div>
              @endif
      <!-- If the link has youtube then execute this script -->
              @if($link == "dailymotion")
  <div class="form-group">
                                            <label class="control-label col-sm-4" for="edit_title">Video *</label>
                                            <div class="col-sm-6">
                                    <input type="hidden" id="uploadVideoFile" class="hidden" name="url" value="{{$url}}">
<iframe  width="525" height="345" src="https://www.dailymotion.com/embed/video/{{$id}}" allowfullscreen></iframe>
                                            </div>
                                          </div>


                                          <div class="form-group">
                                            <label class="control-label col-sm-4" for="edit_title">Title*</label>
                                            <div class="col-sm-6">
                                              <input class="form-control" name="title" id="edit_title" placeholder="Enter Title " required="" type="text" value="{{$fetch['title']}}">
                                            </div>
                                          </div>

      @php
      $thumbnail = preg_replace("/\r\n|\r|\n/",'',$fetch['thumbnail_url']);
      @endphp
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
                                     <input type="hidden" id="uploadVideoFile" class="hidden" name="thumbnail" value="{{$thumbnail}}">
                                              <img  id="adminimg" src="{{$thumbnail}}" alt="" id="adminimg">
                                            </div>
                                          </div>

                                          <div class="form-group">
                                            <label class="control-label col-sm-4" for="edit_profile_description">Description*</label>
                                            <div class="col-sm-6"> 
                                              <textarea class="form-control" name="text" id="edit_profile_description" rows="10" style="resize: vertical;" placeholder="Enter Video Description">{{$fetch['description']}}</textarea>
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="control-label col-sm-4" for="edit_language">Tags* <span>Separated By Comma (,)</span></label>
                                            <div class="col-sm-6">
                                              <ul id="myTags">
                                              </ul>
                                            </div>
                                          </div>
                      @endif
      <!-- If the link has youtube then execute this script -->
              @if($link == "vimeo")
  <div class="form-group">
                                            <label class="control-label col-sm-4" for="edit_title">Video *</label>
                                            <div class="col-sm-6">
                                    <input type="hidden" id="uploadVideoFile" class="hidden" name="url" value="{{$url}}">
                                      <iframe width="525" height="345" src="https://player.vimeo.com/video/{{$id}}" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                                            </div>
                                          </div>


                                          <div class="form-group">
                                            <label class="control-label col-sm-4" for="edit_title">Title*</label>
                                            <div class="col-sm-6">
                                              <input class="form-control" name="title" id="edit_title" placeholder="Enter Title " required="" type="text" value="{{$fetch['title']}}">
                                            </div>
                                          </div>

      @php
      $thumbnail = preg_replace("/\r\n|\r|\n/",'',$fetch['thumbnail_url']);
      @endphp
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
                                     <input type="hidden" id="uploadVideoFile" class="hidden" name="thumbnail" value="{{$thumbnail}}">
                                              <img  id="adminimg" src="{{$thumbnail}}" alt="" id="adminimg">
                                            </div>
                                          </div>

                                          <div class="form-group">
                                            <label class="control-label col-sm-4" for="edit_profile_description">Description*</label>
                                            <div class="col-sm-6"> 
                                              <textarea class="form-control" name="text" id="edit_profile_description" rows="10" style="resize: vertical;" placeholder="Enter Video Description">{{$fetch['description']}}</textarea>
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="control-label col-sm-4" for="edit_language">Tags* <span>Separated By Comma (,)</span></label>
                                            <div class="col-sm-6">
                                              <ul id="myTags">
                                              </ul>
                                            </div>
                                          </div>
                      @endif

<!-- Otherwise read the information from database -->

                      @else
                                          <div class="form-group">
                                            <label class="control-label col-sm-4" for="edit_title">Current Video *</label>
                                            <div class="col-sm-6">
                                    <input type="hidden" id="uploadVideoFile" class="hidden" name="url" value="{{$video->url}}">
                                @if (strpos($video->url, 'youtube') !== false)
                                  <iframe width="525" height="345" src="https://www.youtube.com/embed/{{$id}}" allowfullscreen>
                                  </iframe>
                                @endif
                                @if (strpos($video->url, 'dailymotion') !== false)
                                  <iframe  width="525" height="345" src="https://www.dailymotion.com/embed/video/{{$id}}" allowfullscreen></iframe>
                                @endif
                                @if (strpos($video->url, 'vimeo') !== false)
                                     <iframe width="525" height="345" src="https://player.vimeo.com/video/{{$id}}" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                                @endif
                                            </div>
                                          </div>

                                          <div class="form-group">
                                            <label class="control-label col-sm-4" for="edit_title">Title*</label>
                                            <div class="col-sm-6">
                                              <input class="form-control" name="title" id="edit_title" placeholder="Enter Title " required="" type="text" value="{{$video->title}}">
                                            </div>
                                          </div>


                                         <div class="form-group">
                                            <label class="control-label col-sm-4" for="blood_group">Category*</label>
                                            <div class="col-sm-6"> 
                                            <select class="form-control" name="category_id" id="blood_group" required="">
                                                  <option value="">Select Category</option>
                                              @foreach($cats as $cat)
                                                  <option value="{{$cat->id}}" {{$cat->cat_name == $video->category->cat_name?"selected":""}}>{{$cat->cat_name}}</option>
                                              @endforeach
                                              </select>
                                            </div>
                                          </div>

                                          <div class="form-group">
                                            <label class="control-label col-sm-4" for="edit_current_photo">Current Thumbnail*</label>
                                            <div class="col-sm-6">

                                     <input type="hidden" id="uploadVideoFile" class="hidden" name="thumnail" value="{{$video->thumbnail}}">     
                                              <img id="adminimg" src="{{ $video->thumbnail }}" alt="" id="adminimg">
                                            </div>
                                          </div>

                                          <div class="form-group">
                                            <label class="control-label col-sm-4" for="edit_profile_description">Description*</label>
                                            <div class="col-sm-6"> 
                                              <textarea class="form-control" name="text" id="edit_profile_description" rows="10" style="resize: vertical;" placeholder="Enter Video Description">{{$video->text}}</textarea>
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="control-label col-sm-4" for="edit_language">Tags* <span>Separated By Comma</span></label>
                                            <div class="col-sm-6">
                                              <ul id="myTags">
                                                @if(isset($tags))
                                                @foreach($tags as $tag)
                                                <li>{{$tag}}</li>
                                                @endforeach
                                                @endif
                                              </ul>
                                            </div>
                                          </div>                      
                      @endif
                                          <div class="form-group">
                                            <label class="control-label col-sm-4" for="email"></label>
                                            <div class="col-sm-6">
                                          <div class="btn btn-default checkbox1">
                                          <input type="checkbox" id="check1" name="is_slider" value="1" {{$video->is_slider == 1 ? "checked" : ""}}> 
                                          <label for="check1">Add Video To Slider</label>
                                          </div>
                                            </div>                                              
                                          </div>
                                          <input type="hidden" name="type" value="1">
                                            <hr>
                                            <div class="add-product-footer">
                                                <button name="addProduct_btn" type="submit" class="btn add-product_btn">Update Video</button>
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
        $("#uploadvideoTrigger").html($("#uploadVideoFile").val());
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

