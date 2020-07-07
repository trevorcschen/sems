@extends('layouts.default')

@section('title', $community->name)

@section('subheader', $community->name)
@section('subheader-link', route('home'))

@section('subheader-action', '')

@section('pagevendorsstyles')

@endsection

<style>
    .flip-card {
        background-color: transparent;
        width: 300px;
        height: 300px;
        perspective: 1000px;
    }

    .card-inner {
        position: relative;
        width: 100%;
        height: 100%;
        text-align: center;
        transition: transform 2s;
        /*transform-style: preserve-3d;*/
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
    }

    .flip-card:hover .card-inner {
        transform: rotateY(180deg);

    }

    .card-front, .card-back {
        position: absolute;
        width: 100%;
        height: 100%;
        -webkit-backface-visibility: hidden;
        backface-visibility: hidden;
    }


    .card-front {
        background-color: #bbb;
        color: black;
    }

    .card-back {
        background-color: #2980b9;
        color: white;
        transform: rotateY(180deg);
    }

    .percentageFont {
        position: absolute;
        padding: 0px 3px 10px 10px;
        font-size: 13px;
        margin-top: -5px;
        right: 1px;
    }

    .card-header
    {
        cursor: pointer;
    }


</style>

@section('content')

    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        @if(Session::has('message'))
            <div class="alert alert-success  show" role="alert">
                <div class="alert-icon"><i class="flaticon2-checkmark"></i></div>
                <div class="alert-text">
                    <strong>
                        Well done! {{Session::get('message')}}.
                    </strong>
                    {!! session('success') !!}
                </div>
                <div class="alert-close">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true"><i class="la la-close"></i></span>
                    </button>
                </div>
            </div>
        @endif
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
                                            @if(empty($community->logo_path))
                                            <i class="kt-font-brand flaticon2-line-chart"></i>
                                            @else
                                                <img src="storage/images/community/{{$community->id}}/{{$community->logo_path}}" style="width: 32px;height: 32px;" />
                                            @endif
										</span>
                    <h3 class="kt-portlet__head-title">
                        @yield('subheader')
                    </h3>
                </div>
                @can('event.create')
                    <div class="kt-portlet__head-toolbar">
                        <div class="kt-portlet__head-wrapper">
                            <div class="kt-portlet__head-actions">
                                @can('community.edit')
                                <a href="javascript:void(0)" class="btn btn-brand btn-elevate btn-icon-sm" data-toggle="modal" data-target="#modalCommunity" >
                                    <i class="la la-edit"></i>
                                    Community Details Settings
                                </a>
                                @endcan
                                <a href="javascript:void(0)" style="right: 20px" class="btn btn-brand btn-elevate btn-icon-sm" data-toggle="modal" data-target="#exampleModal" >
                                    <i class="la la-plus"></i>
                                    Event Creation
                                </a>
                            </div>
                        </div>
                    </div>
                @endcan
            </div>
            <div class="kt-portlet__body">
                <ul class="nav">
                    <li class="nav-item ">
                        <a class="nav-link {{$ongoing ? 'disabled' : 'active'}}" href="{{route('commi.community', $community->id)}}">On-going Events</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link {{$past ? 'disabled' : 'active'}}" href="{{route('commi.past.event', $community->id)}}">Past History Events</a>
                    </li>
                </ul>
              <div class="flex-container" style="display: flex;justify-content: center">
                  <div class="flex-event-container" style="flex: 8;margin: 30px;padding: 10px">
                      <div class="sub-flex" style="display: flex;flex-wrap: wrap">

                          @foreach($events as $event)
                          <div class="card text-white bg-primary mb-3 cardEvents" style="max-width: 350px;display: flex;flex-direction: row;margin: 0px 5px 0px 5px;">
                              <div class="card-header" style="background-color: #ff673d;padding: 10px 15px 10px 15px;max-width: 150px" data-id="{{$event->id}}" data-toggle="tooltip" title="Click the panel to view the event's detail" >
                                  <span class="card-title badge badge-pill badge-secondary" style="background-color:#f33dff;color: white" title="Event Tag">Tag#{{$event->eventTag }}</span>
                                  <img src="https://image.flaticon.com/icons/svg/2971/2971373.svg" style="height: 64px;width: 64px;margin: 15px"/>
                                  <p class="card-text">Due  at
                                  <span class="card-title badge badge-pill badge-secondary" style="background-color:#3dc8ff;color: white"> {{date('Y-m-d',(strtotime ( '-1 day' , strtotime ( $event->start_time) ) )) }}</span>
                                  </p>
                              </div>
                              <div class="flip-card">
                                  <div class="card-inner">
                                      <div class="card-body card-front">
                                          <h3 class="card-title" style="text-align: center">{{$event->name}}</h3>
                                          <p class="card-text" style="">{{$event->description}}</p>
                                        @if($event->percentage == 100)
                                              <div class="progress md-progress" style="height: 10px;margin-top: 10px;width:90%;">
                                                  <div class="progress-bar"  role="progressbar" style= "width: {{$event->percentage}}%; height: 10px;rgba(112, 188, 255, 1);color: black;font-size: 14px" aria-valuenow="{{$event->percentage}}" aria-valuemin="0" aria-valuemax="100"></div>

                                            @else
                                              <div class="progress md-progress" style="height: 10px;margin-top: 10px;width:90%;">
                                                  <div class="progress-bar"  role="progressbar" style= "width: {{$event->percentage}}%; height: 10px;background-color: #b0ff57;color: black;font-size: 14px" aria-valuenow="{{$event->percentage}}" aria-valuemin="0" aria-valuemax="100"></div>

                                            @endif
                                                  <span class="percentageFont">{{$event->percentage}}%</span>
                                              </div>
                                          <p class="card-text" >{{$event->current_participants}}/{{$event->max_participants}} Participants</p>
{{--                                                      style="padding: 10px 10px 0px 10px;"--}}
                                      </div>

                                      <div class="card-body card-back">
                                          @if($ongoing && $event->user->id === Auth::user()->id)
                                          <div style="display: flex;flex-direction: column">
                                              <div class="action-bar" style="right: 1px">
                                                  <svg class="bi bi-three-dots-vertical" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg" style="color: black;font-size: 16px;margin-right: 5px">
                                                      <path fill-rule="evenodd" d="M9.5 13a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zm0-5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zm0-5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" clip-rule="evenodd"/>
                                                  </svg>
                                                      <div class="dropdown-menu option-bar">
                                                          <span class="dropdown-item" href="javascript:void(0)">Action</span>
                                                          <div class="dropdown-divider"></div>
                                                          <a class="dropdown-item" data-toggle="modal" data-target="#exampleModal" data-is ="true" data-val="{{$event}}" data-venue="{{$event->venue->name}}" href="javascript:void(0)">Update Event's details</a>
                                                          <div class="dropdown-divider"></div>
                                                          <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal" data-target="#deleteModal" data-del-id ="{{$event->id}}">Update Event's Status</a>
                                                      </div>
                                              </div>
                                          </div>
                                          @endif
                                          @if($event->fee == 0.0)
                                              <h5 class="card-title badge badge-pill badge-secondary" style="background-color:#3dc8ff;color: white;padding: 5px;margin: 5px;margin-top: 20px">Free of Charge (FOC)</h5>
                                          @else
                                              <span>Fee <h5 class="card-title badge badge-pill badge-secondary" style="background-color:#3dc8ff;color: white;padding: 5px;margin: 5px;">RM {{number_format($event->fee, 2)}}</h5> </span> <br/>
                                          @endif
                                          <div>From<h5 class="card-title badge badge-pill badge-secondary" style="background-color:#3dc8ff;color: white;padding: 5px;margin: 5px;">{{date( 'd-m-Y, D ,h:i a', strtotime($event->start_time))}}</h5></div>
                                          <div>
                                              <h6>To</h6><h5 class="card-title badge badge-pill badge-secondary" style="background-color:#3dc8ff;color: white;padding: 5px;margin: 5px;">{{date( 'd-m-Y, D ,h:i a', strtotime($event->end_time))}}</h5></div>
                                          <span>Venue <h5 class="card-title badge badge-pill badge-secondary" style="background-color:#3dc8ff;color: white;padding: 5px;margin: 5px;">{{$event->venue->name}}</h5></span>
                                      </div>

                                      </div>
                              </div>

                          </div>
