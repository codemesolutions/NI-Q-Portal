@extends('admin.layouts.app')

@section('content')
 
<div class="bg-white h-100">
     <div class="bg-dark px-3 py-3 row m-0 align-items-center">
        <p class="m-0 text-uppercase text-white" >{!!$title!!} </p>
        <a href="/admin/donors/update?id={{$donor->id}}" class="btn btn-warning btn-sm ml-auto mr-1 text-white"><i class="fas fa-pencil-alt"></i> Edit Donor</a>
        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-trash"></i> Delete Donor</button>
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
        <div class="container-fluid ">
                <div class="row  m-0 mt-4">
                    
                    <div class="col-12">
                        <div class="">
                            <div class="row m-0 bg-light border-top border-left border-right p-3">
                                <p class="m-0">Donor Information</p>
                            </div>
                            <table class="table bg-white border-left border-right">
                                <tbody>
                                    <tr>
                                        <td class="">Donor ID</td>
                                        <td>{{$donor->donor_number}}</td>
                                    </tr>
                                    <tr>
                                        <td class="">First Name</td>
                                        <td>{{$donor->user_id->first_name}}</td>
                                    </tr>
                                    <tr>
                                        <td class="">Last Name</td>
                                        <td>{{$donor->user_id->last_name}}</td>
                                    </tr>
                                    <tr>
                                        <td class="">Date Of Birth</td>
                                        <td>{{$donor->date_of_birth}}</td>
                                    </tr>
                                    <tr>
                                        <td class="">Email</td>
                                        <td>{{$donor->user_id->email}}</td>
                                    </tr>
                                    
                                    <tr>
                                        <td class="">Cell Phone</td>
                                        <td>{{$donor->cell_phone}}</td>
                                    </tr>
                                    <tr>
                                        <td class="">Home Phone</td>
                                        <td>{{$donor->home_phone}}</td>
                                    </tr>

                                    <tr>
                                        <td class="">Active</td>
                                        <td>{!!$donor->active == true ? '<span class="badge badge-success rounded-0">Active</span>':'<span class="badge badge-danger rounded-0">Inactive</span>'!!}</td>
                                    </tr>

                                    <tr>
                                        <td class="">Received Consent Form</td>
                                        <td>{{$donor->recieved_consent_form == true ? "Yes":"No"}}</td>
                                    </tr>
                                    <tr>
                                        <td class="">Consent Form</td>
                                        <td><a href="/file/{{$donor->consent_form}}">Consent Form</a></td>
                                    </tr>
                                    <tr>
                                        <td class="">Received Financial Form</td>
                                        <td>{{$donor->recieved_finacial_form == true ? "Yes":"No"}}</td>
                                    </tr>
                                    
                                    <tr>
                                        <td class="">Created Date</td>
                                        <td>{{$donor->created_at}}</td>
                                    </tr>
                                    <tr>
                                        <td class="">Updated Date</td>
                                        <td>{{$donor->updated_at}}</td>
                                    </tr>
                                
                                </tbody>
                        </table>
                        </div>
                    
                        @if($donor->user_id->notifications()->count() > 0)
                        <div class="">
                            <div class="row m-0 bg-light border border-bottom-0 p-3">
                                <p class="m-0">Donor Notifications({{$donor->user_id->notifications()->count()}})</p>
                            </div>
                            <table class="table bg-white border-left border-right">
                                <tbody>
                                    @foreach($donor->user_id->notifications()->get() as $mk)
                                    <tr>
                                            <td>{{$mk->message}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                        </table>
                        </div>
                        @endif

                        @if($donor->user_id->conversations()->count() > 0)
                        <div class="">
                            <div class="row m-0 bg-light border border-bottom-0 p-3">
                                <p class="m-0">Donor Messages({{$donor->user_id->notifications()->count()}})</p>
                            </div>
                            <table class="table bg-white border-left border-right">
                                <tbody>
                                    @foreach($donor->user_id->conversations()->get() as $mk)
                                    <tr>
                                            <td>{{$mk->subject}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                        </table>
                        </div>
                        @endif
                        @if($donor->user_id->forms()->count() > 0)
                        <div class="">
                            <div class="row m-0 bg-light border border-bottom-0 p-3">
                                <p class="m-0">Donor Forms({{$donor->user_id->notifications()->count()}})</p>
                            </div>
                            <table class="table bg-white border-left border-right">
                                <tbody>
                                    @foreach($donor->user_id->forms()->get() as $mk)
                                    <tr>
                                            <td>{{$mk->name}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                        </table>
                        </div>
                        @endif

                                   <div class="">
                            <div class="row m-0 bg-light border-top border-left border-right p-3">
                                <p class="m-0">Donor Mailing Address</p>
                            </div>
                            <table class="table bg-white border-left border-right">
                                <tbody>
                                    <tr>
                                        <td class="">Address</td>
                                        <td>{{$donor->mailing_address}}</td>
                                    </tr>
                                    <tr>
                                        <td class="">Address 2</td>
                                        <td>{{$donor->mailing_address2}}</td>
                                    </tr>
                                    <tr>
                                        <td class="">City</td>
                                        <td>{{$donor->mailing_city}}</td>
                                    </tr>
                                    <tr>
                                        <td class="">State</td>
                                        <td>{{$donor->mailing_state}}</td>
                                    </tr>
                                    <tr>
                                        <td class="">Zip Code</td>
                                        <td>{{$donor->mailing_zipcode}}</td>
                                    </tr>
                                
                                
                                </tbody>
                        </table>
                        </div>
                        <div class="">
                            <div class="row m-0 bg-light border-top border-left border-right p-3">
                                <p class="m-0">Donor Shipping Address</p>
                            </div>
                            <table class="table bg-white border-left border-right">
                                <tbody>
                                    <tr>
                                        <td class="">Address</td>
                                        <td>{{$donor->shipping_address}}</td>
                                    </tr>
                                    <tr>
                                        <td class="">Address 2</td>
                                        <td>{{$donor->shipping_address2}}</td>
                                    </tr>
                                    <tr>
                                        <td class="">City</td>
                                        <td>{{$donor->shipping_city}}</td>
                                    </tr>
                                    <tr>
                                        <td class="">State</td>
                                        <td>{{$donor->shipping_state}}</td>
                                    </tr>
                                    <tr>
                                        <td class="">Zip Code</td>
                                        <td>{{$donor->shipping_zipcode}}</td>
                                    </tr>
                                
                                
                                </tbody>
                        </table>
                        </div>
                      
                    </div>
                    <div class="col-12">
             
                        @if($donor->bloodkits()->count() > 0)
                        <div class="">
                            <div class="row m-0 bg-light border border-bottom-0 p-3">
                                <p class="m-0">Donor Blood Kits({{$donor->bloodkits()->count()}})</p>
                            </div>
                            <table class="table bg-white border-left border-right">
                                <tbody>
                                    @foreach($donor->bloodkits()->get() as $mk)
                                        @php $mk = $mk->toArray(); @endphp
                                        @foreach($mk as $col => $val)
                                            @if($col !== "id" && $col !== 'donor_id')
                                                @if($col == "active" || $col == "status")
                                                <tr>
                                                    <td>{{$col}}</td>
                                                    <td>{{$val == 0 ? "false":"true"}}</td>
                                                </tr>
                                                @else
                                                <tr>
                                                    <td>{{$col}}</td>
                                                    <td>{{$val}}</td>
                                                </tr>
                                                @endif
                                            @endif
                                        @endforeach
                                    @endforeach
                                </tbody>
                        </table>
                        </div>
                        @endif
                        <div class="">
                            <div class="row m-0 bg-light border p-3">
                                <p class="m-0">Donor Milk Kits({{$donor->milkkits()->count()}})</p>
                            </div>
                            <table class="table bg-white border-left border-right">
                                <tbody>
                                    @foreach($donor->milkkits()->where('closed', false)->get() as $mk)
                                        @php $mk = $mk->toArray(); @endphp
                                        @foreach($mk as $col => $val)
                                            @if($col !== "id" && $col !== 'donor_id')
                                                @if($col == "active" || $col == "status" || $col == "closed" || $col == "transferred")
                                                <tr>
                                                    <td>{{$col}}</td>
                                                    <td>{{$val == 0 ? "false":"true"}}</td>
                                                </tr>
                                                @else
                                                <tr>
                                                    <td>{{$col}}</td>
                                                    <td>{{$val}}</td>
                                                </tr>
                                                @endif
                                            @endif
                                        @endforeach
                                    @endforeach
                                </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog rounded-0" role="document">
    <div class="modal-content rounded-0">
      <div class="modal-header align-items-center bg-light rounded-0 p-0 p-3">
        <p class="modal-title m-0" id="exampleModalLabel">Delete Donor</p>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body py-3">
        <div class="row m-0 align-items-center">
            <div class="col-4 ">
                <h1 class="display-3 m-0 text-danger text-right"><i class="fas fa-exclamation-triangle"></i></h1>
            </div>
            <div class="col">
                <h5>Are you sure?</h5>
                <p>You are trying to delete a donor.  The donor will be given the status of inactive and archived.  Once this is done it cannot be undone.</p>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-thumbs-down"></i> Cancel</button>
        <a type="button" href="/admin/donors/delete?id={{$donor->id}}" class="btn btn-success"><i class="fas fa-thumbs-up"></i> Delete</a>
      </div>
    </div>
  </div>
</div>
    
@endsection
