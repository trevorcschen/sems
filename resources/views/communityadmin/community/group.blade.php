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
</style>

@section('content')

    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
                                            @if(empty($community->logo_path))
                                            <i class="kt-font-brand flaticon2-line-chart"></i>
                                            @else
                                                <img src="{{$community->logo_path}}" style="width: 32px;height: 32px;" />

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
                                <a href="{{ route('communities.create') }}" class="btn btn-brand btn-elevate btn-icon-sm">
                                    <i class="la la-plus"></i>
                                    Event Creation
                                </a>
                            </div>
                        </div>
                    </div>
                @endcan
            </div>
            <div class="kt-portlet__body">
              <div class="flex-container" style="display: flex;justify-content: center">
                  <div class="flex-event-container" style="flex: 8;margin: 30px;padding: 10px">
                      <div class="sub-flex" style="display: flex;flex-wrap: wrap">

                          @foreach($events as $event)
                          <div class="card text-white bg-primary mb-3" style="max-width: 350px;display: flex;flex-direction: row;margin: 0px 5px 0px 5px;">
                              <div class="card-header" style="background-color: #ff673d;padding: 10px 15px 10px 15px;max-width: 150px">
{{--                                  <h5 class="card-title badge badge-pill badge-secondary" style="background-color:#3dc8ff;color: white">Community Admin</h5>--}}
                                  <h5>Organized By
                                      <span class="kt-badge kt-badge--inline kt-badge--pill" style="background-color: rgba(83, 161, 243, 0.92);font-weight: lighter;margin-top:10px">Computer Science Societies</span>
                                      <span class="badge badge-pill badge" style="background-color:#3dc8ff;color: white"></span>
                                  </h5>
                                  <img src="https://image.flaticon.com/icons/svg/2971/2971373.svg" style="height: 64px;width: 64px;margin: 15px"/>
                                  <p class="card-text">Due Date :
                                  <span class="card-title badge badge-pill badge-secondary" style="background-color:#3dc8ff;color: white"> 2020-02-01 23:59:59</span>
                                  </p>
                              </div>
                              <div class="flip-card">
                                  <div class="card-inner">
                                      <div class="card-body card-front">
                                          <h3 class="card-title" style="text-align: center">{{$event->name}}</h3>
                                          <p class="card-text" style="padding: 10px">{{$event->description}}</p>
                                        @if($event->percentage == 100)
                                              <div class="progress md-progress" style="height: 10px;margin-top: 10px;width:90%;">
                                                  <div class="progress-bar"  role="progressbar" style= "width: {{$event->percentage}}%; height: 10px;rgba(112, 188, 255, 1);color: black;font-size: 14px" aria-valuenow="{{$event->percentage}}" aria-valuemin="0" aria-valuemax="100"></div>

                                            @else
                                              <div class="progress md-progress" style="height: 10px;margin-top: 10px;width:90%;">
                                                  <div class="progress-bar"  role="progressbar" style= "width: {{$event->percentage}}%; height: 10px;background-color: #b0ff57;color: black;font-size: 14px" aria-valuenow="{{$event->percentage}}" aria-valuemin="0" aria-valuemax="100"></div>

                                            @endif
                                                  <span class="percentageFont">{{$event->percentage}}%</span>
                                              </div>
                                          <p class="card-text" style="padding: 10px 10px 0px 10px;">{{$event->current_participants}}/{{$event->max_participants}} Participants</p>
                                      </div>

                                      <div class="card-body card-back">
                                          <div style="display: flex;flex-direction: column">
                                              <div style="padding: 0px 24px 0px 24px">
                                                  <span style="text-align: center;width: 10px">{{$event->name}}dsadsaadsasddas</span>
                                              </div>
                                              <div class="action-bar" style="right: 1px">
                                                  <svg class="bi bi-three-dots-vertical" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg" style="color: black;font-size: 16px;margin-right: 5px">
                                                      <path fill-rule="evenodd" d="M9.5 13a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zm0-5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zm0-5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" clip-rule="evenodd"/>
                                                  </svg>
                                                  <div class="dropdown-menu option-bar">
                                                      <span class="dropdown-item" href="javascript:void(0)">Action</span>
                                                      <div class="dropdown-divider"></div>
                                                      <a class="dropdown-item" href="javascript:void(0)">Update Event's details</a>
                                                      <div class="dropdown-divider"></div>
                                                      <a class="dropdown-item" href="javascript:void(0)">Update Event's Status</a>
                                                  </div>
                                              </div>

                                          </div>


                                                                           @if($event->fee == 0.0)
                                              <h5 class="card-title badge badge-pill badge-secondary" style="background-color:#3dc8ff;color: white;padding: 5px;margin: 5px;">Free of Charge (FOC)</h5>
                                          @else
                                              <span>Fee <h5 class="card-title badge badge-pill badge-secondary" style="background-color:#3dc8ff;color: white;padding: 5px;margin: 5px;">RM {{number_format($event->fee, 2)}}</h5> </span> <br/>
                                          @endif
                                          <span>From<h5 class="card-title badge badge-pill badge-secondary" style="background-color:#3dc8ff;color: white;padding: 5px;margin: 5px;">{{date( 'd-m-Y, D ,h:i a', strtotime($event->start_time))}}</h5></span>
                                          <br />
                                          <span>To<h5 class="card-title badge badge-pill badge-secondary" style="background-color:#3dc8ff;color: white;padding: 5px;margin: 5px;">{{date( 'd-m-Y, D ,h:i a', strtotime($event->end_time))}}</h5></span>
                                          <span>Venue <h5 class="card-title badge badge-pill badge-secondary" style="background-color:#3dc8ff;color: white;padding: 5px;margin: 5px;">{{$event->venue->name}}</h5></span>

                                          <div style="display: flex;padding: 10px;">
                                              <button type="button" class="btn-primary btn-sm">Interested</button>
                                              <button type="button" class="btn-block btn-label-twitter-o2">Join</button>
                                          </div>
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
                                      <p class="card-text">50/{{$community->max_members}} Members</p>
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
                              <h4 class="card-title">Community Creation Date </h4>
                              <span class="kt-badge kt-badge--inline kt-badge--pill" style="background-color: rgba(83, 161, 243, 0.92);font-weight: lighter;margin-top:10px;color: white">{{date_format($community->created_at, 'd M Y')}}</span>

                          </div>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>

    <script type="text/javascript">

        $(document).ready(function(){
            $(".action-bar").css('position', 'absolute');
            $(".action-bar").hover(function()
            {
               $(".option-bar").addClass('show');
               $(".show").css('position', 'fixed')
               $(".show").css('top', '0')
               $(".show").css('will-change', 'transform')
               $(".show").css('transform', 'translate3d(0px,16px,0px)')
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

            // $(".hideID").hover(function()
            // {
            //    // $(this).hide();
            //    $(this).css('display', 'none');
            //    $(this).next().css('display', 'block');
            //    $(this).next().css('transition','transform 0.3s, opacity 0.3s')
            // }, function()
            // {
            //     // $(this).show();
            //     $(this).css('display', 'block');
            //     $(this).next().css('display', 'none');
            //
            //
            // });
        });

    </script>
