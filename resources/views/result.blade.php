<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Result</title>
</head>

<body>
    <div class="col-lg-12 col-xl-12">
        <p class="mb-4 text-dark">
            @lang('welcome.result.title')
        </p>

        <div class="alert alert-{{ $rujukan === false ? 'info' : 'danger' }}">
            <b>@lang('welcome.profile.name') : {{ $profile['name'] }}</b><br>
            <b>@lang('welcome.profile.age') : {{ $profile['age'] }}</b><br>
            <b>@lang('welcome.profile.profession') : {{ $profile['profession'] }}</b><br>
            <b>@lang('welcome.profile.location') : {{ $profile['location'] }}</b><br>
            <hr>
            <b>@lang('welcome.result.score') : {{ $total }}</b><br>
            <b>@lang('welcome.result.result') : {{ $result }}</b><br>
        </div>

        <hr>

        @if ($rujukan === false)

            <h3 class="text-info text-center">@lang('welcome.suggestion.activity')</h3>
            <div id="accordion">
                @for ($i = 1; $i <= 10; $i++)
                    <br>
                    <div class="card">
                        <div class="card-header" id="heading{{ $i }}">
                            <h5 class="mb-0">
                                <button class="btn btn-link" data-toggle="collapse"
                                    data-target="#collapse{{ $i }}" aria-expanded="true"
                                    aria-controls="collapse{{ $i }}">
                                    <strong>{{ $suggestion[$i]['name'] }} !</strong>
                                </button>
                            </h5>
                        </div>

                        <div id="collapse{{ $i }}" class="collapse {{ $i == 1 ? 'show' : '' }}"
                            aria-labelledby="heading{{ $i }}" data-parent="#accordion">
                            <div class="card-body">
                                {!! $suggestion[$i]['description'] !!}
                            </div>
                        </div>
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

        <hr>
        <a href="/">
            <button type="submit" name="step" value="done"
                class="btn btn-info btn-block">@lang('welcome.done')</button>
        </a>
    </div>
</body>

</html>
