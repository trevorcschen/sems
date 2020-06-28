<script>
    var KTAppOptions = {
        "colors": {
            "state": {
                "brand": "#5d78ff",
                "dark": "#282a3c",
                "light": "#ffffff",
                "primary": "#5867dd",
                "success": "#34bfa3",
                "info": "#36a3f7",
                "warning": "#ffb822",
                "danger": "#fd3995"
            },
            "base": {
                "label": [
                    "#c5cbe3",
                    "#a1a8c3",
                    "#3d4465",
                    "#3e4466"
                ],
                "shape": [
                    "#f0f3ff",
                    "#d9dffa",
                    "#afb4d4",
                    "#646c9a"
                ]
            }
        }
    };
</script>
<script src="https://js.pusher.com/6.0/pusher.min.js"></script>

<script >

        const authAPI = {!! json_encode($authAPIKEY) !!}
        console.log(authAPI)
        const std = {!! json_encode($student_channels) !!};
        std.push(`student-channel_${authAPI}`);
        console.log(std)
        Pusher.logToConsole = true;

    var pusher = new Pusher('e204c5a4177ff320ec30', {
        cluster: 'ap1'
    });

    var channels = null;
    // if(Math.floor(Math.random() * 2) === 0)
    // {
    //     console.log('user type 0 ')
    channels = std.map(channelName => pusher.subscribe(channelName));

    // }
    // else
    // {
    //     console.log('user type 1')
    //     channels = ['student-channel_9054329', 'community-channel_club-freedom'].map(channelName => pusher.subscribe(channelName));
    //
    // }

    for (const channel of channels)
    {
        channel.bind('form-submitted', function(data)
        {
            // alert(JSON.stringify(data.message));
            $('.toast-container').append('<div class="toast fade show"  aria-live="assertive" aria-atomic="true">\n' +
                '                <div class="toast-header">\n' +
                '                    <strong class="mr-auto"><i class="fa fa-globe"></i>Notification</strong>\n' +
                '                    <small class="text-muted">just now</small>\n' +
                '                    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast">&times;</button>\n' +
                '                </div>\n' +
                '                <div class="toast-body">\n' +
                '                    <div><span>' + data.message + '.</span><br/> <label>Check it out !!.</label> <br/>  <a href="#">Click here!</a></div>\n' +
                '                </div>\n' +
                '            </div>');

            $('.kt-notification').prepend(' <a href="#" class="kt-notification__item kt-notification__item--read">\n' +
                '                                        <div class="kt-notification__item-icon">\n' +
                '                                            <i class="flaticon2-safe kt-font-primary"></i>\n' +
                '                                        </div>\n' +
                '                                        <div class="kt-notification__item-details">\n' +
                '                                            <div class="kt-notification__item-title">\n' +
                '                                                New Items\n' +data.message+
                '                                            </div>\n' +
                '                                            <div class="kt-notification__item-time">\n' +
                '                                                19 hrs ago\n' +
                '                                            </div>\n' +
                '                                        </div>\n' +
                '                                    </a>')

            $(".toast").toast({delay:3000})

            document.querySelector('.badge-notify').textContent = parseInt(document.querySelector('.badge-notify').textContent) +1
        })
    }
    {{--const com = {!! json_encode($communities) !!};--}}
    {{--for (comf of com)--}}
    {{--{--}}
    {{--    console.log(comf)--}}
    {{--}--}}
</script>
