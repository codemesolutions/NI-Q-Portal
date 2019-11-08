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
                <h6 class = "ml-3 m-0 page-title border-bottom-thick-teal">Payments</h6>
              
                <h5 class="m-0 mr-3 ml-auto">Total Earnings: <span class="text-teal">$299.00</span></h5>
               
            </div>
        </div>
        <div class="col-md-12 mb-3 d-none">
            <div class="row m-0 align-items-center">
                <div class="col-12 p-0">
                   <form class=" row m-0 align-items-center">
                        <i class="fas fa-search text-muted" style="position:relative; left: 15px; z-index: 2;"></i>
                        <input style="padding-left: 45px; margin-left: -14px;" class="form-control search-form-control col" type="search" placeholder="Search" aria-label="Search">
                    </form>
                </div>
                
            </div>
            
        </div>
        <div class="col-md-12 mb-3 notifications">
        <div class="table-responsive  ">
           <table class="table bg-white p-5 border">
            <thead class="">
                <tr>
                <th scope="col">#</th>
                <th scope="col">Amount</th>
                <th scope="col">Date</th>
                <th scope="col">Type</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <th scope="row">1</th>
                <td>$2100</td>
                <td>12/5/2019</td>
                <td>Direct Deposit</td>
                </tr>
                <tr>
                <th scope="row">2</th>
                <td>$2100</td>
                <td>12/5/2019</td>
                <td>Direct Deposit</td>
                </tr>
                <tr>
                <th scope="row">3</th>
                <td>$2100</td>
                <td>12/5/2019</td>
                <td>Direct Deposit</td>
                </tr>
            </tbody>
            </table>
        </div>
            
        </div>
        <div class="row m-0 w-100 pl-3">
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
