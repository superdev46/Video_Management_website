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
                                            <h2>Edit Category</h2>
                                            <a href="{{route('admin-cat-index')}}" class="btn add-back-btn"><i class="fa fa-arrow-left"></i> Back</a>  
                                        </div>
                                        <hr>
                                        <form class="form-horizontal" action="{{route('admin-cat-update',$cat->id)}}" method="POST" enctype="multipart/form-data">
                                            {{csrf_field()}}
                                          <div class="form-group">
                                            <label class="control-label col-sm-4" for="edit_blood_group_display_name"> Name* <span>(In Any Language)</span></label>
                                            <div class="col-sm-6">
                                              <input class="form-control" name="cat_name" id="edit_blood_group_display_name" placeholder="Enter Category Name" required="" type="text" value="{{$cat->cat_name}}">
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="control-label col-sm-4" for="edit_blood_group_slug">Slug* <span>(In English)</span></label>
                                            <div class="col-sm-6">
                                              <input class="form-control" name="cat_slug" id="edit_blood_group_slug" placeholder="Enter Category Slug" required="" type="text" value="{{$cat->cat_slug}}">
                                            </div>
                                          </div>

                                            <hr>
                                            <div class="add-product-footer">
                                                <button name="addProduct_btn" type="submit" class="btn add-product_btn">Update Category</button>
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