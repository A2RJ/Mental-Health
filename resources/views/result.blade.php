<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Result</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-xl-12">
                <h3 class="mb-4 text-dark text-center mt-5">
                    @lang('welcome.result.title')
                </h3>

                <div class="alert alert-{{ $rujukan === false ? 'info' : 'danger' }}">
                    <b>@lang('welcome.profile.name') : {{ $profile['name'] }}</b><br>
                    <b>@lang('welcome.profile.age') : {{ $profile['age'] }}</b><br>
                    <b>@lang('welcome.profile.profession') : {{ $profile['occupation'] }}</b><br>
                    <b>@lang('welcome.profile.location') : {{ $location }}</b><br>
                    <hr>
                    <b>@lang('welcome.result.score') : {{ $total }}</b><br>
                    <b>@lang('welcome.result.result') : {{ $result }}</b><br>
                </div>

                <hr>

                @if ($rujukan === false)

                    <h3 class="text-info text-center">@lang('welcome.suggestion.activity')</h3>
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        @for ($i = 1; $i <= 10; $i++)
                            <div class="accordion-item">
                                <h2 class="accordion-header border" id="flush-headingOne{{ $i }}">
                                    <button class="accordion-button <?= $i === 1 ? '' : 'collapsed' ?>" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#flush-collapseOne{{ $i }}"
                                        aria-expanded="false" aria-controls="flush-collapseOne{{ $i }}">
                                        {{ $suggestion[$i]['name'] }} !
                                    </button>
                                </h2>
                                <div id="flush-collapseOne{{ $i }}"
                                    class="accordion-collapse  <?= $i === 1 ? '' : 'collapse' ?>"
                                    aria-labelledby="flush-headingOne{{ $i }}"
                                    data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">{!! $suggestion[$i]['description'] !!}</div>
                                </div>
                        @endfor
                    </div>

                    <br>
                    <i>@lang('welcome.suggestion.disclaimer')</i>
                @else
                    <h3 class="text-info text-center">@lang('welcome.find_hospital')</h3>
                    @foreach ($rujukan as $rs)
                        <br>
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">
                                    <b>{{ $rs->rumah_sakit }}</b>
                                </h5>
                            </div>

                            <div class="card-body">
                                {!! nl2br($rs->description) !!}
                            </div>

                            <div class="card-footer">
                                Website : <a href="{{ $rs->website }}">{{ $rs->website }}</a>
                            </div>
                        </div>
                    @endforeach

                @endif
                <div class="float-end my-5 ">
                    <a href="/">
                        <button type="submit" name="step" value="done"
                            class="btn btn-info btn-block">@lang('welcome.done')</button>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
</body>

</html>
