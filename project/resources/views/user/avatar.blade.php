@extends('layouts.dashboard')

@section('contents')
<div class="right-side">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <!-- Starting of General settings area -->
                        <div class="panel panel-default general-setting">
                            <div class="panel-heading">
                                <i class="fa fa-picture-o fa-fw "></i> Avatar &amp; Cover
                            </div>
                            <div class="panel-body">
                                <form class="form-horizontal" action="" method="POST">
                                  <div class="form-group">
                                    <label class="control-label col-sm-3" for="avatar">Avatar</label>
                                    <div class="col-sm-6"> 
                                      <input type="file" id="avatar" name="avatar" required="">
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="control-label col-sm-3" for="new_passowrd">Cover</label>
                                    <div class="col-sm-6"> 
                                      <input type="file" id="Cover" name="Cover" required="">
                                    </div>
                                  </div>
                                  <hr>
                                  <div class="form-group"> 
                                    <div class="col-sm-offset-3 col-sm-6">
                                      <button type="submit" class="btn btn-default"><i class="fa fa-save"></i> Save</button>
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