@extends('layouts.admin')

@section('contents')
<div class="right-side">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <!-- Starting of Dashboard Office Address -->
                        <div class="section-padding add-product-1">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="add-product-box">
                                        <div class="add-product-header">
                                            <h2>Office Address</h2> 
                                        </div>
                                        <hr>
                                        <form class="form-horizontal" action="{{route('admin-gs-paymentsup')}}" method="POST">
                                        @include('includes.form-success')      
                                          {{csrf_field()}}

                                          <div class="form-group">
                                            <label class="control-label col-sm-4" for="phone">Paypal Business Email  *</label>
                                            <div class="col-sm-6">
                                              <input name="pb" id="phone" class="form-control" placeholder="Enter Paypal Business Email" type="text" value="{{$data->pb}}">
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="control-label col-sm-4" for="phone">Stripe Key  *</label>
                                            <div class="col-sm-6">
                                              <input name="sk" id="phone" class="form-control" placeholder="Enter Stripe Key" type="text" value="{{$data->sk}}">
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="control-label col-sm-4" for="phone">Stripe Secret Key  *</label>
                                            <div class="col-sm-6">
                                              <input name="ss" id="phone" class="form-control" placeholder="Enter Stripe Secret Key" type="text" value="{{$data->ss}}">
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="control-label col-sm-4" for="phone">Normal Profile Price  *</label>
                                            <div class="col-sm-6">
                                              <input name="np" id="phone" class="form-control" placeholder="Enter Normal Profile Price" type="text" value="{{$data->np}}">
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="control-label col-sm-4" for="phone">Featured Profile Price  *</label>
                                            <div class="col-sm-6">
                                              <input name="fp" id="phone" class="form-control" placeholder="Enter Featured Profile Price" type="text" value="{{$data->fp}}">
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
                    <!-- Ending of Dashboard Office Address -->
                </div>
            </div>
        </div>
    </div>
@endsection