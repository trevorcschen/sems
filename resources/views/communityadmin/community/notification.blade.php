<!DOCTYPE html>
<html>
<head>
    <base href="../../../">
    <meta charset="utf-8" />
    <title>{{ config('app.name') }} | @yield('title')</title>
    <meta name="description" content="Sticky form action bar example">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <!--begin::Fonts -->

</head>

<body>
<h1>Pusher Test</h1>
<p>
    Try publishing an event to channel <code>my-channel</code>
    with event name <code>my-event</code>.
</p>
<div class="kt-container">

</div>
{{--<div class="toast" role="alert" aria-live="assertive" aria-atomic="true">--}}
{{--    <div class="toast-header">--}}
{{--        <strong class="mr-auto">Bootstrap</strong>--}}
{{--        <small>11 mins ago</small>--}}
{{--        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">--}}
{{--            <span aria-hidden="true">&times;</span>--}}
{{--        </button>--}}
{{--    </div>--}}
{{--    <div class="toast-body">--}}
{{--        Hello, world! This is a toast message.--}}
{{--    </div>--}}
{{--</div>--}}
</body>
<script src="https://js.pusher.com/6.0/pusher.min.js"></script>

<script>
    // $(document).ready(function()
    // {
    //     $('.toast').toast({delay: 3000})
    //     $('.toast').toast('show')
    // })

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('e204c5a4177ff320ec30', {
        cluster: 'ap1'
    });

    var channels = null;
    if(Math.floor(Math.random() * 2) === 0)
    {
        console.log('user type 0 ')
         channels = ['student-channel_9057573', 'community-channel_computer-science-society'].map(channelName => pusher.subscribe(channelName));

    }
    else
    {
        console.log('user type 1')
         channels = ['student-channel_9054329', 'community-channel_club-freedom'].map(channelName => pusher.subscribe(channelName));

    }

    for (const channel of channels)
    {
        channel.bind('form-submitted', function(data)
        {
            // alert(JSON.stringify(data.message));
            $('body').append('<div class="toast show fade" role="alert" data-autohide="true" aria-live="assertive" aria-atomic="true">\n' +
                '    <div class="toast-header">\n' +
                '        <strong class="mr-auto">Bootstrap </strong>\n' +
                '        <small>Now</small>\n' +
                '        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">\n' +
                '            <span aria-hidden="true">&times;</span>\n' +
                '        </button>\n' +
                '    </div>\n' +
                '    <div class="toast-body">\n' + data.message +
                '        Hello, world! This is a toast message.\n' +
                '    </div>\n' +
                '</div>');
            // setTimeout(function()
            // {
            //     $('.toast').remove();
            // }, 3000);
            // $('.toast').toast({autohide : false})
            // $('.toast').toast('show')

        })
    }


    // var channel = pusher.subscribe('my-channel');
    // channel.bind('form-submitted', function(data) {
    //     alert(JSON.stringify(data.message));
    // });
</script>
</html>
