@extends('admin.layouts.app')

@section('content')
<style>
    .ck-editor__editable_inline {
        min-height: 300px;
    }
</style>
<div class="bg-light h-100">
     <div class="bg-teal border-bottom border-top px-3 py-3 row m-0 align-items-center">
        <p class="m-0 text-uppercase" >{!!$title!!} </p>

    </div>
    <div class="container-fluid p-0 overflow-auto p-5" style="height:calc(100% - 52.2px);">

        <form class=" p-5 border shadow" method="POST" action="{{Route($form_action_route)}}">

           <div class="form-group row m-0 mb-4 align-items-center">
               <label class="m-0">To</label>
               <div class="tags-container row m-0 ml-2">

               </div>
               <button type="button" class="btn btn-dark btn-sm small mr-1 add-users-modal-btn" data-toggle="modal" data-target="#exampleModal">
                Add Users
              </button>

           </div>
            <div class="form-group mb-4">
               <label>Subject</label>
               <input class="form-control" type="text" name="subject"/>
           </div>
            <div class="form-group mb-4">
               <label>Message</label>
               <textarea  name="message" id="editor"></textarea>
                @csrf
           </div>
           <button type="submit" class="btn btn-dark btn-sm small">Send</button>
        </form>
    </div>
</div>
<div class="modal fade addUsersModal" data-backdrop="static" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h6 class="modal-title" id="exampleModalLabel">Add Users</h6>

        </div>
        <div class="modal-body p-0">


                <form id="SearchUsersForm" class="row m-0 p-3">
                    <input class="form-control auto-complete-search-input col" type="search" name="auto-complete"/>
                    <button type="submit" class="btn btn-dark btn-sm small auto-complete-search-btn ml-1">Search</button>

                </form>

                <div class="auto-complete-list bg-light p-3 d-none border border-bottom-0 overflow-auto" style="max-height: 300px;">
                    <table class="table  table-bordered m-0">
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <div class="text-center global-message-options border p-3" >

                    <div class="row m-0 justify-content-center">

                        <p class="w-100 mb-2">Global Message Options</p>
                        <button  class="btn btn-dark btn-sm small mr-2 message-all-users">Message To All Users</button>
                        <button  class="btn btn-dark btn-sm small message-all-donors">Message To All Donors</button>
                    </div>
                </div>

        </div>
        <div class="modal-footer results-footer d-none">
          <button type="button" class="btn btn-danger btn-sm small mr-auto" data-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-primary btn-sm small users-selected-save">Done</button>
        </div>
        <div class="modal-footer cancel-footer">
            <button type="button" class="btn btn-danger btn-sm small mx-auto" data-dismiss="modal">Cancel</button>

          </div>

      </div>
    </div>
  </div>
@endsection
