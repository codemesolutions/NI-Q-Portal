@extends('admin.layouts.app')

@section('content')
 
<div class="bg-dark p-5">
    <div class="container-fluid bg-white p-5 border">
        <div class="row m-0 align-items-center pb-4">
            <div class="">
                <h5 class="m-0 text-uppercase" > <i class="fas fa-map p-3 bg-primary text-white"></i> {{$form->name}} Form Field Map  </h5>
               
            </div>
            
         
        </div>
       
        
        @if(Session::has('success'))
           
            <div class="alert alert-success alert-dismissible fade show mb-4 rounded-0 " role="alert">
                {{ Session::get('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
       
            <form>
                <table style="table-layout:fixed;" class="table  my-5">
                    <thead>
                        <tr>
                            <th>Field Name</th>
                            
                            <th>Table/Column</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($form->pages()->get() as $page)
                            @foreach($page->fields()->get() as $field)
                                <tr>
                                    <td class="border-right border-left py-4">{{$field->name}}</td>
                                    <td class="border-right py-4">
                                        <select class="form-control">
                                            @foreach($tables as $table)
                                                @foreach( Schema::getColumnListing($table) as $col)
                                                    @if($table == $form->table_name && $col === strtolower($field->name))
                                                        <option selected>{{$table. ' - ' . $col}}</option>
                                                    @else
                                                        <option>{{$table. ' - ' . $col}}</option>
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        </select>
                                    </td>
                                    
                                </tr>
                            @endforeach
                        @endforeach
                        
                    </tbody>
                </table>
                <div class="row m-0">
                    <button type="submit" class="btn btn-primary ml-auto">Save Form Field Map</button>
                </div>
            </form>
       
    </div>
</div>



@endsection
