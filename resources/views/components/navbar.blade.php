<nav class="navbar navbar-expand-lg navbar-light fixed-top py-3 d-block" data-navbar-on-scroll="data-navbar-on-scroll">
    <div class="container"><a class="navbar-brand" href="{{ url('/') }}"><img class="d-inline-block"
                src="{{ asset('assets/voyage') }}/assets/img/gallery/logo.png" width="50" alt="logo" /><span
                class="fw-bold text-primary ms-2">voyage</span></a>
        <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse border-top border-lg-0 mt-4 mt-lg-0" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto pt-2 pt-lg-0 font-base">
                {{-- <li class="nav-item px-2"><a class="nav-link fw-medium active" aria-current="page"
                        href="#destinations"><span
                            class="nav-link-icon text-800 me-1 fas fa-map-marker-alt"></span><span
                            class="nav-link-text">Locations </span></a></li> --}}
                <li class="nav-item px-2"><a class="nav-link" href="#flights"> <span
                            class="nav-link-icon text-800 me-1 fas fa-plane"></span><span
                            class="nav-link-text">Flights</span></a></li>
                {{-- <li class="nav-item px-2"><a class="nav-link" href="#hotels"> <span
                            class="nav-link-icon text-800 me-1 fas fa-hotel"></span><span
                            class="nav-link-text">Hotels</span></a></li>
                <li class="nav-item px-2"><a class="nav-link" href="#activities"><span
                            class="nav-link-icon text-800 me-1 fas fa-bolt"></span><span
                            class="nav-link-text">Activities</span></a></li> --}}
            </ul>
            <div>
                {{-- <button class="btn text-800 order-1 order-lg-0 me-2" type="button">Support</button> --}}
                @if (!Auth::check())
                    <a class="btn btn-voyage-outline order-0" href="{{ route('auth.login') }}"><span
                            class="text-primary">Sign
                            in</span></a>
                @else
                    <div class="dropdown custom-dropdown">
                        <a href="#" data-bs-toggle="dropdown"
                            class="d-flex align-items-center dropdown-link text-left" aria-haspopup="true"
                            aria-expanded="false" data-offset="0, 20">
                            <div class="profile-pic mr-3">
                                <img src="images/person_2.jpg" alt="User">
                            </div>
                            <div class="profile-info">
                                <h3>{{ Auth::user()->name }}</h3>
                                <span>Jakarta, IDN</span>
                            </div>


                        </a>

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            @if (Auth::user()->hasRole(1) || Auth::user()->hasRole(2))
                                <a class="dropdown-item" href="{{ route('admin.index') }}"><i
                                        class=" fa-solid fa-user mx-2"></i>Admin </a>
                            @endif
                            <a class="dropdown-item" href="{{ route('profile.index') }}"><i
                                    class=" fa-solid fa-user mx-2"></i>Profile </a>
                            <a class="dropdown-item" href="{{ route('pesanan.index') }}"><i
                                    class=" fa-solid fa-ticket mx-2"></i>Pesanan <span
                                    class="number">{{ Auth::user()->Pesanan->count() }}</span></a>

                            <a class="dropdown-item" href="{{ route('tickets.index') }}"><i
                                    class=" fa-solid fa-ticket mx-2"></i>My
                                Tickets <span class="number">{{ Auth::user()->Ticket->count() }}</span></a>
                            {{-- <a class="dropdown-item" href="#"><span class="icon icon-mail_outline"></span>Inbox
                                <span class="number">3</span></a>
                            <a class="dropdown-item" href="#"><span class="icon icon-people"></span>Following</a>
                            <a class="dropdown-item" href="#"><span
                                    class="icon icon-cog"></span>Setting<span>New</span></a> --}}
                            <a class="dropdown-item logout" href="javascript:;"><i
                                    class="fa-solid fa-right-from-bracket mx-2"></i>Log
                                out</a>





                        </div>
                    </div>
                @endif
            </div>

        </div>
    </div>
</nav>
