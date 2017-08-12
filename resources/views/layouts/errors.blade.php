@if (isset($errors))
  @if (count($errors)>0)
  <div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      @foreach ($errors as $error)
      <p><i class="icon fa fa-ban"></i> {{ $error }}</p>
      @endforeach
  </div>
  @endif
@endif

@if (isset($warnings))
  @if (count($warnings)>0)
  <div class="alert alert-warning alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      @foreach ($warnings as $warning)
      <p><i class="icon fa fa-warning"></i> {{ $warning }}</p>
      @endforeach
  </div>
  @endif
@endif

@if (isset($informations))
  @if (count($informations)>0)
  <div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      @foreach ($informations as $information)
      <p><i class="icon fa fa-check"></i> {{ $information }}</p>
      @endforeach
  </div>
  @endif
@endif
