@extends('layouts.dashboard')

@section('contents')

<div class="right-side">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <!-- Starting of General settings area -->
                        <div class="panel panel-default general-setting">
                            <div class="panel-heading">
                                <i class="fa fa-cloud-download"></i> {{$lang->vdn}}
                            </div>
                            <div class="panel-body">
                                        <form class="form-horizontal" action="{{route('user-fetch-createfetch')}}" method="POST">
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

                            </div>
                        </div>
                        <!-- Ending of General settings area -->
                        </div>
                    </div>
                </div>
            </div>

@endsection



