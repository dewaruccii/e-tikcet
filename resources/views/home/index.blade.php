@extends('layouts.home')
@push('css')
    <style>
        .custom-dropdown>a {
            color: #000;
        }

        .custom-dropdown>a .arrow {
            display: inline-block;
            position: relative;
            -webkit-transition: .3s transform ease;
            -o-transition: .3s transform ease;
            transition: .3s transform ease;
        }

        .custom-dropdown.show>a .arrow {
            -webkit-transform: rotate(-180deg);
            -ms-transform: rotate(-180deg);
            transform: rotate(-180deg);
        }

        .custom-dropdown .btn:active,
        .custom-dropdown .btn:focus {
            -webkit-box-shadow: none !important;
            box-shadow: none !important;
            outline: none;
        }

        .custom-dropdown .btn.btn-custom {
            border: 1px solid #efefef;
        }

        .custom-dropdown .title-wrap {
            padding-top: 10px;
            padding-bottom: 10px;
        }

        .custom-dropdown .title {
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .custom-dropdown .dropdown-link .profile-pic {
            -webkit-box-flex: 0;
            -ms-flex: 0 0 50px;
            flex: 0 0 50px;
        }

        .custom-dropdown .dropdown-link .profile-pic img {
            width: 50px;
            border-radius: 50%;
        }

        .custom-dropdown .dropdown-link .profile-info h3,
        .custom-dropdown .dropdown-link .profile-info span {
            margin: 0;
            padding: 0;
        }

        .custom-dropdown .dropdown-link .profile-info h3 {
            font-size: 16px;
        }

        .custom-dropdown .dropdown-link .profile-info span {
            display: block;
            font-size: 13px;
        }

        .custom-dropdown .dropdown-menu {
            border: 1px solid transparent !important;
            -webkit-box-shadow: 0 15px 30px 0 rgba(0, 0, 0, 0.2);
            box-shadow: 0 15px 30px 0 rgba(0, 0, 0, 0.2);
            margin-top: -10px !important;
            padding-top: 0;
            padding-bottom: 0;
            opacity: 0;
            border-radius: 0;
            background: #fff;
            right: auto !important;
            left: auto !important;
            -webkit-transition: .3s margin-top ease, .3s opacity ease, .3s visibility ease;
            -o-transition: .3s margin-top ease, .3s opacity ease, .3s visibility ease;
            transition: .3s margin-top ease, .3s opacity ease, .3s visibility ease;
            visibility: hidden;
        }

        .custom-dropdown .dropdown-menu.active {
            opacity: 1;
            visibility: visible;
            margin-top: 0px !important;
        }

        .custom-dropdown .dropdown-menu a {
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            font-size: 14px;
            padding: 15px 15px;
            position: relative;
            color: #b2bac1;
        }

        .custom-dropdown .dropdown-menu a:last-child {
            border-bottom: none;
        }

        .custom-dropdown .dropdown-menu a .icon {
            /* margin-right: px; */
            /* display: inline-block; */
        }

        .custom-dropdown .dropdown-menu a:hover,
        .custom-dropdown .dropdown-menu a:active,
        .custom-dropdown .dropdown-menu a:focus {
            background: #fff;
            color: #000;
        }

        .custom-dropdown .dropdown-menu a:hover .number,
        .custom-dropdown .dropdown-menu a:active .number,
        .custom-dropdown .dropdown-menu a:focus .number {
            color: #fff;
        }

        .custom-dropdown .dropdown-menu a .number {
            padding: 2px 6px;
            font-size: 11px;
            background: #fd7e14;
            position: absolute;
            top: 50%;
            -webkit-transform: translateY(-50%);
            -ms-transform: translateY(-50%);
            transform: translateY(-50%);
            right: 15px;
            border-radius: 4px;
            color: #fff;
        }

        .autoComplete_wrapper>input {
            width: 100% !important;
        }


        .timeline {
            width: 100%;
            height: 20px;
            list-style: none;
            text-align: justify;
            background: -webkit-gradient(left top, left bottom, color-stop(0%, rgba(255, 255, 255, 0)), color-stop(45%, rgba(255, 255, 255, 0)), color-stop(51%, rgba(44, 62, 80, 1.0)), color-stop(57%, rgba(255, 255, 255, 0)), color-stop(100%, rgba(255, 255, 255, 0)));
            background: linear-gradient(to bottom, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 0) 45%, rgba(44, 62, 80, 1.0) 51%, rgba(255, 255, 255, 0) 57%, rgba(255, 255, 255, 0) 100%);
        }

        .timeline:after {
            display: inline-block;
            content: "";
            width: 100%;
        }

        .timeline li {
            display: inline-block;
            width: 20px;
            height: 20px;
            background: #2980b9;
            text-align: center;
            line-height: 1.2;
            position: relative;
            border-radius: 50%;
        }

        .timeline li:before {
            display: inline-block;
            content: attr(data-year);
            font-size: 26px;
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
        }

        .timeline li:nth-child(odd):before {
            top: -40px;
        }

        .timeline li:nth-child(even):before {
            bottom: -40px;
        }

        .timeline li:after {
            display: inline-block;
            content: attr(data-text);
            font-size: 16px;
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
        }

        .timeline li:nth-child(odd):after {
            bottom: 0;
            margin-bottom: -10px;
            transform: translate(-50%, 100%);
        }

        .timeline li:nth-child(even):after {
            top: 0;
            margin-top: -10px;
            transform: translate(-50%, -100%);
        }

        .card-body:hover {
            border: 1px solid rgba(41, 128, 185, 1.0);
            cursor: pointer;
        }
    </style>
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@tarekraafat/autocomplete.js@10.2.7/dist/css/autoComplete.02.min.css">
@endpush
@section('content')
    <section class="mt-7 py-0">
        <div class="bg-holder w-50 bg-right d-none d-lg-block"
            style="background-image:url({{ asset('assets/voyage') }}/assets/img/gallery/hero-section-1.png);">
        </div>
        <!--/.bg-holder-->

        <div class="container">
            <div class="row">
                <div class="col-lg-6 py-5 py-xl-5 py-xxl-7">
                    <h1 class="display-3 text-1000 fw-normal">Let’s make a tour</h1>
                    <h1 class="display-3 text-primary fw-bold">Discover the beauty</h1>
                    <div class="pt-5">
                        <nav>
                            <div class="nav nav-tabs voyage-tabs" id="nav-tab" role="tablist">
                                {{-- <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-home" type="button" role="tab"
                                aria-controls="nav-home" aria-selected="true"><i
                                    class="fas fa-map-marker-alt"></i></button> --}}
                                <button class="nav-link active" id="nav-profile-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile"
                                    aria-selected="true"> <i class="fas fa-plane"></i></button>
                                {{-- <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-contact" type="button" role="tab"
                                aria-controls="nav-contact" aria-selected="false"> <i
                                    class="fas fa-hotel"></i></button> --}}
                            </div>
                            <div class="tab-content" id="nav-tabContent">

                                <div class="tab-pane fade show active" id="nav-profile" role="tabpanel"
                                    aria-labelledby="nav-profile-tab">
                                    <form class="row g-4 mt-5">
                                        <div class="col-6">
                                            <div class="input-group-icon">
                                                <label class="form-label visually-hidden" for="from_airport">Address
                                                    1</label>
                                                <input class="form-control input-box form-voyage-control" id="from_airport"
                                                    type="text" placeholder="From where" name="from_airport"
                                                    autocomplete="off" value="{{ request()->from_airport }}" /><span
                                                    class="nav-link-icon text-800 fs--1 input-box-icon"><i
                                                        class="fas fa-map-marker-alt"></i></span>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="input-group-icon">
                                                <label class="form-label visually-hidden" for="destination_airport">Address
                                                    2</label>
                                                <input class="form-control input-box form-voyage-control"
                                                    id="destination_airport" name="destination_airport" type="text"
                                                    autocomplete="off" value="{{ request()->destination_airport }}"
                                                    placeholder="To where" /><span
                                                    class="nav-link-icon text-800 fs--1 input-box-icon"><i
                                                        class="fas fa-map-marker-alt"> </i></span>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="input-group-icon">
                                                <input class="form-control input-box form-voyage-control"
                                                    id="inputDateThree" type="date" placeholder="Tanggal Berangkat"
                                                    name="fly" value="{{ request()->fly }}" /><span
                                                    class="nav-link-icon text-800 fs--1 input-box-icon"><i
                                                        class="fas fa-calendar"></i></span>

                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="input-group-icon">
                                                <input class="form-control input-box form-voyage-control" id="inputDateFour"
                                                    type="date" name="arrival" value="{{ request()->arrival }}" /><span
                                                    class="nav-link-icon text-800 fs--1 input-box-icon"><i
                                                        class="fas fa-calendar"></i></span>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="input-group-icon">
                                                <label class="form-label visually-hidden"
                                                    for="inputPeopleTwo">People</label>
                                                <select class="form-select form-voyage-select input-box"
                                                    id="inputPeopleThree" name="people">
                                                    <option value="1" {{ request()->people == 1 ? 'selected' : '' }}>1
                                                        Orang</option>
                                                    <option value="2" {{ request()->people == 2 ? 'selected' : '' }}>2
                                                        Orang</option>
                                                    <option value="4" {{ request()->people == 4 ? 'selected' : '' }}>4
                                                        Orang</option>
                                                    <option value="6" {{ request()->people == 6 ? 'selected' : '' }}>6
                                                        Orang</option>
                                                </select><span class="nav-link-icon text-800 fs--1 input-box-icon"><i
                                                        class="fas fa-user"> </i></span>
                                            </div>
                                        </div>
                                        <div class="col-12 d-grid mt-6">
                                            <button class="btn btn-secondary" type="submit">Cari Penerbangan</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- ============================================-->
    <!-- <section> begin ============================-->
    <section class="py-0 overflow-hidden">

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 px-0"><img class="img-fluid order-md-0 mb-4 h-100 fit-cover"
                        src="{{ asset('assets/voyage') }}/assets/img/gallery/hero-section-2.png" alt="..." />
                </div>
                <div class="col-lg-6 px-0 bg-primary-gradient bg-offcanvas-right">
                    <div class="mx-6 mx-xl-8 my-8">
                        <div class="align-items-center d-block d-flex mb-5"><img class="img-fluid me-3 me-md-2 me-lg-4"
                                src="{{ asset('assets/voyage') }}/assets/img/icons/locations.png" alt="..." />
                            <div class="flex-1 align-items-center pt-2">
                                <h5 class="fw-bold text-light">Visit the greatest places</h5>
                            </div>
                        </div>
                        <div class="align-items-center d-block d-flex mb-5"><img class="img-fluid me-3 me-md-2 me-lg-4"
                                src="{{ asset('assets/voyage') }}/assets/img/icons/schedule.png" alt="..." />
                            <div class="flex-1 align-items-center pt-2">
                                <h5 class="fw-bold text-light">Make your own plans.</h5>
                            </div>
                        </div>
                        <div class="align-items-center d-block d-flex mb-5"><img class="img-fluid me-3 me-md-2 me-lg-4"
                                src="{{ asset('assets/voyage') }}/assets/img/icons/save.png" alt="..." />
                            <div class="flex-1 align-items-center pt-2">
                                <h5 class="fw-bold text-light">Save 50% on your next trip</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end of .container-->

    </section>
    <!-- <section> close ============================-->
    <!-- ============================================-->

    <section id="testimonial">
        <h1 class="text-center">Penerbangan Terkini</h1>
        <div class="container">

            <div class="row">

                @foreach ($products as $item)
                    <div class="col-md-4">
                        <div class="card" style="min-height:100%">
                            <div class="card-body">
                                <h5 class="card-title">{{ $item->Maskapai?->name }}</h5>

                                <div class="row align-items-center">
                                    <div class="col-md-3">
                                        <div class="d-flex flex-column">
                                            <b>{{ formatDate($item->Detail?->estimated_fly, 'H:i') }}</b>
                                            <p style="font-size: 12px">
                                                {{ formatDate($item->Detail?->estimated_fly, 'y-m-d') }}</p>
                                            <b>
                                                {{ $item->Detail?->FromAirport?->code }}
                                            </b>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex flex-column">
                                            <span
                                                class="text-center"><b>{{ counting($item->Detail?->estimated_fly, $item->Detail?->estimated_arrival) }}</b></span>
                                            <ul class="timeline">
                                                <li>
                                                </li>

                                                <li>
                                                </li>
                                                <li>
                                                </li>

                                            </ul>

                                        </div>

                                    </div>
                                    <div class="col-md-3">
                                        <div class="d-flex flex-column">
                                            <b>{{ formatDate($item->Detail?->estimated_arrival, 'H:i') }}</b>
                                            <p style="font-size: 12px">
                                                {{ formatDate($item->Detail?->estimated_fly, 'y-m-d') }}</p>
                                            <b>
                                                {{ $item->Detail?->DestinationAirport?->code }}
                                            </b>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6" style="border-right: 1px solid rgba(149, 165, 166,1.0);">
                                        <b style="text-align: left">
                                            {{ $item->Detail?->FromAirport?->name }}
                                        </b>
                                        <br>


                                    </div>
                                    <div class="col-md-6" style="border-left: 1px solid rgba(149, 165, 166,1.0);">
                                        <p class="text-end fw-bold">
                                            {{ $item->Detail?->DestinationAirport?->name }}
                                        </p>
                                    </div>
                                </div>
                                <h4>{{ formatRupiah($item->price) }}</h4>
                                <p class="card-text">{{ $item->description }}
                                </p>
                                <a href="{{ route('billings.index', $item->uuid) }}" class="btn btn-primary"
                                    style="width: 100%">Choose</a>

                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
