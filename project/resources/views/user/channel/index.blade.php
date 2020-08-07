@extends('layouts.dashboard')
@section('contents')
<div class="right-side">
              <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <!-- Starting of General settings area -->
                        <div class="panel panel-default general-setting">
                            <div class="panel-heading">
                                <i class="fa fa-play fa-fw"></i> {{$lang->rds}}
                                <a href="{{route('user-channel-create')}}" style="float: right; color: white;"><i class="fa fa-plus"></i> Create New Channel</a>
                            </div>
                            <div class="panel-body">

                              <div class="row">
                                   @include('includes.form-success')
                                <div class="col-sm-12">
    <table id="example" class="table table-striped table-hover products dt-responsive dataTable no-footer dtr-inline" role="grid" aria-describedby="product-table_wrapper_info" style="width: 100%;" width="100%" cellspacing="0">
                                              <thead>
                                                  <tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="product-table_wrapper" rowspan="1" colspan="1" style="width: 130px;" aria-sort="ascending" aria-label="Donor's Photo: activate to sort column descending">Image</th><th class="sorting" tabindex="0" aria-controls="product-table_wrapper" rowspan="1" colspan="1" style="width: 110px;" aria-label="Donor's Name: activate to sort column ascending">Title</th><th class="sorting" tabindex="0" aria-controls="product-table_wrapper" rowspan="1" colspan="1" style="width: 94px;" aria-label="Blood Group: activate to sort column ascending">Playlists</th><th class="sorting" tabindex="0" aria-controls="product-table_wrapper" rowspan="1" colspan="1" style="width: 94px;" aria-label="Blood Group: activate to sort column ascending">Videos</th><th class="sorting" tabindex="0" aria-controls="product-table_wrapper" rowspan="1" colspan="1" style="width: 200px;" aria-label="Actions: activate to sort column ascending">Action</th></tr>
                                              </thead>

	                                          <tbody>
                                            @foreach($channels as $channel)                                                
                                                  <tr role="row" class="odd">
                                                      <td tabindex="0" class="sorting_1"><img src="{{ $channel->photo ? asset('assets/files/images/'.$channel->photo):'http://fulldubai.com/SiteImages/noimage.png'}}" alt="Video's Thumbnail" style="width: 250px"></td>
                                                    <td>{{$channel->title}}</td>
                                                    <td>{{count($channel->contents()->where('type','=',1)->get())}}</td>
                                                    <td>{{count($channel->contents()->where('type','=',2)->get())}}</td>
                                                      <td>
                                                    <a href="{{route('user-channel-show',$channel->id)}}" class="btn btn-info product-btn"><i class="fa fa-eye"></i> View Contents</a>
                                                    <a href="{{route('user-channel-edit',$channel->id)}}" class="btn btn-primary product-btn"><i class="fa fa-edit"></i> Edit</a>
                                                    <a href="{{route('user-channel-delete',$channel->id)}}" class="btn btn-danger product-btn"><i class="fa fa-trash"></i> Remove</a>
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