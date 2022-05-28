<div class="col-lg-12 col-xl-12">
  <form action="{{ route('page.save') }}?lang={{$lang}}" method="POST" onsubmit="return confirm(`@lang('welcome.submit')`);">
    @csrf
    <p class="mb-4 text-dark">
      *@lang('welcome.type.title')
      <input type="hidden" name="step" value="3" required>
    </p>
    <hr>
      <p>{{ $records['title'] }}</p>
      {!! $records['description'] !!}
    <hr>
    @php $i = 1; @endphp
    @foreach ($records['list'] as $key => $record)
      @if (in_array(($key+1), $type))
        <div class="form-group row">
          <label class="col-sm-12 col-form-label">{{ $i++ }}. {{ $record }}</label>
          <input type="hidden" name="title[{{ $key+1 }}]" autocomplete="off" value="{{ $record }}">
          <div class="col-md-12">
            <label class="btn btn-outline-info col-sm-2">
              <input type="radio" name="option[{{ $key+1 }}]" autocomplete="off" value="0" required> 0
            </label>
            <label class="btn btn-outline-info col-sm-2">
              <input type="radio" name="option[{{ $key+1 }}]" autocomplete="off" value="1" required> 1
            </label>
            <label class="btn btn-outline-info col-sm-2">
              <input type="radio" name="option[{{ $key+1 }}]" autocomplete="off" value="2" required> 2
            </label>
            <label class="btn btn-outline-info col-sm-2">
              <input type="radio" name="option[{{ $key+1 }}]" autocomplete="off" value="3" required> 3
            </label>
          </div>
        </div>
      @endif
    @endforeach
    <div class="form-group row">
      <div class="col-sm-12">
        <button type="submit" class="btn btn-info">@lang('welcome.save')</button>
      </div>
    </div>
  </form>
</div>