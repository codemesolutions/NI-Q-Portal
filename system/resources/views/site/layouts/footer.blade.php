@if(isset($request))
<div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form class="modal-dialog rounded-0 modal-lg shadow-lg" action="{{Route('admin.message.create')}}" method="post" enctype="application/x-www-form-urlencoded">
      <div class="modal-content rounded-0">
        <div style="border-top: #12bdd0 5px solid;" class="modal-header  border-bottom-0 align-items-center bg-light rounded-0 p-0 px-3 py-2">
          <p class="modal-title m-0" id="exampleModalLabel">Compose Message</p>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body p-4 bg-light ">

                <style>
                    .ck-editor__editable_inline {
                        min-height: 300px;
                    }
                </style>
                <div class="" >
                    @csrf
                    <div class="form-group">
                        <label>Subject</label>
                        <input class="form-control" type="text" name="subject" value=""/>
                    </div>
                    <input type="hidden" name="donor_message" value="1"/>
                    <input type="hidden" name="from" value="{{$request->user()->id}}">
                    <input type="hidden" name="user[]" value="support">
                    <textarea  name="message" id="editor"></textarea>

                </div>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger small mr-auto" data-dismiss="modal"><i class="fas fa-times"></i> Cancel</button>
          <button type="submit" class="btn btn-dark small"><i class="fas fa-reply"></i> Send</button>
        </div>
      </div>
    </form>
