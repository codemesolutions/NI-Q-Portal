@extends('admin.layouts.app')

@section('content')
<div style="background:#111;" class=" h-100">
    <div style="border-bottom: #111 1px solid;" class="bg-dark   border-top px-3 py-3">
        <p class="m-0 text-uppercase text-white" >{!!$title!!} </p>
    </div>
    <div class="row m-0 p-0  overflow-auto" style="height: calc(100% - 53px);">
        <div class="col-12  p-0">

            <div class="row m-0 pb-0 align-items-stretch">

                 <div class="col-3 h-100 p-0">
                    <div class="bg-dark  text-white border-right-dark border-bottom-dark  p-5 text-center">

                        <h3 class="m-0">{{\App\FormSubmission::where('form_id', 1)->count()}}</h3>
                        <p class="m-0 small font-weight-bold">Submissions</p>
                    </div>
                </div>
                <div class="col-3 h-100 p-0">
                    <div class="bg-dark text-white border-right-dark border-bottom-dark  p-5 text-center">

                        <h3 class="m-0">{{\App\FormSubmission::where('form_id', 1)->where('completed', true)->count()}}</h3>
                        <p class="m-0 small font-weight-bold">Completed</p>
                    </div>
                </div>
                <div class="col-3 p-0">
                    <div class="bg-dark border-right-dark border-bottom-dark text-white   p-5 text-center">

                        <h3 class="m-0">{{\App\FormSubmission::where('form_id', 1)->where('blocked', true)->count()}}</h3>
                        <p class="m-0 small font-weight-bold">Disqualified</p>
                    </div>
                </div>
                 <div class="col-3 p-0">
                    <div class="bg-dark text-white  border-bottom-dark  p-5 text-center">

                        <h3 class="m-0"><h3 class="m-0">{{\App\FormSubmission::where('form_id', 1)->where('waited', true)->count()}}</h3></h3>
                        <p class="m-0 small font-weight-bold">Waitlisted</p>
                    </div>
                </div>
                <div class="col-3 p-0">
                        <div class="bg-dark text-white border-right-dark border-bottom-dark  p-5 text-center">

                            <h3 class="m-0">{{\App\Donor::count()}}</h3>
                            <p class="m-0 small font-weight-bold">Approved</p>
                        </div>
                    </div>
                <div class="col-3 p-0">
                    <div class="bg-dark text-white border-right-dark border-bottom-dark  p-5 text-center">

                        <h3 class="m-0">{{\App\MilkKit::count()}}</h3>
                        <p class="m-0 small font-weight-bold">Milkkits</p>
                    </div>
                </div>
                 <div class="col-3 p-0">
                    <div class="bg-dark text-white border-right-dark border-bottom-dark  p-5 text-center">

                        <h3 class="m-0">{{\App\BloodKit::count()}}</h3>
                        <p class="m-0 small font-weight-bold">Bloodkit</p>
                    </div>
                </div>
               <div class="col-3 p-0">
                    <div class="bg-dark border-bottom-dark text-white p-5 text-center">

                        <h3 class="m-0">{{\App\User::count()}}</h3>
                        <p class="m-0 small font-weight-bold">Total Users</p>
                    </div>
                </div>

                <div class="col-12 p-0">
                    <div class="  text-dark   p-0 row m-0 align-items-center justify-content-start">
                        <h6 class="text-uppercase m-0 d-none"> <i class="fas fa-bell bg-info p-2 text-white "></i> Submissions</h6>
                        <div class="w-100 mt-0 overflow-auto p-0">
                                <input type="search" name="search" class="form-control form-control-dark rounded-0 col table-search mb-0 border-0" placeholder="search"/>
                            <table class="table bg-white text-center searchable m-0">
                                <thead>
                                    <tr>
                                        <th class="" >#</th>
                                        <th class="" onclick="sortable({{1}}, 'table.searchable')">Form <i class="fas fa-sort"></i></th>
                                        <th class="" onclick="sortable({{2}}, 'table.searchable')">First Name <i class="fas fa-sort"></i></th>
                                        <th class="" onclick="sortable({{3}}, 'table.searchable')">Last Name <i class="fas fa-sort"></i></th>
                                        <th class="" onclick="sortable({{4}}, 'table.searchable')">Email <i class="fas fa-sort"></i></th>
                                        <th class="" onclick="sortable({{5}}, 'table.searchable')">Created Date <i class="fas fa-sort"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($submissions as $k => $sub)

                                        <tr class="hover"  data-href="/admin/forms/submissions/submission?form={{\App\Form::where('id', $sub->form_id)->first()->name}}&id={{$sub->id}}">
                                            <td>{{$k + 1}}</td>
                                            <td class="clickable">{{\App\Form::where('id', $sub->form_id)->first()->name}}</td>
                                            <td class="clickable">{{$sub->user_id['first_name']}}</td>
                                            <td class="clickable">{{$sub->user_id['last_name']}}</td>
                                            <td class="clickable">{{$sub->user_id['email']}}</td>
                                            <td class="clickable">{{$sub->user_id['created_at']}}</td>
                                        </tr>

                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-5 p-0 d-none">
                    <div class=" bg-dark text-dark border  p-5 row m-0 align-items-center justify-content-start">
                        <h6 class="text-uppercase m-0"> <i class="fas fa-inbox bg-dark p-2  "></i> Messages</h6>
                        <div class="w-100 mt-4 ">

                            <ul class="list-group ">
                                @foreach($request->user()->conversations()->orderBy('created_at', 'desc')->get() as $convo)
                                <a class="list-group-item rounded-0 bg-dark " href="{{Route('admin.message')}}"><span class="bg-dark d-inline-block text-center text-primary mr-2 text-uppercase" style="height: 20px; width: 20px; ">{{$convo->subject[0]}}</span>{{$convo->subject . ' - ' .$convo->users()->where('users.id', '!=', $request->user()->id)->first()->name}}</a>
                                @endforeach

                            </ul>
                        </div>
                    </div>
                </div>



            </div>
        </div>


    </div>
</div>

@endsection
