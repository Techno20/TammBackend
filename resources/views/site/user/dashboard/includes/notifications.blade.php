<div class="page-header-btns">
    <a href="" class="btn main-menu-toggle" id="main-menu-toggle">
        <i class="fas fa-bars"></i>
    </a>
</div>

<div class="notification-container" onclick="onNotificationClick();">
    <a href="" class="btn notify-spot"
       id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <svg xmlns="http://www.w3.org/2000/svg" width="17.466" height="20.396" viewBox="0 0 17.466 20.396">
            <g transform="translate(0)">
                <g transform="translate(0 0)">
                    <path class="a"
                          d="M5.1,17.411H.957c-.022,0-.044.008-.067.01a.756.756,0,0,1-.825-.667A10.551,10.551,0,0,1,0,15.611V11.363a8.953,8.953,0,0,1,8.009-9.2V.746a.747.747,0,0,1,1.493,0v1.41a8.4,8.4,0,0,1,5.422,2.7,9.476,9.476,0,0,1,2.537,6.507V15.6a10.55,10.55,0,0,1-.059,1.144.753.753,0,0,1-.169.394l-.007.008h0a.744.744,0,0,1-.569.264H12.416a3.732,3.732,0,0,1-7.313,0ZM8.76,18.9a2.24,2.24,0,0,0,2.112-1.492H6.649A2.24,2.24,0,0,0,8.76,18.9Zm7.2-2.984c.007-.107.012-.216.012-.328V11.363A7.959,7.959,0,0,0,13.834,5.87,6.963,6.963,0,0,0,8.76,3.612a7.511,7.511,0,0,0-7.213,7.751v4.557Z" fill="currentcolor" />
                </g>
            </g>
        </svg>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <div class="dropdown-menu-scroll">

                @forelse(auth()->user()->notifications as $notification)

                    @php
                        if($notification->data['channel'] == 'orders')
                        {
                            $url = route('user.order.details' , $notification->data['order_id']);
                        }
                        elseif($notification->data['channel'] == 'messages')
                        {
                            $url = route('conversation.list');
                        }
                        elseif($notification->data['channel'] == 'services')
                        {
                            $url = route('service.details' , $notification->data['service_id'] );
                        }

                    @endphp

                    <a class="dropdown-item @if($notification->read_at != null) read @endif" href="{{ $url }}">
                        <div class="text-left">
                            <span class="notification-date">
                                {{ $notification->created_at->diffForHumans() }}
                            </span>
                            <p>
                                @if($notification->data['channel'] == 'orders')
                                   {{ \App\Models\User::find($notification->data['user_id'])->name }} {{ $notification->data['title'] }} -
                                    {{ \App\Models\Order::find($notification->data['order_id'])->Service->title }}
                                @elseif($notification->data['channel'] == 'messages')
                                    {{ $notification->data['title'] }} - {{ \App\Models\User::find($notification->data['user_id'])->name }}
                                @elseif($notification->data['channel'] == 'services')
                                    {{ \App\Models\User::find($notification->data['user_id'])->name }} {{ $notification->data['title'] }} -
                                    {{ \App\Models\Service::find($notification->data['service_id'])->title }}
                                @endif
                            </p>
                        </div>
                    </a>
                    <hr>
                @empty
                @endforelse

            </div>
        </div>
    </a>
</div>

<script>
    // Get Categories and Sub Categories When Classification Change
    function onNotificationClick()
    {
        $.ajax
        ({
            type: "get",
            url: "/user/make-notifications-read",
            cache: false,
            success: function(html)
            {}
        });
    }
</script>
