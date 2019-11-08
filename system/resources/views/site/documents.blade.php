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
                <h6 class = "pl-3 m-0 page-title">Documents <span class="text-danger">(5)</span></h6>
                
            </div>
        </div>
        <div class="col-md-12 mb-3">
            <div class="row m-0 align-items-center">
                <div class="col-12 p-0">
                   <form class=" row m-0 align-items-center">
                        <i class="fas fa-search text-muted" style="position:relative; left: 15px; z-index: 2;"></i>
                        <input style="padding-left: 45px; margin-left: -14px;" class="form-control search-form-control col" type="search" placeholder="Search" aria-label="Search">
                    </form>
                </div>
                
            </div>
            
        </div>
       <div class="col-md-12 row m-0 mb-3 documents">
           <a class="col-6 col-md-3 p-1"  href="{{Route('file')}}">
                <div class="card p-0" style="">
                    <div class="card-body p-0">
                        <div class="row m-0 justify-content-center">
                            <div class="w-100" style="overflow:hidden; height: 200px; ">
                                <div class="w-100 " id="viewport" role="main"></div>
                            </div>
                            <div class="col-12 p-0 mt-2">
                                <div class="row m-0 h-100 flex-column justify-content-center p-4 bg-white border-top text-dark">
                                    <h6 class="title mb-1 ">Direct Deposit Form</h6>
                                    <p class="small m-0 ">Date: <span class="text-dark">12/19/2019</span></p>
                                    <p class="small m-0">Extension: <span class="text-dark">PDF</span></p>
                                </div>
                            
                            </div>
                        
                        </div>
                        
                    </div>
                </div>
            </a>
            <a class="col-6 col-md-3 p-1"  href="{{Route('file')}}">
                <div class="card p-0" style="">
                    <div class="card-body p-0">
                        <div class="row m-0 justify-content-center">
                            <div class="w-100" style="overflow:hidden; height: 200px; ">
                                <div class="w-100" id="viewport1" role="main"></div>
                            </div>
                             <div class="col-12 p-0 mt-2">
                                <div class="row m-0 h-100 flex-column justify-content-center p-4 bg-white border-top text-dark">
                                    <h6 class="title mb-1 ">Direct Deposit Form</h6>
                                    <p class="small m-0 ">Date: <span class="text-dark">12/19/2019</span></p>
                                    <p class="small m-0">Extension: <span class="text-dark">PDF</span></p>
                                </div>
                            
                            </div>
                        
                        
                        </div>
                        
                    </div>
                </div>
            </a>
             <a class="col-6 col-md-3 p-1"  href="{{Route('file')}}">
                <div class="card p-0" style="">
                    <div class="card-body p-0">
                        <div class="row m-0 justify-content-center">
                            <div class="w-100" style="overflow:hidden; height: 200px; ">
                                <div class="w-100 p-1 border" id="viewport2" role="main"></div>
                            </div>
                             <div class="col-12 p-0 mt-2">
                                <div class="row m-0 h-100 flex-column justify-content-center p-4 bg-white border-top text-dark">
                                    <h6 class="title mb-1 ">Direct Deposit Form</h6>
                                    <p class="small m-0 ">Date: <span class="text-dark">12/19/2019</span></p>
                                    <p class="small m-0">Extension: <span class="text-dark">PDF</span></p>
                                </div>
                            
                            </div>
                        
                        
                        </div>
                        
                    </div>
                </div>
            </a>
             <a class="col-6 col-md-3 p-1"  href="{{Route('file')}}">
                <div class="card" style="">
                    <div class="card-body">
                        <div class="row m-0 justify-content-center">
                            <div class="w-100" style="overflow:hidden; height: 200px; ">
                                <div class="w-100" id="viewport3" role="main"></div>
                            </div>
                             <div class="col-12 p-0 mt-2">
                                <div class="row m-0 h-100 flex-column justify-content-center p-4 bg-white border-top text-dark">
                                    <h6 class="title mb-1 ">Direct Deposit Form</h6>
                                    <p class="small m-0 ">Date: <span class="text-dark">12/19/2019</span></p>
                                    <p class="small m-0">Extension: <span class="text-dark">PDF</span></p>
                                </div>
                            
                            </div>
                        
                        
                        </div>
                        
                    </div>
                </div>
            </a>
            
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
