@extends('layouts.dashboard')

@section('contents')

<div class="right-side">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <!-- Starting of General settings area -->
                        <div class="panel panel-default general-setting">
                            <div class="panel-heading">
                                <i class="fa fa-cloud-download"></i> {{$lang->lm}}
                            </div>
                            <div class="panel-body">

                              <div class="row">
                                   @include('includes.form-success')
                                <div class="col-sm-12">
                                  
                             

    <table id="example" class="table table-striped table-hover products dt-responsive dataTable no-footer dtr-inline" role="grid" aria-describedby="product-table_wrapper_info" style="width: 100%;" width="100%" cellspacing="0">
                                              <thead>
                                                  <tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="product-table_wrapper" rowspan="1" colspan="1" style="width: 130px;" aria-sort="ascending" aria-label="Donor's Photo: activate to sort column descending">Thumbnail</th><th class="sorting" tabindex="0" aria-controls="product-table_wrapper" rowspan="1" colspan="1" style="width: 90px;" aria-label="Donor's Name: activate to sort column ascending">Video Title</th><th class="sorting" tabindex="0" aria-controls="product-table_wrapper" rowspan="1" colspan="1" style="width: 164px;" aria-label="Blood Group: activate to sort column ascending">Video Description</th><th class="sorting" tabindex="0" aria-controls="product-table_wrapper" rowspan="1" colspan="1" style="width: 65px;" aria-label="City: activate to sort column ascending">Category</th><th class="sorting" tabindex="0" aria-controls="product-table_wrapper" rowspan="1" colspan="1" style="width: 120px;" aria-label="Actions: activate to sort column ascending">Actions</th></tr>
                                              </thead>

                                              <tbody>
                                            @foreach($videos as $video)                                                
                                              <tr role="row" class="odd">
                                                      <td tabindex="0" class="sorting_1"><img src="{{ $video->thumbnail}}" alt="Video's Thumbnail" style="width: 200px"></td>
                                                    <td>{{$video->title}}</td>
                                                    <td>{{substr(strip_tags($video->text),0,100)}}</td>
                                                    <td>{{$video->category->cat_name}}</td>
                                                      <td>
                                                        <a href="{{route('user-fetch-edit',$video->id)}}" class="btn btn-primary product-btn"><i class="fa fa-edit"></i> Edit</a>
                                                        <a href="{{route('user-fetch-delete',$video->id)}}" class="btn btn-danger product-btn"><i class="fa fa-trash"></i> Remove</a>
                                                      </td>
                                                  </tr>
                                                  @endforeach
                                                  </tbody>
                                          </table>
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

@section('scripts')

<script type="text/javascript">
  $('#example').DataTable();
</script>

@endsection

