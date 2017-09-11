<form class="pad form-horizontal" action="{{ url('/profile/'.$profile->id.'/configurations') }}" method="POST" >

  {{ csrf_field() }}

<div class="row">

  <div class="col-md-6">
    <div class="form-group">

      <div class="checkbox">
        <label>
          <input type="checkbox" name="sidebar_closed" value="1" {{ ($profile->sidebar_closed?'CHECKED':'') }}>
          Recolher Barra Lateral
        </label>
      </div>

    </div>
  </div>

  <div class="col-md-6">

  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="form-group">
        <button type="submit" class="btn btn-danger">Salvar</button>
    </div>
  </div>
</div>
</form>