@endforeach


                      </div>
                  </div>
                  <div class="flex-event-right-container" style="flex: 2;">
                      <div class="card" >
                          <div class="card-body">
                              <h4 class="card-title">Community Admin </h4>
                              <div style="display: flex;flex-direction: row;">
                                  <div class="image-container">
                                      <img src="https://image.flaticon.com/icons/svg/2971/2971373.svg" style="height: 64px;width: 64px;"/>
                                  </div>

                                  <div class="community-details-container" style="margin-left: 10px;margin-top: 5px">
                                      <p class="card-text">{{$community->admin->name}}</p>
                                      <a href="{{route('commi.members', $community)}}" class="card-text">{{ number_format($community->users->count()) }}/{{$community->max_members}} Members</a>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="card" style="margin-top: 20px">
                          <div class="card-body">
                              <h4 class="card-title">Community Description </h4>
                              <p class="card-text">{{substr($community->description, 0, 100)}}
                                  @if(strlen($community->description ) > 100)
                                      <a href="javascript:void(0)" id="dots" style="color: blue;opacity: 1;display: block">Read More</a><span id="more" style="display: none">{{substr($community->description, 100)}}</span></p>
                              @endif
                              <div class="kt-widget__subhead" style="display: flex;justify-content: space-around">
                                  <a href="#" onclick="return false;" title="Created at {{date_format($community->created_at, 'd M Y')}}"><i class="flaticon-calendar" style="padding-right: 10px"></i>{{date_format($community->created_at, 'd M Y')}}</a>
                                  <a href="#" onclick="return false;" title="Updated at {{date_format($community->updated_at, 'd M Y')}}"><i class="flaticon2-pen" style="padding-right: 10px"></i>{{date_format($community->updated_at, 'd M Y')}}</a>
                              </div>

                          </div>
                      </div>
                  </div>

              </div>

            </div>
                <!-- Modal Event -->
                <div class="modal fade" id="exampleModal"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Event Creation</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="alert alert-danger alert-ajax" role="alert" style="display: none">
                                        This is a primary alert—check it out!
                                    </div>
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Event Name:</label>
                                        <input type="text" class="form-control" id="recipient-name">
                                        <div class="invalid-feedback">
                                            Please provide an event name
                                        </div>
                                        <input type="text" class="form-control" id="event-id" hidden>
                                    </div>
                                    <div class="form-group">
                                        <label for="message-text" class="col-form-label">Event Description:</label>
                                        <textarea class="form-control" id="event-description" name="event-description" maxlength="150"></textarea>
                                        <div class="invalid-feedback">
                                            Please provide an event description
                                        </div>
                                    </div>
                                        <div class="form-group">
                                            <label for="message-text" class="col-form-label">Event Start Date:</label>
                                            <div class="input-group">
                                                <input type='text' class="form-control" id='datetimepicker4' autocomplete="off" readonly />
                                                <label class="input-group-text" for="datetimepicker4">
                                                            <span class="glyphicon glyphicon-calendar"></span>
                                                        </label>
                                            </div>
                                            <div class="invalid-feedback">
                                                Please provide an appropriate starting date of event
                                            </div>

                                        </div>
                                    <div class="form-group">
                                            <label for="message-text" class="col-form-label">Event End Date:</label>
                                        <div class="input-group">

                                        <input type='text' class="form-control" id='datetimepicker3' autocomplete="off" readonly />
                                        <label class="input-group-text" for="datetimepicker3">
                                                            <span class="glyphicon glyphicon-calendar"></span>
                                                        </label>
                                        </div>
                                        <div class="invalid-feedback">
                                            Please provide an appropriate ending date of event
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <label for="message-text" class="col-form-label">Event Fee : </label>
                                        <input class="form-control @error('max_members') is-invalid @enderror" type="number" name="fees" value="{{ old('max_members') }}" id="fee">
                                        <div class="invalid-feedback">
                                            Please provide an appropriate event fee, (min : 0.00)
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="message-text" class="col-form-label">Maximum Participants :</label>
                                        <input class="form-control @error('max_members') is-invalid @enderror" type="number" name="max_members" value="{{ old('max_members') }}" id="max_members">
                                        <div class="invalid-feedback">
                                            Please provide an appropriate number of participants
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Venue</label>
                                        <br/>
                                        <select class="form-control js-data-example-ajax" id="venue">
                                            <option></option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Please provide an venue for the event
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label">Event Image : </label>
                                        <div class="custom-file input-group" id="eventProps">
                                            <input type="file" class="custom-file-input image-picker" id="inputGroupFile01"
                                                   aria-describedby="inputGroupFileAddon01">
                                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                        </div>
                                        <div class="invalid-feedback">
                                            Please provide an image for the event
                                        </div>
                                    </div>
                                    <div class="ml-2 col-sm-6" style="padding: 10px;">
                                        <img src="https://placehold.it/80x80" id="preview" class="img-thumbnail" style="display: none">
                                    </div>

                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">CREATE</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Coommunity -->
                <div class="modal fade" id="modalCommunity" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Community Details  </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Community Name:</label>
                                        <input type="text" class="form-control" id="recipient-name" disabled value="{{$community->name}}">
                                        <input type="text" value="{{$community->id}}" name="community_id"  hidden />
                                    </div>
                                    <div class="form-group">
                                        <label for="message-text" class="col-form-label">Community Description:</label>
                                        <textarea class="form-control" id="message-text" name="community_description" maxlength="255">{{$community->description}}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="message-text" class="col-form-label">Membership Fee : </label>
                                        <input class="form-control @error('max_members') is-invalid @enderror" type="number" name="community_fees" value="{{number_format($community->fee, 2)}}">
                                        @error('max_members')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="message-text" class="col-form-label">Maximum Participants :</label>
                                        <input class="form-control @error('max_members') is-invalid @enderror" type="number" name="community_max_members" value="{{$community->max_members }}">
                                        @error('max_members')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label">Community Icon : </label>
                                        <div class="custom-file input-group" id="communityProps">
                                            <input type="file" class="custom-file-input image-picker" id="inputGroupFile01" name="image_community"
                                                   aria-describedby="inputGroupFileAddon01">
                                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                        </div>
                                    </div>
                                    <div class="ml-2 col-sm-6" style="padding: 10px;">
                                        <img src="https://placehold.it/80x80" id="previewEdit" class="img-thumbnail" style="display: none">
                                    </div>

                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary updateCommunityModal">UPDATE</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal Delete -->

                <div class="modal fade" id="deleteModal" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel">Confirmation</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Are you sure to delete this event?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-danger delCommunityModal">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>

            <div class="kt-pagination__links kt-pagination" style="padding: 40px;">
                {{$events->links()}}
                Displaying {{$events->count()}} of {{$count}}
            </div>

        </div>
    </div>
