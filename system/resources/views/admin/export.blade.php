@extends('admin.layouts.app')

@section('content')
 
<div class="bg-light h-100">
     <div class="bg-dark px-3 py-3">
        <p class="m-0 text-uppercase text-white" >{!!$title!!} </p>
    </div>
    <div style="height: calc(100% - 51.2px);" class="overflow-auto">
        @if(Session::has('success'))
           
            <div class="alert alert-success alert-dismissible fade show mb-4 rounded-0 " role="alert">
                {{ Session::get('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if($errors->count() > 0)
            {{dd($errors->all())}}
        @endif
        <div class="container-fluid  p-3 p-md-5">
            <div class="w-50 mx-auto p-5 bg-white border text-center">
                <div class="bg-light py-4">
                <h6 class="">Your export is ready!<h6>
                <p>Please click the button below to download your export file</p>
                </div>
                <a href="/admin/shipping/export/download" class="btn btn-success btn-block py-3 mt-4">Download</a>
            </div>
        </div>
    </div>
</div>
    
@endsection
