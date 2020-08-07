@extends('layouts.dashboard')
@section('contents')
<div class="right-side">
              <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <!-- Starting of General settings area -->
                        <div class="panel panel-default general-setting">
                            <div class="panel-heading">
                              <a href="{{route('user-playlist-index')}}" style="color: white;"><i class="fa fa-arrow-left"></i> Back</a>
                                <a href="{{route('user-playlist-show-create',$playlist->id)}}" style="float: right; color: white;"><i class="fa fa-plus"></i> Add a Video</a>
                            </div>
                            <div class="panel-body">

                              <div class="row">
                                   @include('includes.form-success')
                                <div class="col-sm-12">
    <table id="example" class="table table-striped table-hover products dt-responsive dataTable no-footer dtr-inline" role="grid" aria-describedby="product-table_wrapper_info" style="width: 100%;" width="100%" cellspacing="0">
                                              <thead>
                                                  <tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="product-table_wrapper" rowspan="1" colspan="1" style="width: 120px;" aria-sort="ascending" aria-label="Donor's Photo: activate to sort column descending">Thumbnail</th><th class="sorting" tabindex="0" aria-controls="product-table_wrapper" rowspan="1" colspan="1" style="width: 110px;" aria-label="Donor's Name: activate to sort column ascending">Title</th><th class="sorting" tabindex="0" aria-controls="product-table_wrapper" rowspan="1" colspan="1" style="width: 94px;" aria-label="Blood Group: activate to sort column ascending">Description</th><th class="sorting" tabindex="0" aria-controls="product-table_wrapper" rowspan="1" colspan="1" style="width: 140px;" aria-label="Actions: activate to sort column ascending">Action</th></tr>
                                              </thead>

	                                          <tbody>
                                          
                                          @foreach($playlist->videos as $vid)                                                
                                        <tr role="row" class="odd">
                                          @if($vid->video->type == 0)
                                        <td tabindex="0" class="sorting_1"><img src="{{ $vid->video->thumbnail ? asset('assets/files/images/'.$vid->video->thumbnail):'http://fulldubai.com/SiteImages/noimage.png'}}" alt="Video's Thumbnail" style="width: 250px"></td>
                                        @else
                                        <td tabindex="0" class="sorting_1"><img src="{{ $vid->video->thumbnail ? $vid->video->thumbnail:'http://fulldubai.com/SiteImages/noimage.png'}}" alt="Video's Thumbnail" style="width: 250px"></td>
                                        @endif
                                        <td>{{$vid->video->title}}</td>
                                        <td>{{strip_tags(substr($vid->video->text,0,80))}}</td>
                                        <td>
                                         <a href="{{route('front.video',$vid->video->id)}}" target="_blank" class="btn btn-info product-btn"><i class="fa fa-eye"></i> View</a>
                                        <a href="{{route('user-playlist-show-edit',$vid->id)}}" class="btn btn-primary product-btn"><i class="fa fa-edit"></i> Edit</a>
                                        <a href="{{route('user-playlist-delete-video',$vid->id)}}" class="btn btn-danger product-btn"><i class="fa fa-trash"></i> delete</a>
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