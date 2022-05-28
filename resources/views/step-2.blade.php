<div class="col-lg-12 col-xl-12">
  <form action="{{ route('page.save') }}?lang={{$lang}}" method="POST" onsubmit="return confirm(`@lang('welcome.confirm')`);">
    @csrf
    <p class="mb-4 text-dark">
      *@lang('welcome.type.title')
      <input type="hidden" name="step" value="2" required>
    </p>
    <div class="form-group row">
      <label class="col-sm-4">
        <button type="submit" name="depression" class="btn btn-info btn-block" for="depression" value="depression">@lang('welcome.type.depression')</button>
      </label>

      <label class="col-sm-4">
        <button type="submit" name="stress" class="btn btn-info btn-block" for="stress" value="stress">@lang('welcome.type.stress')</button>
      </label>

      <label class="col-sm-4">
        <button type="submit" name="anxiety" class="btn btn-info btn-block" for="anxiety" value="anxiety">@lang('welcome.type.anxiety')</button>
      </label>
    </div>
  </form>
</div>