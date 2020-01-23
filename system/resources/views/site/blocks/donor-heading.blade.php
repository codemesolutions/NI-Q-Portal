
<div class=" jumbotron jumbotron-fluid bg-light border-top border-bottom py-0 ">
    <div class="container py-0 text-left">
        <div class="py-2 row m-0 w-100 align-items-center justify-content-center">
            <p class="font-weight-bold m-0 mr-md-auto mb-4 mb-md-0 d-none">Welcome, <span class=" font-weight-bold text-teal">{{Auth::user()->name}}</span></p>
            <p>Donor ID: <span class="text-muted">{{Auth::user()->donors()->first()->donor_number}}</span> </p>
            <p class="ml-3">Milk Kits Recieved: <span class="text-muted">0</span> </p>
            <p class="ml-3">Lab Results : <span class="text-success">Passed</span> </p>
            @if(!is_null(Auth::user()->donors()->first()) && Auth::user()->donors()->first()->bloodkits()->count() > 0)

                @if(!is_null(Auth::user()->donors()->first()->bloodkits()->first()->recieve_date) && Auth::user()->donors()->first()->bloodkits()->first()->status === 1)

                    <button type="button" class=" btn btn-light small border text-uppercase ml-auto font-weight-bold" data-toggle="modal" data-target="#request-milkkit">
                        Request Milk Kit
                    </button>
                    <button type="button" class="btn btn-light small border text-uppercase font-weight-bold " data-toggle="modal" data-target="#pickup-message">
                        Schedule A Pickup
                    </button>

                @endif
            @endif


        </div>
    </div>
</div>