@endsection
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/@tarekraafat/autocomplete.js@10.2.7/dist/autoComplete.min.js"></script>
    <script>
        // Fungsi debouncing
        const debounce = (func, delay) => {
            let timerId;
            return function(...args) {
                clearTimeout(timerId);
                timerId = setTimeout(() => {
                    func.apply(this, args);
                }, delay);
            };
        };

        // Fungsi untuk melakukan fetch data
        // const fetchAirportData = async (query) => {
        //     const response = await fetch('{{ route('fetch.airport') }}', {
        //         method: 'POST',
        //         headers: {
        //             'Content-Type': 'application/json',
        //             'X-CSRF-TOKEN': '{{ csrf_token() }}'
        //         },
        //         body: JSON.stringify({
        //             q: query
        //         })
        //     });
        //     const data = await response.json();
        //     return data.data;
        // };
        const from = new autoComplete({
            selector: '#from_airport',
            placeHolder: "From Airports",
            data: {
                src: async (query) => {
                    const response = await fetch('{{ route('fetch.airport') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            q: query,
                        })
                    });
                    const data = await response.json();
                    return data.data;

                },
                keys: ["name", "city", "country"],
                // cache: true
            },
            resultItem: {
                highlight: true,
            },
            debounce: 500,


        });
        const destination = new autoComplete({
            selector: '#destination_airport',
            placeHolder: "Search for Airports...",
            data: {
                src: async (query) => {
                    const response = await fetch('{{ route('fetch.airport') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            q: query,
                        })
                    });
                    const data = await response.json();
                    return data.data;

                },
                keys: ["name", "city", "country"],
                // cache: true
            },
            resultItem: {
                highlight: true,
            },
            debounce: 500,


        });
        $(document).ready(function() {

            $(".autoComplete_wrapper").on('click', 'ul li', function() {
                let wrapper = $(this).closest('.autoComplete_wrapper').find('input');
                let id = wrapper.attr('id');
                if (id === 'from_airport') {
                    $("#from_airport").val($(this)
                        .text()
                    ) // Jika ID adalah 'from_airport', maka atur nilai input dengan ID 'from_airport'

                } else if (id === 'destination_airport') {
                    $("#destination_airport").val($(this)
                        .text()
                    ); // Jika ID adalah 'destination', maka atur nilai input dengan ID 'destination'
                }

            })

        })
    </script>
    <script>
        $(function() {

            $('.custom-dropdown').on('show.bs.dropdown', function() {
                var that = $(this);
                setTimeout(function() {
                    that.find('.dropdown-menu').addClass('active');
                }, 100);


            });
            $('.custom-dropdown').on('hide.bs.dropdown', function() {
                $(this).find('.dropdown-menu').removeClass('active');
            });

        });
        $(document).ready(function() {
            $(".logout").on('click', function() {
                Swal.fire({
                    title: "Are you sure?",
                    text: "",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, Logout "
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '{{ route('logout') }}',
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(e) {
                                if (e.status == 200) {
                                    Swal.fire({
                                        title: "Succesfully!",
                                        text: " the page will automatically redirect!.",
                                        icon: "success",
                                        showConfirmButton: false,
                                        timer: 1500
                                    }).then((result) => {
                                        location.reload();
                                    });
                                }
                            }
                        })

                    }
                });
            });
        });
    </script>
@endpush
