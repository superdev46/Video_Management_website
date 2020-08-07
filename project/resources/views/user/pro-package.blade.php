@extends('layouts.dashboard')

@section('contents')
<div class="right-side">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <!-- Starting of Pricing table area -->
                        <div class="panel panel-default admin">
                          <div class="panel-heading admin-title text-center">Discover more features with PlayTube Pro package!
                          </div>
                            <div class="panel-body dashboard-body">
                               <div class="pro-pricing-area">
                                   <div class="row">
                                        <div class="col-sm-6">
                                            <div class="single-pricing-table">
                                                <div class="pricing-heading">
                                                    <h2>Free Member</h2>
                                                </div>
                                                <div class="pricing-count">
                                                    <p class="pricing-number"><span>$</span>0</p>
                                                    per month
                                                </div>
                                                <div class="pricing-list">
                                                    <ul>
                                                        <li>Upload up to 1GB limit</li>
                                                        <li>Videos ads will show up</li>
                                                        <li>Not featured videos</li>
                                                        <li>No verified badge</li>
                                                        <li>1 Medical Consultation</li>
                                                    </ul>
                                                </div>

                                                <a href="" class="boxed-btn">Stay Free</a>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="single-pricing-table">
                                                <div class="pricing-heading">
                                                    <h2>Pro Member</h2>
                                                </div>
                                                <div class="pricing-count">
                                                    <p class="pricing-number"><span>$</span>10</p>
                                                    per month
                                                </div>
                                                <div class="pricing-list">
                                                    <ul>
                                                        <li>Upload up to 1000GB</li>
                                                        <li>No ads will show up</li>
                                                        <li>Featured videos</li>
                                                        <li>Verified badge</li>
                                                    </ul>
                                                </div>

                                                <a href="" class="boxed-btn">Upgrade</a>
                                            </div>
                                        </div>
                                    </div> 
                               </div>  
                            </div>
                        </div>
                        <!-- Ending of Pricing table area -->
                </div>
            </div>
        </div>
    </div>
@endsection