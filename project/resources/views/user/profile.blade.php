@extends('layouts.dashboard')
@section('contents')
<div class="right-side">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <!-- Starting of General settings area -->
                        <div class="panel panel-default general-setting">
                            <div class="panel-heading">
                                <i class="fa fa-user"></i> {{$lang->doupl}}
                            </div>
                            <div class="panel-body">
                                <form class="form-horizontal" action="{{route('user-profile-update')}}" method="POST" enctype="multipart/form-data">
                                    @include('includes.form-error')
                                    @include('includes.form-success')   
                                          {{csrf_field()}}
                                  <div class="form-group">
                                    <label class="control-label col-sm-3" for="first_name"> {{$lang->fname}}</label>
                                    <div class="col-sm-6">
                                      <input type="text" class="form-control" id="first_name" name="name" placeholder="{{$lang->fname}}" required="" value="{{$user->name}}">
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="control-label col-sm-3" for="last_name">{{$lang->doem}}</label>
                                    <div class="col-sm-6"> 
                                      <input type="text" class="form-control" id="last_name" name="email" placeholder="{{$lang->doem}}" required="" value="{{$user->email}}">
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="control-label col-sm-3" for="edit_current_photo">{{$lang->cup}}</label>
                                      <div class="col-sm-6">
     
                                        <img width="130px" height="90px" id="adminimg" src="{{$user->photo ? asset('assets/files/images/'.$user->photo) : 'http://fulldubai.com/SiteImages/noimage.png' }}" alt="" id="adminimg">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="control-label col-sm-3" for="edit_profile_photo">{{$lang->pp}}</label>
                                      <div class="col-sm-6">
                                    <input type="file" id="uploadFile" class="hidden" name="photo" value="">
                                      <button type="button" id="uploadTrigger" onclick="uploadclick()" class="form-control"><i class="fa fa-download"></i> {{$lang->app}}</button>
                                      <p>{{$lang->size}}</p>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="control-label col-sm-3" for="about">Description</label>
                                    <div class="col-sm-6"> 
                                      <textarea name="description" id="about" cols="30" rows="5" class="form-control" style="resize: vertical;">{{$user->description}}</textarea>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="control-label col-sm-3" for="facebook">{{$lang->dofpl}}</label>
                                    <div class="col-sm-6"> 
                                      <input type="text" class="form-control" id="facebook" name="f_url" placeholder="{{$lang->dofpl}}" value="{{$user->f_url}}">
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="control-label col-sm-3" for="google">{{$lang->dogpl}}</label>
                                    <div class="col-sm-6"> 
                                      <input type="text" class="form-control" id="google" name="g_url" placeholder="{{$lang->dogpl}}" value="{{$user->g_url}}">
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="control-label col-sm-3" for="twitter">{{$lang->dotpl}}</label>
                                    <div class="col-sm-6"> 
                                      <input type="text" class="form-control" id="twitter" name="t_url" placeholder="{{$lang->dotpl}}" value="{{$user->t_url}}">
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="control-label col-sm-3" for="linkedin">{{$lang->dolpl}}</label>
                                    <div class="col-sm-6"> 
                                      <input type="text" class="form-control" id="linkedin" name="l_url" placeholder="{{$lang->dolpl}}" value="{{$user->t_url}}">
                                    </div>
                                  </div>
                                  <hr>
                                  <div class="form-group"> 
                                    <div class="col-sm-offset-3 col-sm-6">
                                      <button type="submit" class="btn btn-default"><i class="fa fa-floppy-o"></i> {{$lang->doupl}}</button>
                                    </div>
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
//<![CDATA[
        bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
  //]]>
</script>

<script type="text/javascript">


    // Handling the click event
    $("#add-field-btn").on('click',function() {
      var title = $('#tttl').val();
      var desc = $('#dddc').val();

        $(".qualification").append('<div class="qualification-area">'+
                '<div class="form-group">'+
                 '<div class="col-sm-5 col-md-offset-1">'+
'<input type="text" class="form-control" name="title[]" id="title" placeholder="'+title+'" required="">'+
                   '</div>'+
                   '<div class="col-sm-5">'+
'<input type="text" class="form-control" name="details[]" id="text_details" placeholder="'+desc+'" required="">'+
                  '</div>'+
                  '</div>'+
                  '<span class="ui-close">X</span>'+
                 '</div>');

    });

  function isEmpty(el){
      return !$.trim(el.html())
  }

  $(document).on('click', '.ui-close' ,function() {
    $(this.parentNode).hide();
    $(this.parentNode).remove();
    if (isEmpty($('#q'))) {
      var title = $('#tttl').val();
      var desc = $('#dddc').val();
        $(".qualification").append('<div class="qualification-area">'+
                '<div class="form-group">'+
                 '<div class="col-sm-5 col-md-offset-1">'+
'<input type="text" class="form-control" name="title[]" id="title" placeholder="'+title+'">'+
                   '</div>'+
                   '<div class="col-sm-5">'+
'<input type="text" class="form-control" name="details[]" id="text_details" placeholder="'+desc+'">'+
                  '</div>'+
                  '</div>'+
                  '<span class="ui-close">X</span>'+
                 '</div>');
    }
  });


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