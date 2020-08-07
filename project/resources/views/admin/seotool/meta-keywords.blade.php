@extends('layouts.admin')


@section('styles')

<link href="{{asset('assets/admin/css/jquery.tagit.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('assets/admin/css/jquery-ui.css')}}" rel="stylesheet" type="text/css">
@section('contents')
<div class="right-side">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <!-- Starting of Dashboard Meta Keywords Page -->
                        <div class="section-padding add-product-1">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="add-product-box">
                                        <div class="add-product-header">
                                            <h2>Meta Keywords</h2> 
                                        </div>
                                        <hr>
                                        <form class="form-horizontal" action="{{route('admin-seotool-keywords-update')}}" method="POST">
                                         @include('includes.form-success')      
                                        {{csrf_field()}}
                                          <div class="form-group">
                                            <label class="control-label col-sm-4" for="website_meta_keywords">Website Meta Keywords *</label>
                                            <div class="col-sm-6">
                                              <ul id="myTags">
                                                @if($keys)
                                                @foreach($keys as $key)
                                                <li>{{$key}}</li>
                                                @endforeach
                                                @endif
                                              </ul>
                                            </div>
                                          </div>
                                            <hr>
                                            <div class="add-product-footer">
                                                <button name="addProduct_btn" type="submit" class="btn add-product_btn">Update Meta Keywords</button>
                                        
                                    </div></form>
                                </div>
                        </div>
                    </div>
                    <!-- Ending of Dashboard Meta Keywords Page --> 
                </div>
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
          fieldName: "meta_keys[]",
          allowSpaces: true 
        });
    });
</script>

@endsection