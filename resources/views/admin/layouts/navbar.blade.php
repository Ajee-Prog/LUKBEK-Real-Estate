<header class="admin-navbar">

    <div>

        <button
            class="sidebar-toggle"
            id="sidebarToggle">

            <i class="bi bi-list"></i>

        </button>

    </div>


    <div class="admin-navbar-right">

        <a
            href="{{ route('admin.messages.index') }}"
            class="notification-btn">

            <i class="bi bi-bell"></i>

            @php
                $unreadMessages =
                    \App\Models\Message::where(
                        'is_read',
                        false
                    )->count();
            @endphp

            @if($unreadMessages > 0)

                <span>
                    {{ $unreadMessages }}
                </span>

            @endif

        </a>


        <div class="admin-profile">

            <div class="profile-avatar">

                {{ strtoupper(
                    substr(auth()->user()->name, 0, 1)
                ) }}

            </div>

            <div class="d-none d-md-block">

                <strong>
                    {{ auth()->user()->name }}
                </strong>

                <small>
                    LUKBEK Admin
                </small>

            </div>

        </div>

    </div>

</header>
