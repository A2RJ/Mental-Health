<div class="col-lg-12 col-xl-12">
  <form action="{{ route('page.save') }}?lang={{$lang}}" method="POST" onsubmit="return confirm(`@lang('welcome.confirm')`);">
    @csrf
    <p class="mb-4 text-dark">
      *@lang('welcome.profile.title')
      <input type="hidden" name="step" value="1" required>
    </p>
    <div class="form-group row">
      <label for="name" class="col-sm-2 col-form-label text-right">@lang('welcome.profile.name')</label>
      <div class="col-sm-9">
        <input type="name" name="name" class="form-control" id="name" placeholder="@lang('welcome.profile.name')" required autocomplete="off">
      </div>
    </div>
    <div class="form-group row">
      <label for="age" class="col-sm-2 col-form-label text-right">@lang('welcome.profile.age')</label>
      <div class="col-sm-9">
        <input type="number" name="age" class="form-control" id="age" placeholder="@lang('welcome.profile.age')" required autocomplete="off">
      </div>
    </div>
    <div class="form-group row">
      <label for="profession" class="col-sm-2 col-form-label text-right">@lang('welcome.profile.profession')</label>
      <div class="col-sm-9">
        <input type="text" name="profession" class="form-control" id="profession" placeholder="@lang('welcome.profile.profession')" required autocomplete="off">
      </div>
    </div>
    <div class="form-group row">
      <label for="location" class="col-sm-2 col-form-label text-right">@lang('welcome.profile.location')</label>
      <div class="col-sm-9">
        <select name="location" class="form-control" id="location" placeholder="@lang('welcome.profile.location')" required autocomplete="off">
          <option value="" disabled="" selected="">@lang('welcome.profile.location')</option>
          @foreach ($location as $value)
            <option value="{{ $value->name }}">{{ $value->name }}</option>
          @endforeach
        </select>
      </div>
    </div>
    <div class="form-group row">
      <div class="col-sm-2">
      </div>
      <div class="col-sm-9">
        <button type="submit" class="btn btn-info">@lang('welcome.next')</button>
      </div>
    </div>
  </form>
</div>