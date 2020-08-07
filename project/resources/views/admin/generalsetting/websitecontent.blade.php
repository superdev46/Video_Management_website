@extends('layouts.admin')

@section('contents')
<div class="right-side">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <!-- Starting of Dashboard Website Title -->
                        <div class="section-padding add-product-1">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="add-product-box">
                                        <div class="add-product-header">
                                            <h2>Website Contents</h2> 
                                        </div>
                                        <hr>
                                        <form class="form-horizontal" action="{{route('admin-gs-contentsup')}}" method="POST">

                                            @include('includes.form-success')      
                                          {{csrf_field()}}
                                          <div class="form-group">
                                            <label class="control-label col-sm-4" for="website_title">Website Title *</label>
                                            <div class="col-sm-6">
                                              <input name="title" id="website_title" class="form-control" placeholder="Enter Website Title" required="" type="text" value="{{$data->title}}">
                                            </div>
                                          </div>
                                        <hr>
                                        <div class="add-product-footer">
                                            <button name="addProduct_btn" type="submit" class="btn add-product_btn">Update Setting</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <!-- Ending of Dashboard Website Title -->  
                </div>
            </div>
        </div>
    </div>
@endsection