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

    <style>
        .form-section {
            padding-left: 15px;
            display: none;
            animation: fadeIn ease-in .2s;
        }

        .form-section.current {
            display: inherit;
        }

        .btn-info,
        .btn-success {
            margin-top: 10px;
        }

        .parsley-error-list {
            margin: 2px 0 3px;
            padding: 0;
            list-style-type: none;
            color: red;
        }

        body {
            font-family: 'Roboto', sans-serif;
        }

        nav a.navbar-brand {
            font-size: 25px;
            font-weight: 700;
        }

        nav .offcanvas-text {
            font-size: 18px;
            font-weight: 500;
        }

        nav .nav-link button {
            padding: 0.5rem 1rem;
        }

        .top-jumbotron {
            padding-top: 150px;
            min-height: 100vh;
        }

        .top-jumbotron button {
            padding: 10px 50px;
        }

        .top-jumbotron button:hover {
            border-radius: 5px;
            border: 1px solid #00a8ff;
            background-color: #f5f5f5;
            color: #337ab7;
            cursor: pointer;
        }

        .top-jumbotron .text-center>* {
            margin-top: 20px;
        }

        .title-jumbotron {
            font-size: 72px;
            font-weight: 900;
            font-family: 'Righteous', cursive;
        }

        .description-jumbotron {
            font-size: 21px;
            font-weight: 500;
            padding-left: 140px;
            padding-right: 140px;
        }

        .test {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            width: 100%;
            min-height: 100vh;
            transform: translateX(100vw);
            background-color: white;
            z-index: 9999;
            overflow: hidden;
        }

        #scrolling {
            overflow: auto;
            max-height: 98%;
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        #scrolling::-webkit-scrollbar {
            display: none;
        }

        .test-show {
            animation: slideIn 0.5s forwards;
        }

        @keyframes slideIn {
            from {
                transform: translateX(-100%);
            }

            to {
                transform: translateX(0);
            }
        }

        .test-hide {
            animation: slideOut 0.5s forwards;
        }

        @keyframes slideOut {
            from {
                transform: translateX(0);
            }

            to {
                transform: translateX(-100%);
            }
        }

        .custom-row {
            padding: 0;
            margin: auto;
            display: grid;
            grid-template-columns: repeat(12, 1fr);
            margin: 5px 15px;
            gap: 20px;
            position: relative;
        }

        .left-side-test {
            min-height: 100vh;
            grid-column: span 4;
            margin-top: 60px;
            background-image: url("{{ asset('Enthusiastic.gif') }}");
            background-repeat: no-repeat;
            border-right: 2px solid #e6e6e6;
        }

        .right-side-test {
            min-height: 100vh;
            grid-column: span 8;
        }

        .custom-radio {
            position: relative;
            display: inline-block;
            width: 20px;
            height: 20px;
            margin-right: 10px;
            cursor: pointer;
            border: 1px solid #ccc;
            border-radius: 50%;
            vertical-align: middle;
            transition: all 0.2s ease-in-out;
        }

        form .question .form-check {
            margin-top: 10px;
        }

        form .d-flex button:hover {
            border-radius: 5px;
            border: 1px solid #00a8ff;
            background-color: #f5f5f5;
            color: #337ab7;
            cursor: pointer;
        }

        .contact-us {
            align-items: center;
            min-height: 250px;
            background-color: #cceeff;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
        }

        .footer {
            background-color: #868686;
        }

        .contact-button:hover {
            border: 1px solid #00a8ff;
            background-color: #f5f5f5;
            color: #337ab7;
            cursor: pointer;
        }

        @media (max-width: 576px) {
            .top-jumbotron {
                padding-top: 150px;
            }

            .title-jumbotron {
                font-size: 32px;
            }

            .description-jumbotron {
                padding: 0px;
                font-size: 15px;
            }

            .left-side-test {
                min-height: 25vh;
                grid-column: span 12;
            }

            .close-survey {
                display: block;
            }

            .right-side-test {
                grid-column: span 12;
                margin-top: -20px;
            }
        }

        @media (min-width: 576px) and (max-width: 881px) {
            .left-side-test {
                min-height: 40vh;
                grid-column: span 12;
            }

            .right-side-test {
                grid-column: span 12;
            }
        }

        @media (min-width: 576px) and (max-width: 991px) {
            .top-jumbotron {
                padding-top: 150px;
            }

            .title-jumbotron {
                font-size: 32px;
            }

            .description-jumbotron {
                padding: 0px;
                font-size: 20px;
            }

        }

        @media (min-width: 992px) {
            nav .nav-item {
                margin-right: 2rem;
            }
        }

    </style>
