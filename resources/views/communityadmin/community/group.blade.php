@extends('layouts.default')

@section('title', 'Home')

@section('subheader', 'Home')
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
        transition: transform 0.6s;
        transform-style: preserve-3d;
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
</style>

@section('content')

    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-line-chart"></i>
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
                          <div class="card text-white bg-primary mb-3" style="max-width: 400px;display: flex;flex-direction: row">
                              <div class="card-header" style="background-color: #ff673d">
                                  <h5 class="card-title badge badge-pill badge-secondary" style="background-color:#3dc8ff;color: white">Community Admin</h5>
                                  <img src="https://image.flaticon.com/icons/svg/2971/2971373.svg" style="height: 64px;width: 64px;margin: 15px"/>
                                  <p class="card-text">Due Date :
                                  <h5 class="card-title badge badge-pill badge-secondary" style="background-color:#3dc8ff;color: white"> 2020-02-01 23:59:59</h5>
                                  </p>
                              </div>
                              <div class="flip-card">
                                  <div class="card-inner">
                                      <div class="card-body card-front">
                                          <h3 class="card-title" style="text-align: center">Event Name</h3>
                                          <p class="card-text">Event Description  Lorem Ipsum is simply dummy text of the printing and typesetting industry.  versions of Lorem Ipsum.</p>

                                          <div class="progress md-progress" style="height: 30px;margin-top: 10px;">
                                              <div class="progress-bar"  role="progressbar" style="width: 25%; height: 30px;background-color: #b0ff57;color: black;font-size: 14px" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>

                                          </div>
                                          <p class="card-text" style="padding: 10px 10px 0px 10px;">25/50 Participants</p>
                                          <span class="axx">dsasda</span>

                                      </div>

                                      <div class="card-body card-back">
                                          <h3 class="card-title" style="text-align: center">Event Ndsaame</h3>
                                          <p class="card-text">Event Descadssadription  Lorem Ipsum is simply dummy text of the printing and typesetting industry.  versions of Lorem Ipsum.</p>

                                          <div class="progress md-progress" style="height: 30px;margin-top: 10px;">
                                              <div class="progress-bar"  role="progressbar" style="width: 25%; height: 30px;background-color: #b0ff57;color: black;font-size: 14px" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>

                                          </div>
                                          <p class="card-text" style="padding: 10px 10px 0px 10px;">25/50 Participants</p>
                                          <span class="axx">dsasda</span>

                                      </div>
                                  </div>
                              </div>

                          </div><div class="card text-white bg-primary mb-3" style="max-width: 400px;display: flex;flex-direction: row">
                              <div class="card-header" style="background-color: #ff673d">
                                  <h5 class="card-title badge badge-pill badge-secondary" style="background-color:#3dc8ff;color: white">Community Admin</h5>
                                  <img src="https://image.flaticon.com/icons/svg/2971/2971373.svg" style="height: 64px;width: 64px;margin: 15px"/>
                                  <p class="card-text">Due Date :
                                  <h5 class="card-title badge badge-pill badge-secondary" style="background-color:#3dc8ff;color: white"> 2020-02-01 23:59:59</h5>
                                  </p>
                              </div>
                              <div class="flip-card">
                                  <div class="card-inner">
                                      <div class="card-body card-front">
                                          <h3 class="card-title" style="text-align: center">Event Name</h3>
                                          <p class="card-text">Event Description  Lorem Ipsum is simply dummy text of the printing and typesetting industry.  versions of Lorem Ipsum.</p>

                                          <div class="progress md-progress" style="height: 30px;margin-top: 10px;">
                                              <div class="progress-bar"  role="progressbar" style="width: 25%; height: 30px;background-color: #b0ff57;color: black;font-size: 14px" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>

                                          </div>
                                          <p class="card-text" style="padding: 10px 10px 0px 10px;">25/50 Participants</p>
                                          <span class="axx">dsasda</span>

                                      </div>

                                      <div class="card-body card-back">
                                          <h3 class="card-title" style="text-align: center">Event Ndsaame</h3>
                                          <p class="card-text">Event Descadssadription  Lorem Ipsum is simply dummy text of the printing and typesetting industry.  versions of Lorem Ipsum.</p>

                                          <div class="progress md-progress" style="height: 30px;margin-top: 10px;">
                                              <div class="progress-bar"  role="progressbar" style="width: 25%; height: 30px;background-color: #b0ff57;color: black;font-size: 14px" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>

                                          </div>
                                          <p class="card-text" style="padding: 10px 10px 0px 10px;">25/50 Participants</p>
                                          <span class="axx">dsasda</span>

                                      </div>
                                  </div>
                              </div>

                          </div>


{{--                          @foreach($events as $event)--}}
{{--                              <div class="card" style="margin-right: 10px;margin-top: 10px">--}}
{{--                                  <div class="card-body">--}}
{{--                                      <h4 class="card-title">Community Admin </h4>--}}
{{--                                      <div style="display: flex;flex-direction: row;">--}}
{{--                                          <div class="image-container">--}}
{{--                                              <img src="https://image.flaticon.com/icons/svg/2971/2971373.svg" style="height: 64px;width: 64px;"/>--}}
{{--                                          </div>--}}

{{--                                          <div class="community-details-container" style="margin-left: 10px;margin-top: 5px">--}}
{{--                                              <p class="card-text">Somebody Name</p>--}}
{{--                                              <p class="card-text">{{$event->current_participants}}/{{$event->max_participants}} Members</p>--}}
{{--                                          </div>--}}
{{--                                      </div>--}}

{{--                                      @if($event->percentage == 100)--}}
{{--                                          <div class="progress md-progress" style="height: 20px;margin-top: 10px;">--}}
{{--                                              <div class="progress-bar"  role="progressbar" style="width: {{$event->percentage}}%; height: 20px;background-color: #b0ff57;opacity: .3" aria-valuenow="{{$event->percentage}}" aria-valuemin="0" aria-valuemax="100">{{$event->percentage}}%</div>--}}
{{--                                          </div>--}}
{{--                                          @else--}}
{{--                                          <div class="progress md-progress" style="height: 20px;margin-top: 10px;">--}}
{{--                                              <div class="progress-bar"  role="progressbar" style="width: {{$event->percentage}}%; height: 20px" aria-valuenow="{{$event->percentage}}" aria-valuemin="0" aria-valuemax="100">{{$event->percentage}}%</div>--}}
{{--                                          </div>--}}
{{--                                          @endif--}}
{{--                                      <div class="link-container" style="margin-top:  10px;">--}}
{{--                                          <a href="#" class="card-link">Card link</a>--}}
{{--                                          <a href="#" class="card-link">Another link</a>--}}
{{--                                      </div>--}}
{{--                                  </div>--}}
{{--                              </div>--}}
{{--                              @endforeach--}}



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
                                      <p class="card-text">Somebody Name</p>
                                      <p class="card-text">50/200 Members</p>
                                  </div>
                              </div>
                                <div class="link-container" style="margin-top:  10px;">
                                    <a href="#" class="card-link">Card link</a>
                                    <a href="#" class="card-link">Another link</a>
                                </div>
                          </div>
                      </div>
                      <div class="card" style="margin-top: 20px">
                          <div class="card-body">
                              <h4 class="card-title">Community Description </h4>
                              <p class="card-text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. <a href="javascript:void(0)" id="dots" style="color: blue;opacity: 1;display: block">Read More</a><span id="more" style="display: none">Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span></p>
                              <h4 class="card-title">Community Creation Date </h4>
                              <p class="card-text">2018-08-22 </p>
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
