@extends('layouts.dashboard')

@section('contents')
<div class="right-side">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <!-- Starting of General settings area -->
                        <div class="panel panel-default general-setting">
                            <div class="panel-heading">
                                <i class="fa fa-key"></i> {{$lang->chnp}}
                            </div>
                            <div class="panel-body">
                                <form class="form-horizontal" action="{{route('user-reset-submit')}}" method="POST">
                            @include('includes.form-success')
                            @include('includes.form-error')
                            {{csrf_field()}} 
                              <div class="form-group">
                                <label for="full_name" class="col-sm-3 control-label">{{$lang->cp}} *</label>
                                <div class="col-sm-8">
                                  <input class="form-control" id="full_name" name="cpass" placeholder="{{$lang->cp}}" type="text" value="" required="">
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="full_name" class="col-sm-3 control-label">{{$lang->np}} *</label>
                                <div class="col-sm-8">
                                  <input class="form-control" id="full_name" name="newpass" placeholder="{{$lang->np}}" type="text" value="" required="">
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="full_name" class="col-sm-3 control-label">{{$lang->rnp}} *</label>
                                <div class="col-sm-8">
                                  <input class="form-control" id="full_name" name="renewpass" placeholder="{{$lang->rnp}}" type="text" value="" required="">
                                </div>
                              </div>
                                  <hr>
                                  <div class="form-group"> 
                                    <div class="col-sm-offset-3 col-sm-6">
                                      <button type="submit" class="btn btn-default"><i class="fa fa-save"></i> {{$lang->chnp}}</button>
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