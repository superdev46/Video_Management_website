@extends('layouts.dashboard')

@section('contents')
<div class="right-side">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <!-- Starting of General settings area -->
                        <div class="panel panel-default general-setting">
                            <div class="panel-heading">
                                <i class="fa fa-home"></i> Monetization Settings

                                <div class="pull-right monetization">
                                    <a href="withdrawal.html">
                                        <i class="fa fa-clock-o"></i> Withdrawals
                                    </a>
                                </div>
                            </div>
                            <div class="panel-body">
                                <form class="form-horizontal" action="" method="POST">
                                    <div class="form-group">
                                        <label class="control-label col-sm-3" for="monetization">Monetization</label>
                                        <div class="col-sm-3">
                                            <label class="switch">
                                              <input type="checkbox" checked="">
                                              <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="alert alert-info">
                                        Earn (0.2 USD) for each advertisement click you get from your videos!
                                    </div>
                                  <div class="form-group">
                                    <label class="control-label col-sm-3" for="available_balance">Available balance</label>
                                    <div class="col-sm-6">
                                      <input type="text" readonly="true" name="available_balance" id="available_balance" class="form-control" value="0">
                                    </div>
                                    <div class="col-sm-1">USD</div>
                                  </div>
                                  <div class="form-group">
                                    <label class="control-label col-sm-3" for="paypal_email">PayPal E-mail</label>
                                    <div class="col-sm-6"> 
                                      <input type="email" class="form-control" id="paypal_email" name="paypal_email" placeholder="Enter PayPal E-mail" required="">
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="control-label col-sm-3" for="amount">Amount</label>
                                    <div class="col-sm-6">
                                      <input type="text" name="amount" id="amount" class="form-control" placeholder="Enter Amount" required="">
                                    </div>
                                    <div class="col-sm-2">Min 50: USD</div>
                                  </div>
                                  <hr>
                                  <div class="form-group"> 
                                    <div class="col-sm-offset-3 col-sm-6">
                                      <button type="submit" class="btn btn-default"><i class="fa fa-save"></i> Submit withdrawal request</button>
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