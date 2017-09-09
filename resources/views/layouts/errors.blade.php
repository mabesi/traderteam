@if (isset($errors) && count($errors) > 0)
<div class="alert alert-danger alert-dismissible">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    @foreach ($errors->all() as $error)
    <p><i class="icon fa fa-ban"></i> {{ $error }}</p>
    @endforeach
</div>
@endif

@if (session('problems'))
<div class="alert alert-danger alert-dismissible">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    @foreach (session('problems') as $problem)
    <p><i class="icon fa fa-ban"></i> {{ $problem }}</p>
    @endforeach
</div>
@endif

@if (session('warnings'))
  <div class="alert alert-warning alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      @foreach (session('warnings') as $warning)
      <p><i class="icon fa fa-warning"></i> {{ $warning }}</p>
      @endforeach
  </div>
@endif

@if (session('informations'))
  <div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      @foreach (session('informations') as $information)
      <p><i class="icon fa fa-check"></i> {{ $information }}</p>
      @endforeach
  </div>
@endif