</head>

<!--
    - landing page [https://dribbble.com/shots/9708091-Bizy-Landing-Page/attachments/1737518?mode=media]
    - Mulai survey [https://dribbble.com/shots/9685913-Questionnaire-illustration]
    - kelengkapan [http://www.ansonika.com/wilio/index.html#0]
    - CRUD question [https://dribbble.com/shots/15271186-Survey-components]
-->

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
            <div class="left-side-test">
            </div>
            <div class="right-side-test">
                <div class="d-flex justify-content-end">
                    <button type="button" class="close-survey btn-close m-3 float-right text-reset relative"
                        onclick="closeSurvey()"></button>
                </div>

                <div class="container mt-5 px-5">
                    <h6 class="text-muted d-flex">
                        <p class="number"></p>/<p class="total-question"></p>
                    </h6>
                    <form class="contact-form" action="" method="post">
                        @csrf
                        <div class="mb-3 question form-section">
                            <div class="mb-3">
                                <input type="text" class="form-control" id="name" placeholder="nama">
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" id="name" placeholder="nama">
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" id="name" placeholder="nama">
                            </div>
                            <div class="mb-3">
                                <select class="form-select" aria-label="Default select example" name="location">
                                    <option selected>Select location</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <select class="form-select" aria-label="Default select example" name="question-category">
                                    <option selected>Select test</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3 question form-section">
                            <h4 class="text-black mb-3">Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                                Cumque,
                                aut.</h4>
                            <div class="form-check">
                                <input class="custom-radio" type="radio" name="exampleRadios" id="exampleRadios1"
                                    value="option1" checked>
                                <label class="form-check-label" for="exampleRadios1">
                                    Default radio
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="custom-radio" type="radio" name="exampleRadios" id="exampleRadios2"
                                    value="option2">
                                <label class="form-check-label" for="exampleRadios2">
                                    Second default radio
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="custom-radio" type="radio" name="exampleRadios" id="exampleRadios3"
                                    value="option3">
                                <label class="form-check-label" for="exampleRadios3">
                                    Disabled radio
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="custom-radio" type="radio" name="exampleRadios" id="exampleRadios4"
                                    value="option4">
                                <label class="form-check-label" for="exampleRadios4">
                                    Another radio
                                </label>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between form-navigation">
                            <button type="button" class="cancel m-3 btn shadow btn-primary"
                                onclick="closeSurvey()">Cancel</button>
                            <button type="button" class="previous m-3 btn shadow btn-primary">Previous</button>
                            <button type="button" class="next m-3 btn shadow btn-primary">Next</button>
                            <button type="submit" class="next m-3 btn shadow btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
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

        // form-section
        $(function() {
            var $sections = $('.form-section');

            function navigateTo(index) {
                const number = index + 1;
                $('.number').text(number);

                if (index === 0) {
                    $('.form-navigation .previous').hide();
                    $('.form-navigation .cancel').show();
                } else {
                    $('.form-navigation .previous').show();
                    $('.form-navigation .cancel').hide();
                }
                $sections.removeClass('current').eq(index).addClass('current');
                var atTheEnd = index >= $sections.length - 1;
                $('.form-navigation .next').toggle(!atTheEnd);
                $('.form-navigation [type=submit]').toggle(atTheEnd);
            }

            function curIndex() {
                return $sections.index($sections.filter('.current'));
            }
            $('.form-navigation .previous').click(function() {
                navigateTo(curIndex() - 1);
            });
            $('.form-navigation .next').click(function() {
                $('.contact-form').parsley().whenValidate({
                    group: 'block-' + curIndex()
                }).done(function() {
                    navigateTo(curIndex() + 1);
                });
            });
            $sections.each(function(index, section) {
                $(section).find(':input').attr('data-parsley-group', 'block-' + index);
            });

            navigateTo(0);

            var totalQuestions = $('.form-section').length;
            $('.total-question').text(totalQuestions);
        });
    </script>
</body>

</html>
