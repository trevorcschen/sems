@extends('layouts.default')

@section('title', 'Home')

@section('subheader', 'Home')
@section('subheader-link', route('home'))

@section('subheader-action', '')

@section('pagevendorsstyles')
@endsection

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
                  <div class="flex-event-container" style="flex: 8;background: red;margin: 30px;padding: 10px">
                      <div class="sub-flex" style="display: flex;flex-wrap: wrap">
                          <?php $i = 61?>
                          @for($x = 0;$x<$i;$x++)
                                  <div class="card" style="margin-right: 10px;margin-top: 10px">
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
                              @endfor


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
        });

    </script>