</div>
@if(!is_null(Auth::user()->donors()->first()))
<div class="modal fade" id="pickup-message" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form class="modal-content rounded-0" action="{{Route('milkkit_pickup')}}">
            <div class="modal-header rounded-0 border-right bg-light border-bottom-0" style="border-top: #12bdd0 5px solid;">
                <p class="modal-title font-weight-bold" id="exampleModalLabel">Schedule A Pickup Information</p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body bg-white p-4">

               <p class="mb-4">please be informed, if you have scheduled a pick up before 1pm same day, pick up will occur between 10am -7pm. For next day pick up, please wait to schedule until after 1pm the day prior to your planned day.</p>
               <div class="form-group border bg-white pt-2 pb-3 px-3">
                   <label class="m-0">Date:</label>
                    <div class="row m-0">
                        <select class="custom-select col custom-select-sm" name="month">
                            @for($i = 1; $i < 13; $i++)
                                    @if(date('F') === date('F', mktime(0, 0, 0, $i, 10)) )
                                        <option value="{{$i}}" selected>{{date('F', mktime(0, 0, 0, $i, 10))}}</option>
                                    @else
                                        <option value="{{$i}}">{{date('F', mktime(0, 0, 0, $i, 10))}}</option>
                                    @endif
                            @endfor
                        </select>

                        <select class="custom-select col custom-select-sm" name="day">
                            @for($i = 1; $i < 32; $i++)

                                @if(date('d') === date('d', mktime(0, 0, 0, 0, $i)))
                                    <option value="{{$i}}" selected>{{$i}}</option>
                                @else
                                    <option value="{{$i}}">{{$i}}</option>
                                @endif
                            @endfor
                        </select>
                        <select class="custom-select col custom-select-sm" name="year">
                            @for($i = date('Y'); $i < 2050; $i++)
                                @if(date('Y') ===  $i )
                                    <option value="{{$i}}" selected>{{$i}}</option>
                                @else
                                    <option value="{{$i}}">{{$i}}</option>
                                @endif
                            @endfor
                        </select>


                    </div>
                </div>
                <div class="form-group border bg-white pt-2 pb-3 px-3">

                    <label class="m-0">Time:</label>
                    <div class="row m-0 align-items-center">

                        <select class="custom-select col custom-select-sm hours" name="hour">
                            @for($i = 1; $i < 13; $i++)

                                <option value="{{$i}}" >{{date('h', mktime($i, 0, 0, 0, 0))}}</option>

                            @endfor
                        </select>
                        <p class="m-0 mx-1">:</p>
                        <select class="custom-select col custom-select-sm mins" name="min">
                            @for($i = 0; $i < 61; $i++)

                                <option value="{{$i}}" >{{date('i', mktime(0, $i, 0, 0, 0))}}</option>

                            @endfor
                        </select>

                        <select class="custom-select col custom-select-sm ampm" name="am_pm">

                            <option value="PM">PM</option>
                            <option value="AM">AM</option>
                        </select>
                        <select class="custom-select col custom-select-sm timezones" name="timezone">
                            @foreach(timezone_identifiers_list() as $tz)

                                    <option value="{{$tz}}">{{$tz}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row m-0">
                    <div class='col-6 p-0 pr-1'>

                        <div class="bg-white border p-4">
                            <label>Shipping Address</label>
                            <div class="custom-control custom-radio">
                                <input type="radio" checked id="customRadio1" name="customRadio" class="custom-control-input">
                                <label class="custom-control-label" for="customRadio1">
                                    <p class="small text-muted">{{$request->user()->donors()->first()->shipping_address}}</p>
                                    <p class="small text-muted">{{$request->user()->donors()->first()->shipping_address2}}</p>
                                    <p class="small text-muted">{{$request->user()->donors()->first()->shipping_city}}, {{$request->user()->donors()->first()->shipping_state}}, {{$request->user()->donors()->first()->shipping_zipcode}}</p>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class='col-6 p-0'>

                        <div class="bg-white border p-4">
                            <label>Mailing Address</label>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input">
                                <label class="custom-control-label" for="customRadio1">
                                    <p class="small text-muted">{{$request->user()->donors()->first()->mailing_address}}</p>
                                    <p class="small text-muted">{{$request->user()->donors()->first()->mailing_address2}}</p>
                                    <p class="small text-muted">{{$request->user()->donors()->first()->mailing_city}}, {{$request->user()->donors()->first()->mailing_state}}, {{$request->user()->donors()->first()->mailing_zipcode}}</p>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button class="btn btn-light border font-weight-bold mt-3 btn-block btn-sm py-3">Schedule Pickup</button>
            </div>

        </form>
    </div>
  </div>
  @endif
  <div class="modal fade" id="request-milkkit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog model-center rounded-0 border-0" role="document">
      <div class="modal-content rounded-0 border-0">
        <div class="modal-header bg-white rounded-0 border-bottom-0" style="border-top: #12bdd0 5px solid;">
          <p class="modal-title font-weight-bold " id="exampleModalLabel">How many milk kits would you like?</p>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body p-4 border-right">
            <form action="{{Route('milkkit_send')}}">
                <label>Please enter the quantity of milk kits you would like sent to you?</label>
                <input type="number" name="qty" class="form-control" value="1"/>
                <button class="btn btn-light border py-2 mt-3 btn-block btn-sm small font-weight-bold">REQUEST MILK KIT</button>
            </form>
        </div>

      </div>
    </div>
  </div>
@endif
    <footer class="">
        <div class="footer-top py-2 bg-light border-top border-bottom">
            <div class="container">
                 <ul class="nav ">
                    <!-- Authentication Links -->
                    @guest

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="" href="{{ route('register') }}">{{ __('Become a donor!') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
         <div class="footer-bottom py-2 bg-white">
            <div class="container">
                <p>Copyright ©2019 Ni-Q, LLC. All rights reserved. <strong>HDM Plus™</strong> is a registered trademark of Ni-Q, LLC. <a class="ml-1" href="https://www.ni-q.com/privacy-policy/" hidefocus="true" style="outline: none;">Privacy Policy </a></p>
            </div>
        </div>
    </footer>
    <!-- Scripts -->
    <script src="https://cdn.ckeditor.com/ckeditor5/12.1.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .then( editor => {
            console.log( editor );
        } )
        .catch( error => {
            console.error( error );
        } );
    </script>

    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/site.js') }}" defer></script>


</body>
</html>
