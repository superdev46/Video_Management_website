@extends('layouts.admin')

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
                                            <h2>Edit User</h2>
                                            <a href="{{route('admin-user-index')}}" class="btn add-back-btn"><i class="fa fa-arrow-left"></i> Back</a>  
                                        </div>
                                        <hr>
                                        <form class="form-horizontal" action="{{route('admin-user-update',$user->id)}}" method="POST" enctype="multipart/form-data">
                                          @include('includes.form-error')
                                          {{csrf_field()}}
                                          <div class="form-group">
                                            <label class="control-label col-sm-4" for="edit_full_name">Full Name*</label>
                                            <div class="col-sm-6">
                                              <input class="form-control" name="name" id="edit_full_name" placeholder="Enter Full Name" required="" type="text" value="{{$user->name}}">
                                            </div>
                                          </div>

                                          <div class="form-group">
                                            <label class="control-label col-sm-4" for="edit_current_photo">Current Photo*</label>
                                            <div class="col-sm-6">
     
                                              <img width="130px" height="90px" id="adminimg" src="{{ $user->photo ? asset('assets/files/images/'.$user->photo):'http://fulldubai.com/SiteImages/noimage.png'}}" alt="" id="adminimg">
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="control-label col-sm-4" for="edit_profile_photo">Profile Photo *</label>
                                            <div class="col-sm-6">
                                    <input type="file" id="uploadFile" class="hidden" name="photo" value="">
                                              <button type="button" id="uploadTrigger" onclick="uploadclick()" class="form-control"><i class="fa fa-download"></i> Edit Profile Photo</button>
                                              <p>Prefered Size: (600x600) or Square Sized Image</p>
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="control-label col-sm-4" for="edit_profile_description">Profile Description*</label>
                                            <div class="col-sm-6"> 
                                              <textarea class="form-control" name="description" id="edit_profile_description" rows="5" style="resize: vertical;" placeholder="Enter Profile Description">{{$user->description}}</textarea>
                                            </div>
                                          </div>

                                       <div class="form-group">
                                            <label class="control-label col-sm-4" for="fax">Facebook Profile Link*</label>
                                            <div class="col-sm-6">
                                              <input class="form-control" name="f_url" id="fax" placeholder="Enter Facebook Profile Link"  type="text" value="{{$user->f_url}}">
                                            </div>
                                          </div>
                                      <div class="form-group">
                                            <label class="control-label col-sm-4" for="fax">Twitter Profile Link*</label>
                                            <div class="col-sm-6">
                                              <input class="form-control" name="t_url" id="fax" placeholder="Enter Twitter Profile Link"  type="text" value="{{$user->t_url}}">
                                            </div>
                                          </div>
                                      <div class="form-group">
                                            <label class="control-label col-sm-4" for="fax">Google+ Profile Link*</label>
                                            <div class="col-sm-6">
                                              <input class="form-control" name="g_url" id="fax" placeholder="Enter Google+ Profile Link"  type="text" value="{{$user->g_url}}">
                                            </div>
                                          </div>
                                      <div class="form-group">
                                            <label class="control-label col-sm-4" for="fax">Linkedin Profile Link*</label>
                                            <div class="col-sm-6">
                                              <input class="form-control" name="l_url" id="fax" placeholder="Enter Linkedin Profile Link"  type="text" value="{{$user->l_url}}">
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="control-label col-sm-4" for="edit_email">Email*</label>
                                            <div class="col-sm-6">
                                              <input class="form-control" name="email" id="edit_email" placeholder="Enter Email" required="" type="email" value="{{$user->email}}">
                                            </div>
                                          </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-4" for="email">Password*</label>
                                            <div class="col-sm-6">
                                              <input class="form-control" name="password" id="email" placeholder="Enter Password"  type="password">
                                            </div>                                              </div>
                                            <hr>
                                            <div class="add-product-footer">
                                                <button name="addProduct_btn" type="submit" class="btn add-product_btn">Update User</button>
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
//<![CDATA[
        bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
  //]]>
</script>

<script type="text/javascript">
  
  function uploadclick(){
    $("#uploadFile").click();
    $("#uploadFile").change(function(event) {
          readURL(this);
        $("#uploadTrigger").html($("#uploadFile").val());
    });

}


    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#adminimg').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

</script>

@endsection