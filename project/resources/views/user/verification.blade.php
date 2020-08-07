@extends('layouts.dashboard')

@section('contents')
<div class="right-side">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <!-- Starting of General settings area -->
                        <div class="panel panel-default general-setting">
                            <div class="panel-heading">
                                <i class="fa fa-check"></i> Get verified
                            </div>
                            <div class="panel-body">
                                <form class="form-horizontal" action="" method="POST">
                                    <div class="form-group">
                                        <div class="col-sm-4 col-sm-offset-1">
                                            <a href="" class="upload-img-area text-center">
                                                <i class="fa fa-camera"></i>
                                            </a>
                                        </div>
                                        <div class="col-sm-4">
                                            <h4>Upload Passport or ID</h4>
                                            <p>Please select a recent picture of your passport or id</p>
                                            <button type="submit" class="btn btn-default upload-img"><i class="fa fa-upload"></i> Choose File</button>
                                        </div>
                                    </div>
                                  <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-1 upload"> 
                                      <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter First Name" required="">
                                    </div>
                                    <div class="col-sm-4"> 
                                      <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter Last Name" required="">
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <div class="col-sm-8 col-sm-offset-1">
                                        <textarea name="message" id="message" cols="30" rows="5" class="form-control" placeholder="Enter Message" style="resize: vertical;" required=""></textarea>
                                    </div>
                                  </div>
                                  <hr>
                                  <div class="form-group"> 
                                    <div class="col-sm-offset-1 col-sm-7">
                                      <button type="submit" class="btn btn-default"><i class="fa fa-save"></i> Submit request</button>
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