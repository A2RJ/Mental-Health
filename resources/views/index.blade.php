<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ env('APP_NAME') }}</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('bootstrap5/css/bootstrap.min.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">

    <script src="{{ asset('bootstrap5/js/jquery.min.js') }}"></script>
    <script src="{{ asset('bootstrap5/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('bootstrap5/js/parsley.min.js') }}"></script>

    <link rel="stylesheet" href="{{ asset('bootstrap5/css/custom.css') }}">
</head>

<body>

    <nav class="navbar navbar-light navbar-expand-md bg-white fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">{{ env('APP_NAME') }}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
                aria-controls="offcanvasNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-text offcanvas-end" tabindex="-1" id="offcanvasNavbar"
                aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">{{ env('APP_NAME') }}</h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="/">@lang('welcome.navbar.home')</a>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link" href="#">@lang('welcome.navbar.whatwedo')</a>
                        </li> --}}
                        <li class="nav-item">
                            <a class="nav-link text-primary" href="#" onclick="startSurvey()">@lang('welcome.navbar.start')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">@lang('welcome.navbar.contact')</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="offcanvasNavbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                {{ $country }}
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="offcanvasNavbarDropdown">
                                <li><a class="dropdown-item" href="#" onclick="redirecPage('id')">Indonesian</a></li>
                                <li><a class="dropdown-item" href="#" onclick="redirecPage('en')">English</a></li>
                                <li><a class="dropdown-item" href="#" onclick="redirecPage('cn')">Chinese (中文（简体)</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="container top-jumbotron d-flex justify-content-center">
        <div class="text-center">
            <h1 class="title-jumbotron">Mental<br> Health Tracker</h1>
            <h6 class="description-jumbotron text-muted">@lang('welcome.subtitle').</h6>
            <button class="btn btn-primary btn-lg btn-block shadow mt-5"
                onclick="startSurvey()">@lang('welcome.navbar.start')</button>
        </div>
    </div>

    <div class="test">
        <div class="custom-row m-0" id="scrolling">
            {{-- <div class="left-side-test">
            </div> --}}
            <div class="right-side-test">
                <div class="d-flex justify-content-end">
                    <button type="button" class="close-survey btn-close m-3 float-right text-reset relative"
                        onclick="closeSurvey()"></button>
                </div>

                <div class="container mt-5 px-5">
                    <h6 class="text-muted d-flex">
                        *@lang('welcome.profile.title')
                    </h6>
                    <form class="contact-form" action="" method="post">
                        @csrf
                        <div class="mb-3 question">
                            <div class="mb-3">
                                <input type="text" class="form-control" name="name" id="name"
                                    placeholder="@lang('welcome.profile.name')" required autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <input type="number" class="form-control" name="age" id="age"
                                    placeholder="@lang('welcome.profile.age')" required autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" name="occupation" id="occupation"
                                    placeholder="@lang('welcome.profile.profession')" required autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <select class="form-control" name="location" id="location">
                                    <option value="">@lang('welcome.select-location')</option>
                                    @foreach ($locations as $location)
                                        <option value="{{ $location->id_prov }}">{{ $location->country_name }} -
                                            {{ $location->prov_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <select class="form-control" name="category" id="category">
                                    <option value="">@lang('welcome.select-test')</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between form-navigation">
                            <button type="button" class="cancel m-3 btn shadow btn-primary"
                                onclick="closeSurvey()">@lang('welcome.cancel')</button>
                            <button type="button" class="next m-3 btn shadow btn-primary" onclick="loadQuestionCategory()">@lang('welcome.next')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container stepTest">
        <div class="row">
            <div class="col-sm-6">
                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Porro, ducimus.
            </div>
            <div class="col-sm-6">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam, inventore.
            </div>
        </div>
    </div>

    <div class="contact-us container d-flex justify-content-center align-center">
        <div class="text-center">
            <h1 class="footer-title">Contact us</h1>
            <p class="footer-desc">We will be happy to hear from you, your feedback is important to us. Your email
                address will not be
                shared with anyone.</p>
            <div class="input-group mb-3 shadow-sm">
                <input type="email" class="form-control" autocomplete="off" required
                    placeholder="Insert your email address" aria-label="Insert your email address"
                    aria-describedby="basic-addon2">
                <button class="contact-button btn btn-primary" type="button" id="button-addon2">Notify us</button>
            </div>
        </div>
    </div>

    <div class="footer container d-flex justify-content-center item-center text-center text-white">
        Copyright &copy; <?= date('Y') ?> - Mental Health Tracker
    </div>

    <script>
        function redirecPage(languages) {
            var url = "{{ \Request::url() }}/?select-locale=";
            window.location.replace(url + languages);
        }

        function startSurvey() {
            var test = document.getElementsByClassName('test')[0];
            test.classList.add('test-show');
            test.classList.remove('test-hide');
        }

        function closeSurvey() {
            var test = document.getElementsByClassName('test')[0];
            test.classList.remove('test-show');
            test.classList.add('test-hide');
        }
        function loadQuestionCategory() {
            const name = document.getElementById('name').value;
            const age = document.getElementById('age').value;
            const occupation = document.getElementById('occupation').value;
            const location = document.getElementById('location').value;
            const category = document.getElementById('category').value;

            if (name == '' || age == '' || occupation == '' || location == '' || category == '') {
                alert('@lang('welcome.validation')');
                return;
            }

            const url = "{{ route('start', ':category') }}".replace(':category', category + '?select-locale={{ \Request::get('select-locale') ? \Request::get('select-locale') : \App::getLocale() }}');
            window.location.replace(url);
        }
    </script>
</body>

</html>
