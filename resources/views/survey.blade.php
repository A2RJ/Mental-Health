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

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f5f5f5;
        }

        .container {
            min-height: 100vh;
            background-color: white;
            margin-left: 250px;
            margin-right: 250px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .question {
            margin-bottom: 20px;
        }

        /* on small screen min 0 - 1024px */
        @media (min-width: 0px) and (max-width: 1024px) {
            .container {
                margin-left: 0px;
                margin-right: 0px;
            }

            label {
                font-size: 10px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="question-center" style="width: 80%">
            <h6 class="text-muted d-flex float-left">
                <p class="number"></p>/<p class="total-question"></p>
            </h6>
            <form class="question-form" action="{{ route('survey.store') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="mb-3 form-section">
                    <p>{{ $records['title'] }}</p>
                    {!! $records['description'] !!}
                </div>
                <input type="hidden" name="name" value="{{ $biodata['name'] }}">
                <input type="hidden" name="age" value="{{ $biodata['age'] }}">
                <input type="hidden" name="occupation" value="{{ $biodata['occupation'] }}">
                <input type="hidden" name="location" value="{{ $biodata['location'] }}">
                <input type="hidden" name="category" value="{{ $biodata['category'] }}">
                <input type="hidden" name="locale" value="{{ $locale }}">

                @foreach ($questions as $question)
                    <div class="mb-3 form-section">
                        <h3 class="question">{{ $question->question }}</h3>
                        <div class="text-danger"></div>
                        <div class="form-check">
                            <input class="custom-radio" type="radio" name="option{{ $loop->iteration }}"
                                id="option1" value="0" required>
                            <label class="form-check-label" for="option1">
                                {{ $records['options'][0] }}
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="custom-radio" type="radio" name="option{{ $loop->iteration }}"
                                id="option2" value="1" required>
                            <label class="form-check-label" for="option2">
                                {{ $records['options'][1] }}
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="custom-radio" type="radio" name="option{{ $loop->iteration }}"
                                id="option3" value="2" required>
                            <label class="form-check-label" for="option3">
                                {{ $records['options'][2] }}
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="custom-radio" type="radio" name="option{{ $loop->iteration }}"
                                id="option3" value="3" required>
                            <label class="form-check-label" for="option3">
                                {{ $records['options'][3] }}
                            </label>
                        </div>
                    </div>
                @endforeach

                <div class="d-flex justify-content-between form-navigation">
                    <button type="button" class="cancel m-3 btn shadow btn-primary"
                        onclick="closeSurvey()">@lang('welcome.cancel')</button>
                    <button type="button" class="previous m-3 btn shadow btn-primary">@lang('welcome.prev')</button>
                    <button type="button" class="next m-3 btn shadow btn-primary">@lang('welcome.next')</button>
                    <button type="submit" class="next m-3 btn shadow btn-primary">@lang('welcome.save')</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function closeSurvey() {
            window.location.href = "/";
        }

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
                $('.question-form').parsley().whenValidate({
                    group: 'block-' + curIndex()
                }).done(function() {
                    $('.parsley-errors-list').empty();
                    $('.current .text-danger').empty();
                    navigateTo(curIndex() + 1);
                }).fail(function() {
                    $('.parsley-errors-list').empty();
                    $('.current .text-danger').empty();
                    $('.current .text-danger').append(
                        '<p class="text-danger">{{ $records['validation'] }}</p>');
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
