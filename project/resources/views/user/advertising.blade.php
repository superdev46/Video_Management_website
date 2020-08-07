@extends('layouts.dashboard')

@section('contents')
<div class="right-side">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <!-- Starting of General settings area -->
                        <div class="alert alert-warning advertising">
                            <p class="ad-para">You can test the system by using the following PayPal credentials: </p>

                            <p><strong>Email:</strong> pro@wowonder.com</p>
                            <p><strong>Password:</strong> 12345678</p>
                        </div>
                        <div class="panel panel-default general-setting">
                            <div class="panel-heading">
                                <i class="fa fa-arrows-alt"></i> Advertising
                              
                                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal"><i class="fa fa-tasks"></i> <strong>Wallet ($0.00)</strong></button>

                                <div class="pull-right">
                                    <a class="advertising-link" href="create-ad.html">
                                        <i class="fa fa-plus"></i> Create ad
                                    </a>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="section-padding add-product-1">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="table-responsive">
                                              <div id="product-table_wrapper_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer"><div class="row"><div class="col-sm-6"><div class="dataTables_length" id="product-table_wrapper_length"><label>Show <select name="product-table_wrapper_length" aria-controls="product-table_wrapper" class="form-control input-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> entries</label></div></div><div class="col-sm-6"><div id="product-table_wrapper_filter" class="dataTables_filter"><label><input type="search" class="form-control input-sm" placeholder="Search records" aria-controls="product-table_wrapper"></label></div></div></div><div class="row"><div class="col-sm-12"><table id="product-table_wrapper" class="table table-striped table-hover products dt-responsive dataTable no-footer dtr-inline" cellspacing="0" width="100%" role="grid" aria-describedby="product-table_wrapper_info" style="width: 100%;">
                                                  <thead>
                                                      <tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="product-table_wrapper" rowspan="1" colspan="1" style="width: 124px;" aria-label="Status: activate to sort column descending" aria-sort="ascending">Status</th><th class="sorting" tabindex="0" aria-controls="product-table_wrapper" rowspan="1" colspan="1" style="width: 160px;" aria-label="Category: activate to sort column ascending">Category</th><th class="sorting" tabindex="0" aria-controls="product-table_wrapper" rowspan="1" colspan="1" style="width: 121px;" aria-label="Name: activate to sort column ascending">Name</th><th class="sorting" tabindex="0" aria-controls="product-table_wrapper" rowspan="1" colspan="1" style="width: 137px;" aria-label="Results: activate to sort column ascending">Results</th><th class="sorting" tabindex="0" aria-controls="product-table_wrapper" rowspan="1" colspan="1" style="width: 119px;" aria-label="Spent: activate to sort column ascending">Spent</th><th class="sorting" tabindex="0" aria-controls="product-table_wrapper" rowspan="1" colspan="1" style="width: 125px;" aria-label="Action: activate to sort column ascending">Action</th></tr>
                                                  </thead>

                                                    <tbody><tr class="odd"><td valign="top" colspan="6" class="dataTables_empty">No data available in table</td></tr></tbody>
                                                </table></div></div><div class="row"><div class="col-sm-5"><div class="dataTables_info" id="product-table_wrapper_info" role="status" aria-live="polite">Showing 0 to 0 of 0 entries</div></div><div class="col-sm-7"><div class="dataTables_paginate paging_simple_numbers" id="product-table_wrapper_paginate"><ul class="pagination"><li class="paginate_button previous disabled" id="product-table_wrapper_previous"><a href="#" aria-controls="product-table_wrapper" data-dt-idx="0" tabindex="0">Previous</a></li><li class="paginate_button next disabled" id="product-table_wrapper_next"><a href="#" aria-controls="product-table_wrapper" data-dt-idx="1" tabindex="0">Next</a></li></ul></div></div></div></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Ending of General settings area -->
                        </div>
                    </div>
                </div>
            </div>
@endsection