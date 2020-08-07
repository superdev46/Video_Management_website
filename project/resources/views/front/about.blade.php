@extends('layouts.front')
@section('contents')
      <div class="section-padding about-area-wrapper wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
               <div class="container">
                   <div class="row">
                       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        {!! $about !!}
                       </div>
                   </div>
               </div>
           </div>

@endsection