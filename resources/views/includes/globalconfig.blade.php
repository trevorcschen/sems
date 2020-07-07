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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script src="https://js.pusher.com/6.0/pusher.min.js"></script>

<script>

        const authAPI = {!! json_encode($authAPIKEY) !!}
        console.log(authAPI)
        const std = {!! json_encode($student_channels) !!};
        std.push(`student-channel_${authAPI}`);
        console.log(std)
        Pusher.logToConsole = true;

    var pusher = new Pusher('e204c5a4177ff320ec30', {
        cluster: 'ap1'
    });

    var channels = std.map(channelName => pusher.subscribe(channelName));


    for (const channel of channels)
    {
        channel.bind('form-submitted', function(data)
        {
            $('.toast-container').append('<div class="toast fade show"  aria-live="assertive" aria-atomic="true">\n' +
                '                <div class="toast-header">\n' +
                '                    <strong class="mr-auto"><i class="fa fa-globe"></i>Notification</strong>\n' +
                '                    <small class="text-muted">just now</small>\n' +
                '                    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast">&times;</button>\n' +
                '                </div>\n' +
                '                <div class="toast-body">\n' +
                '                    <div><span>' + data.message + '.</span><br/> <label>Check it out !!. Notification will take effect after u refreshed the page</label> <br/> ' +
                // ' <a href="#">Click here!</a>' +
                '</div>\n' +
                '                </div>\n' +
                '            </div>');

            retrieveLatestNotification();
            $(".toast").toast();
            document.querySelector('.badge-notify').textContent = parseInt(document.querySelector('.badge-notify').textContent) +1;
            document.querySelector('.badge-notify').style.display = 'block';

        })
    }

    function retrieveLatestNotification()
    {
        var xhttp = new XMLHttpRequest();
        xhttp.open("POST", "{{ route('notification.ajax.latest')}}", true);
        xhttp.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');

        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                console.log('function done');
                let tempNot = JSON.parse(this.response).data;
                appendNewHTML(tempNot);
            }
        };
        xhttp.send();

    }

    function appendNewHTML(tempNot)
    {
        let url =  tempNot.data['routing'] === 'user' ? '{{ route("users.show", ':ids') }}' : (tempNot.data['routing'] === 'commi' ? '{{route("commi.community", ":ids")}}':'{{route("event.show", ":ids")}}' );
        url = url.replace(':ids', tempNot.data['routingID']);
        console.log(url);
        let dd = `<div><a href="${tempNot.data['permit'] === 1 ? url : `javascript:void(0)`}" class="kt-notification__item " id="${tempNot.id}">` +
            `<div class="kt-notification__item-icon"><i class="flaticon2-safe kt-font-primary"></i></div>`+
            `<div class="kt-notification__item-details">`+
            `<div class="kt-notification__item-title">  ${tempNot.data['data']}</div>`+
            `<div class="kt-notification__item-time"> ${moment(tempNot.updated_at).fromNow()}</div></div></a>`;
        tempNot.data['action'] === 1 ? dd+='<div class="actionNotification" style="display: flex;flex-direction: row;justify-content: space-around;margin-top: 5px" id="'+tempNot.id +'">'+
            '<button type="button" class="btn btn-decline" style="background: rgba(255, 0, 0, 0.08);color: red;">Decline</button>'+
            ' <button type="button" class="btn btn-accept" style="background-color: rgba(153, 255, 160, 0.5);color: green;">Accept</button></div></div>' : `</div>`;
        $('.kt-notification').prepend(dd);

    }

</script>

<script>

    function unmarkedNotification()
    {
        var xhttp = new XMLHttpRequest();
        xhttp.open("POST", "{{ route('notification.ajax.unmarked')}}", true);

        xhttp.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');

        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.querySelector('.badge-notify').textContent = 0;
                document.querySelector('.badge-notify').style.display = 'none';
                console.log('function done')
            }
        };

        xhttp.send();
    }

    function readNotification(id)
    {
        var xhttp = new XMLHttpRequest();
        xhttp.open("POST", "{{ route('notification.ajax.unmarked')}}", true);
        var data = new FormData();
        data.append('id', id);

        xhttp.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');

        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.querySelector('.badge-notify').textContent = 0;
                document.querySelector('.badge-notify').style.display = 'none';
                console.log('function done')
                console.log(this.response)
            }
        };

        xhttp.send(data);
    }

    function responseRequest(id, responseText)
    {
        $.ajax(
            {
                url: "{{route('notification.ajax.reply')}}",
                type: "POST",
                data:
                    {
                        id: id,
                        answer: responseText
                    },
                dataType: 'json',
                headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                success: function (data, text, xhr) {
                    console.log(data)
                },
                error: function (jqXHR, textStatus, errorThrown) {
                        console.log(jqXHR.responseText)
                }
            });

    }
    // [...document.querySelectorAll('.kt-notification__item')].map((item) =>
    //     item.addEventListener('click',function(e)
    //     {
    //         console.log('click'+ this.id)
    //         readNotification(this.id)
    //     }))

    document.querySelector('.notification_item_icon').addEventListener('click', function()
        {
            // console.log(document.querySelectorAll('.kt-notification__item'));
            if(parseInt(document.querySelector('.badge-notify').textContent) !== 0)
            {
                console.log('d')
                document.querySelector('.badge-notify').textContent = 0;
                document.querySelector('.badge-notify').style.display = 'none';
                // readNotification()
                unmarkedNotification()
                    // [...document.querySelectorAll('.kt-notification__item')].map((item) => (item.classList).contains('kt-notification__item--read') === true ? null : item.classList.add('kt-notification__item--read'))

            }
        })


    $(document.body).on('click', ".actionNotification",function(e)
    {
        console.log('h');
        e.target.className.includes('btn-accept') ? responseRequest(this.id, 'accept') : responseRequest(this.id, 'decline')
        $(this).parent().remove();

    })

</script>
