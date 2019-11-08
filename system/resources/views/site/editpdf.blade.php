@extends('site.layouts.app')

@section('content')
@include('site.blocks.donor-heading')
@include('site.blocks.donor-nav')
<div class="container">
    <div class=" mb-4 px-3 d-none">
        <div class="alert alert-danger alert-dismissible fade show rounded-0 mb-1 py-3" role="alert">
            <strong>Urgent Update Needed!</strong> We have not recieved your blood lab kit.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
    </div>
    <div class="row m-0 justify-content-center pb-5 mb-1">
        
      
        
          <div class="col-12 p-0 mb-3">
            <div class="row m-0 align-items-center">
                <h6 class = "pl-3 m-0 page-title">File (<span class="text-teal">awdawdwa</span>)</h6>
                <button class="btn btn-teal ml-auto"><i class="fas fa-pen"></i> Edit</button>
                <button class="btn btn-danger ml-1 mr-3"><i class="fas fa-trash"></i> Delete</button>
            </div>
        </div>

        <div class="w-100 overflow-auto">
            <div style="height: 800px;">
                <div style="padding: 100px; background: #333;">
                    <div style="display:block; "  id="viewport" role="main"></div>
                </div>
            </div>
        </div>
       
       
    </div>
</div>
@endsection