@endsection
{{--        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>--}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.15/lodash.min.js"></script>


    <script type="text/javascript">

        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();

            $(".card-header").on('click', function(e)
            {
                console.log($(this).data("id"))
                let url = '{{route('event.show', ':ids')}}';
                url = url.replace(':ids', $(this).data("id"));
                location.href = url;
            });

            $(document).on('click', "button.eventCreate", function(e)
            {
                const validationCode = ["Please provide an appropriate ending date of event", "Please change the ending date of event in which after start date", "The event only occur for a single day. Please change em"];
                for(var i = 0 ; i< document.querySelectorAll(".invalid-feedback").length; i++)
                {
                    document.querySelectorAll(".invalid-feedback")[i].style.display = 'none';

                }
                document.querySelector('.alert-ajax').style.display = 'none';

                var eventName = document.getElementById('recipient-name');
                var eventDescription = document.querySelector('textarea[name="event-description"]');
                var eventDate1 = document.querySelector('input[id="datetimepicker4"]');
                var eventDate2 = document.querySelector('input[id="datetimepicker3"]');
                var eventFee = document.querySelector('input[id="fee"]');
                var eventMembers = document.querySelector('input[id="max_members"]');
                var selectElement = document.querySelector('select[id="venue"]');
                var imageURL = document.getElementById("preview");

                if(eventName.value === null || eventName.value === '')
                {
                    document.querySelectorAll(".invalid-feedback")[0].style.display = 'block';
                }
                if(eventDescription.value === null || eventDescription.value === '')
                {
                    document.querySelectorAll(".invalid-feedback")[1].style.display = 'block';
                }
                if(eventDate1.value === '' || eventDate1.value === null)
                {
                    document.querySelectorAll(".invalid-feedback")[2].style.display = 'block';
                }

                if(eventFee.value <0 ||eventFee.value === '')
                {
                    document.querySelectorAll(".invalid-feedback")[4].style.display = 'block';

                }
                if(eventMembers.value<=0 ||eventMembers.value === '')
                {
                    document.querySelectorAll(".invalid-feedback")[5].style.display = 'block';
                }
                if(selectElement.options[selectElement.selectedIndex].value === '' || selectElement.options[selectElement.selectedIndex].value === null)
                {
                    document.querySelectorAll(".invalid-feedback")[6].style.display = 'block';
                }
                if(!imageURL.src.includes('base64'))
                {
                    document.querySelectorAll(".invalid-feedback")[7].style.display = 'block';
                }
                if(eventDate2.value === '' || eventDate2.value === null)
                {
                    document.querySelectorAll(".invalid-feedback")[3].style.display = 'block';
                    document.querySelectorAll(".invalid-feedback")[3].textContent =  validationCode[0];
                    return;
                }
                if(moment(eventDate2.value).isSameOrBefore(eventDate1.value))
                {
                    document.querySelectorAll(".invalid-feedback")[3].style.display = 'block';
                    document.querySelectorAll(".invalid-feedback")[3].textContent =  validationCode[1];
                }
                if(! moment(eventDate2.value.substring(0,10)).isSame(eventDate1.value.substring(0,10)))
                {
                    document.querySelectorAll(".invalid-feedback")[3].style.display = 'block';
                    document.querySelectorAll(".invalid-feedback")[3].textContent =  validationCode[2];
                }

                var anyError = false;
                _.forEach(document.querySelectorAll(".invalid-feedback"), (item, index) =>
                {
                    (item.computedStyleMap().get('display').value === 'block') ? anyError = true : null
                });
                if(anyError)
                {
                    return;
                }

                console.log('errorless ')
                console.log({{Session::get('communityID')}})
                $.ajax(
                    {
                        url: "{{route('event.ajax.create')}}",
                        type: "POST",
                        data:
                            {
                                description : eventDescription.value,
                                name: eventName.value,
                                venueID: selectElement.options[selectElement.selectedIndex].value ,
                                startDate: eventDate1.value,
                                endDate: eventDate2.value,
                                max_participants: eventMembers.value,
                                fees: eventFee.value,
                                communityID : "{{Session::get('communityID')}}",
                                base64URL : imageURL.src,
                            },
                        dataType: 'json',
                        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                        success: function (data, text, xhr) {

                            console.log(data)
                            if(data.status === "1")
                            {
                                if(data.errorFound)
                                {
                                    document.querySelector('.alert-ajax').style.display = 'block';
                                    document.querySelector('.alert-ajax').textContent = 'ERROR!! Please select other venue or time';
                                    return;
                                }
                                location.reload()
                            }
                            // else
                            // {
                            //     console.log('false');
                            //     document.querySelector('.alert-ajax').style.display = 'block';
                            //     document.querySelector('.alert-ajax').textContent = 'ERROR!! No Columns have been changed';
                            // }

                        },
                        error: function (jqXHR, textStatus, errorThrown) {

                        }
                    });

            });

            $(document).on('click', "button.eventUpdate", function(e)
            {
                for(var i = 0 ; i< document.querySelectorAll(".invalid-feedback").length; i++)
                {
                    document.querySelectorAll(".invalid-feedback")[i].style.display = 'none';

                }
                document.querySelector('.alert-ajax').style.display = 'none';

                var eventName = document.getElementById('recipient-name');
                var eventDescription = document.querySelector('textarea[name="event-description"]');
                var eventID = document.querySelector('input[id="event-id"]');
                var eventDate1 = document.querySelector('input[id="datetimepicker4"]');
                var eventDate2 = document.querySelector('input[id="datetimepicker3"]');
                var selectElement = document.querySelector('select[id="venue"]');
                var imageURL = document.getElementById("preview");
                // console.log(eventName.value);
                // console.log(eventDescription.value);
                // console.log(eventDate1.value);
                // console.log(eventDate2.value);
                // console.log(selectElement.selectedIndex)
                console.log(selectElement.options[selectElement.selectedIndex].value);
                // console.log(selectElement.options[selectElement.selectedIndex].textContent);

                if(eventName.value === null || eventName.value === '')
                {
                    document.querySelectorAll(".invalid-feedback")[0].style.display = 'block';
                }
                if(eventDescription.value === null || eventDescription.value === '')
                {
                    document.querySelectorAll(".invalid-feedback")[1].style.display = 'block';
                }
                if(moment(eventDate2.value).isSameOrBefore(eventDate1.value))
                {
                    document.querySelectorAll(".invalid-feedback")[3].style.display = 'block';
                }
                if(selectElement.options[selectElement.selectedIndex].value === '' || selectElement.options[selectElement.selectedIndex].value === null)
                {
                    document.querySelectorAll(".invalid-feedback")[6].style.display = 'block';
                }

                var elementStyle = document.querySelectorAll(".invalid-feedback")[0];
                var anyError = false;
                _.forEach(document.querySelectorAll(".invalid-feedback"), (item, index) =>
                {
                    (item.computedStyleMap().get('display').value === 'block') ? anyError = true : null
                });
                if(anyError)
                {
                    console.log(anyError);
                    return;
                }

                // console.log(elementStyle.computedStyleMap().get('display'));
                // console.log(imageURL.src);
                // console.log(!!imageURL.src.includes('base64'))

                $.ajax(
                    {
                        url: "{{route('event.ajax.update')}}",
                        type: "POST",
                        data : {
                            base64URL : imageURL.src,
                            id : eventID.value,
                            description : eventDescription.value,
                            name: eventName.value,
                            startDate: eventDate1.value,
                            endDate: eventDate2.value,
                            venueID :selectElement.options[selectElement.selectedIndex].value ,
                            isNewImage: !!imageURL.src.includes('base64') // !!true => true / !!false => false
                        },
                        dataType: 'json',
                        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                        success: function (data, text, xhr) {
                            console.log('ajax')
                            if(data.status === "1")
                            {
                                if(data.errorFound)
                                {
                                    document.querySelector('.alert-ajax').style.display = 'block';
                                    document.querySelector('.alert-ajax').textContent = 'ERROR!! Please select other venue or time';
                                    return;
                                }
                                location.reload()

                            }
                            else
                            {
                                console.log('false');
                                document.querySelector('.alert-ajax').style.display = 'block';
                                document.querySelector('.alert-ajax').textContent = 'ERROR!! No Columns have been changed';
                            }

                        },
                        error: function (jqXHR, textStatus, errorThrown) {

                        }
                    });


                // console.log($(".js-data-example-ajax :selected").text())
            });



            $('.js-data-example-ajax').select2({
                placeholder : 'Venue',
                width: '200px',
                allowClear: true,
                minimumInputLength : 3,
                ajax: {
                    url: "{{route('ajax.venues.search')}}",
                    dataType: 'json',
                    method: 'POST',
                    headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                    delay: 250,
                    data: function(e) {
                        return {
                            q: e.term,
                            page: e.page,
                        }
                    },
                    processResults: function(e, t) {
                        return t.page = t.page || 1, {
                            results:  $.map(e.data, function (item) {
                                return {
                                    id: item.id,
                                    text: item.name,
                                }
                            }),
                            pagination: {
                                more: 5 * t.page < e.total
                            }
                        }
                    },
                    cache: !0
                },
            });
            $('#datetimepicker3, #datetimepicker4').on("show", function(e){
                e.preventDefault();
                e.stopPropagation();
            }).on("hide", function(e){
                e.preventDefault();
                e.stopPropagation();
            });
            $('#datetimepicker3, #datetimepicker4').datetimepicker(      {
                // startDate: new Date(),
                autoclose: true,
                disableTouchKeyboard : true,
                keyboardNavigation : false,
                format : "yyyy-mm-dd hh:ii",
                minuteStep : 15
            });

            $(".action-bar").css('position', 'absolute');
            $(".action-bar").hover(function()
            {
               $(".option-bar").addClass('show');
               $(".show").css('position', 'fixed')
               $(".show").css('top', '0')
               $(".show").css('will-change', 'transform')
               $(".show").css('transform', 'translate3d(0px,16px,0px)')
               $(".show").css('left', '34')

            }, function()
            {
                $(".option-bar").removeClass('show')
            });


            setTimeout(function()
            {
                $(".card-inner").css("transform-style", "preserve-3d");
            }, 50);

            $("#dots").click(function(){
                $(this).hide();
                $("#more").show();
                console.log('d');
            });

            $('input[type="file"]').change(function(e) {
                var fileName = e.target.files[0].name;
                if(!e.target.files[0].name.match(/.(jpg|jpeg|png|gif)$/i))
                {
                    alert("Not an image!!")
                    $(".image-picker").reset();
                    return;
                }
                var parentProp = $(this).parent();

                // console.log(parentProp.prop('id'));
                parentProp.prop('id') === 'eventProps' ? $("#preview").css("display", "block") : $("#previewEdit").css("display", "block");
                // $("#preview").css("display", "block");

                console.log(fileName)
                $("#file").val(fileName);

                var reader = new FileReader();
                reader.onload = function(e) {
                    // get loaded data and render thumbnail.
                    document.getElementById(parentProp.prop('id') === 'eventProps' ? "preview" : "previewEdit").src = e.target.result;
                };
                // read the image file as a data URL.
                reader.readAsDataURL(this.files[0]);
            });

            $('#deleteModal').on('show.bs.modal', function (event)
            {
                console.log($(event.relatedTarget).data('del-id'))
                $(".delCommunityModal").click(function()
                {
                    console.log('delete this id' + $(event.relatedTarget).data('del-id'))
                    $.ajax(
                        {
                            url: "{{route('event.ajax.delete')}}",
                            type: "POST",
                            data: {
                                id : $(event.relatedTarget).data('del-id'),
                            },
                            dataType: 'json',
                            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                            success: function (data, text, xhr) {
                                console.log(data)
                                location.reload();

                            },
                            error: function (jqXHR, textStatus, errorThrown) {

                            }
                        });
                });

            });

            $('#exampleModal').on('hidden.bs.modal', function(event)
            {
                for(var i = 0 ; i< document.querySelectorAll(".invalid-feedback").length; i++)
                {
                    document.querySelectorAll(".invalid-feedback")[i].style.display = 'none';

                }
                document.querySelector('.alert-ajax').style.display = 'none';

                $(this).find(".modal-body").find("input ,textarea").val('');
                $('.js-data-example-ajax').empty()
                var imgSrc = document.querySelector('#preview');
                imgSrc.style.display = "none";
                imgSrc.src = ' ';
                var imageLabel = document.querySelector('.custom-file-label');
                imageLabel.classList.remove('selected');
                imageLabel.innerHTML = 'Choose File';
                $(this).find(".modal-body").find("#fee").removeAttr('disabled');
                $(this).find(".modal-body").find("#max_members").removeAttr('disabled');
                $classBtn = $(this).find('.modal-footer').find('.btn-primary');
                $classBtn[0].className = $classBtn[0].className.replace(/\bevent.*?\b/g, '')

            });
            $('#modalCommunity').on('hidden.bs.modal', function(event)
            {
                var imgSrc = document.querySelector('#previewEdit');
                imgSrc.style.display = "none";
                imgSrc.src = ' ';
                var imageLabel = document.querySelectorAll('.custom-file-label')[1];
                imageLabel.classList.remove('selected');
                imageLabel.innerHTML = 'Choose File';
            })


            $('#exampleModal').on('show.bs.modal', function (event) {
                $eventChange = $(event.relatedTarget).data('is');
                console.log('stil lshow')
                if(typeof $eventChange == "undefined")
                {
                    console.log("creation");
                    $(this).find(".modal-title").text("Event Creation :");
                    $(this).find('.modal-footer').find('.btn-primary').addClass('eventCreate');
                    return;
                }
                var myVal = $(event.relatedTarget).data('val')
                $venue = $(event.relatedTarget).data('venue');
                $(this).find(".modal-title").text('Event Update :');
                $(this).find(".modal-body").find("#recipient-name").val(myVal.name);
                $(this).find(".modal-body").find("#event-id").val(myVal.id);
                $(this).find(".modal-body").find("#event-description").val(myVal.description);
                $(this).find(".modal-body").find("#datetimepicker4").val(myVal.start_time);
                $(this).find(".modal-body").find("#datetimepicker3").val(myVal.end_time);
                $(this).find(".modal-body").find("#fee").val(myVal.fee.toFixed(2));
                $(this).find(".modal-body").find("#max_members").val(myVal.max_participants);
                var newOption = new Option($venue, myVal.venue_id, true, true);
                $(".js-data-example-ajax").append(newOption).trigger('change')

                $(this).find(".modal-body").find("#fee").attr('disabled', 'true');
                $(this).find(".modal-body").find("#max_members").attr('disabled', 'true');
                $(this).find('.modal-footer').find('.btn-primary').addClass('eventUpdate');
                $(this).find('.modal-footer').find('.btn-primary').html('UPDATE');

                // $(this).find(".modal-body").find("#venue").val('dsa');
                // $(this).find(".modal-body").find("#venue").html('<option></option>')
            });
            var substringTest = function (str) {
                return str.substring(str.lastIndexOf('\\')+1);
            };
            $(".updateCommunityModal").click(function()
            {
                var description = document.querySelector('textarea[name="community_description"]');
                var max_mem = document.querySelector('input[name="community_max_members"]');
                var fees = document.querySelector('input[name="community_fees"]');
                var com_id = document.querySelector('input[name="community_id"]');

                description.classList.remove('is-invalid');
                max_mem.classList.remove('is-invalid');
                fees.classList.remove('is-invalid');

                // console.log(description.value);
                // console.log(max_mem.value);
                // console.log(fees.value);
                var imageSelector = document.querySelector('input[name="image_community"]');
                var imageURL = document.getElementById("previewEdit");
                // console.log(imageURL.src)
                // console.log(substringTest(imageSelector.value))
                if(description.value.trim().length  === 0)
                {
                    description.classList.add('is-invalid')
                    return;
                }
                else if(fees.value.trim().length  === 0)
                {
                    fees.classList.add('is-invalid')
                    return;
                }
                else if(max_mem.value.trim().length === 0 )
                {
                    max_mem.classList.add('is-invalid')
                    return;
                }

                $.ajax(
                    {
                        url: "{{route('commi.ajax.update.community')}}",
                        type: "POST",
                        data : {
                          base64URL : imageURL.src,
                            id : com_id.value,
                            description : description.value,
                            max_mem: max_mem.value,
                            fees: fees.value,
                            isNewImage: !!imageURL.src.includes('base64') // !!true => true / !!false => false
                        },
                        dataType: 'json',
                        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                        success: function (data, text, xhr) {
                                if(data.status === "1")
                                {
                                    console.log(data)
                                    location.reload()

                                }
                                else
                                {
                                    console.log('false')
                                }

                        },
                        error: function (jqXHR, textStatus, errorThrown) {

                        }
                    });
                console.log('here on clicked')
            })
        });

    </script>


    </div>
