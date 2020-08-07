@extends('layouts.admin')

@section('contents')
<div class="right-side">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <!-- Starting of Dashboard Website Logo -->
                        <div class="section-padding add-product-1">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="add-product-box">
                                        <div class="add-product-header">
                                            <h2>Website Logo</h2> 
                                        </div>
                                        <hr>
                                        <form class="form-horizontal" action="{{route('admin-gs-logoup')}}" method="POST" enctype="multipart/form-data">
                                            @include('includes.form-error')
                                            @include('includes.form-success')      
                                          {{csrf_field()}}
                                          <div class="form-group">
                                            <label class="control-label col-sm-4" for="current_logo">Current Logo</label>
                                            <div class="col-sm-6">
                                        <img width="130px" height="90px" id="adminimg" src="{{ $data->logo ? asset('assets/files/images/'.$data->logo):'http://fulldubai.com/SiteImages/noimage.png'}}" alt="" id="adminimg">
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="control-label col-sm-4" for="setup_new_logo">Setup New Logo *</label>
                                            <div class="col-sm-6">
                                              <input  type="file" name="logo">
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
                    <!-- Ending of Dashboard Website Logo -->
                </div>
            </div>
        </div>
    </div>
@endsection