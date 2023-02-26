<div class="navbar-custom">
    <ul class="list-unstyled topbar-menu float-end mb-0">


        <li class="dropdown notification-list">
            <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button"
                aria-haspopup="false" aria-expanded="false">
                <i class="dripicons-bell noti-icon"></i>
                @if (count(auth()->user()->unreadNotifications))
                    <span class="noti-icon-badge"></span>
                @endif
            </a>
            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated dropdown-lg">

                <!-- item-->
                <div class="dropdown-item noti-title">
                    <h5 class="m-0">

                        <span class="float-end">
                            @if (count(auth()->user()->unreadNotifications))
                                <a href="{{ route('dashboard.mark.notifications') }}" class="text-dark">
                                    <small>Clear all</small>
                                </a>
                            @endif
                        </span>Notifications
                    </h5>
                </div>

                <div style="max-height: 230px;" data-simplebar>
                    @if (!count(auth()->user()->unreadNotifications))
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <div class="notify-icon bg-primary">
                                <i class="mdi mdi-message"></i>
                            </div>
                            <p class="notify-details">There are currently no notifications
                            </p>
                        </a>
                    @else
                        @foreach (auth()->user()->unreadNotifications as $notification)
                            @if ($notification->type === 'App\Notifications\OrderPlaced')
                                <!-- item-->
                                <a href="{{ route('dashboard.mark.notification', $notification->id) }}"
                                    class="dropdown-item notify-item">
                                    <div class="notify-icon bg-primary">
                                        <i class="mdi mdi-cart"></i>
                                    </div>
                                    <p class="notify-details">
                                        An order with ID {{ $notification->data['sku'] }}  was registered
                                        <small
                                            class="text-muted">{{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}</small>
                                    </p>
                                </a>
                            @endif
                        @endforeach
                        @foreach (auth()->user()->unreadNotifications as $notification)
                        @if ($notification->type === 'App\Notifications\UserRegistered')
                            <!-- item-->
                            <a href="{{ route('dashboard.mark.notification', $notification->id) }}"
                                class="dropdown-item notify-item">
                                <div class="notify-icon bg-primary">
                                    <i class="mdi mdi-account"></i>
                                </div>
                                <p class="notify-details">
                                    A user with mobile phone number  {{ $notification->data['username'] }} registered in the application
                                    <small
                                        class="text-muted">{{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}</small>
                                </p>
                            </a>
                        @endif
                    @endforeach
                    @endif

                </div>


            </div>
        </li>

        <li class="dropdown notification-list">
            <a class="nav-link dropdown-toggle nav-user arrow-none me-0 d-flex align-items-center"
                data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                <span class="account-user-avatar">
                    <img src="/admin/assets/images/USER.svg" alt="user-image" class="rounded-circle">
                </span>
                <span class="account-user-name"> {{ auth()->user()->name }}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu profile-dropdown">

                <!-- item-->
                <a href="{{ route('dashboard.profile.edit') }}" class="dropdown-item notify-item">
                    <i class="mdi mdi-account-circle me-1"></i>
                    <span> Account</span>
                </a>

                <!-- item-->
                <a href="{{ route('dashboard.settings.index') }}" class="dropdown-item notify-item">
                    <i class="mdi mdi-cog me-1"></i>
                    <span>Settings Application </span>
                </a>

                <!-- item-->
                <a href="{{ route('logout') }}" class="dropdown-item notify-item"
                    onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                    <i class="mdi mdi-logout me-1"></i>
                    <span>Exit</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>

            </div>
        </li>
    </ul>
    <button class="button-menu-mobile open-left">
        <i class="mdi mdi-menu"></i>
    </button>

</div>
