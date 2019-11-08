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
                
                <a href="{{Route('edit')}}" class="btn btn-teal ml-auto"><i class="fas fa-download"></i> Download</a>
                <a href="{{Route('edit')}}" class="btn btn-teal ml-1"><i class="fas fa-print"></i> Print</a>
                <button class="btn btn-danger ml-1 mr-3"><i class="fas fa-trash"></i> Delete</button>
            </div>
        </div>
      
        <div class="col-md-12 row m-0 mb-3 documents bg-white p-5 border">
            <div class="w-100"  id="viewport1" role="main"></div>
        </div>
        <div class="row m-0 w-100 pl-3 d-none">
             <nav aria-label="Page navigation">
                <ul class="pagination">
                    <li class="page-item disabled ">
                    <a class="page-link rounded-0 text-teal" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                    </li>
                    <li class="page-item"><a class="page-link text-teal" href="#">1</a></li>
                    <li class="page-item"><a class="page-link text-teal" href="#">2</a></li>
                    <li class="page-item"><a class="page-link text-teal" href="#">3</a></li>
                    <li class="page-item">
                    <a class="page-link rounded-0 text-teal" href="#">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
       
    </div>
</div>
@endsection
