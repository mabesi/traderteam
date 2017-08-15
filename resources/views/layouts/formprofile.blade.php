<form class="form-horizontal" action="{{ url('/profile'.(isset($profile->id)?'/'.$profile->id:'')) }}" method="POST" enctype="multipart/form-data">

  {{ csrf_field() }}

@if (isset($profile->id))
  <input type="hidden" name="_method" value="PUT">
@endif

  <div class="form-group">
    <label for="avatar" class="col-sm-3 control-label">Imagem do Perfil</label>

    <div class="col-sm-5">
      <input id="avatar" name="avatar" class="btn btn-primary" type="file" accept="image/png,image/jpeg"  onchange="readURL(this,'avatarpreview')">
      <p class="help-block">Imagens permitidas: jpeg, jpg e png. Tamanho máximo: 200KB.</p>
    </div>
    <div class="col-sm-4">
      <img id="avatarpreview" class="profile-user-img img-responsive img-circle" src="{{ asset('/storage/avatar/'.getUserAvatarName())}}" />
    </div>
  </div>

  <div class="form-group">
    <label for="mybirthdate" class="col-sm-3 control-label">Data de Nascimento</label>

    <div class="col-sm-9">
      <input type="date" name="mybirthdate" class="form-control" id="mybirthdate" value="{{ old('mybirthdate',isset($profile->birthdate)?getBRDateFromMysql($profile->birthdate):Null) }}" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask="">
    </div>
  </div>

  <div class="form-group">
    <label for="occupation" class="col-sm-3 control-label">Ocupação</label>

    <div class="col-sm-9">
      <input type="text" value="{{ old('occupation',isset($profile->occupation)?$profile->occupation:Null) }}" name="occupation" class="form-control" id="occupation">
    </div>
  </div>
  <div class="form-group">
    <label for="city" class="col-sm-3 control-label">Cidade</label>

    <div class="col-sm-9">
      <input type="text" name="city" class="form-control" id="city" value="{{ old('city',isset($profile->city)?$profile->city:Null) }}">
    </div>
  </div>
  <div class="form-group">
    <label for="state" class="col-sm-3 control-label">Estado</label>

    <div class="col-sm-3">
      <input type="text" name="state" class="form-control" id="state" value="{{ old('state',isset($profile->state)?$profile->state:Null) }}">
    </div>
    <label for="country" class="col-sm-3 control-label">País</label>

    <div class="col-sm-3">
      <input type="text" name="country" class="form-control" id="country" value="{{ old('country',isset($profile->country)?$profile->country:Null) }}">
    </div>
  </div>
  <div class="form-group">
    <label for="mydescription" class="col-sm-3 control-label">Minha Descrição</label>

    <div class="col-sm-9">
      <textarea class="textarea form-control" name="mydescription" id="mydescription" >{!! old('description',isset($profile->description)?$profile->description:Null) !!}</textarea>
    </div>
  </div>

  <div class="form-group">
    <label for="site" class="col-sm-3 control-label">Site</label>

    <div class="col-sm-9">
      <div class="input-group">
        <span class="input-group-addon">
          <i class="fa fa-globe"></i>
        </span>
        <input class="form-control" id="site" name="site" type="url"  value="{{ old('site',isset($profile->site)?$profile->site:Null) }}">
      </div>
    </div>
  </div>

  <div class="form-group">
    <label for="facebook" class="col-sm-3 control-label">Facebook</label>

    <div class="col-sm-9">
      <div class="input-group">
        <span class="input-group-addon">
          <i class="fa fa-facebook"></i>
        </span>
        <input class="form-control" id="facebook" name="facebook" type="url"  value="{{ old('facebook',isset($profile->facebook)?$profile->facebook:Null) }}">
      </div>
    </div>
  </div>

  <div class="form-group">
    <label for="twitter" class="col-sm-3 control-label">Twitter</label>

    <div class="col-sm-9">
      <div class="input-group">
        <span class="input-group-addon">
          <i class="fa fa-twitter"></i>
        </span>
        <input class="form-control" id="twitter" name="twitter" type="url" value="{{ old('twitter',isset($profile->twitter)?$profile->twitter:Null) }}">
      </div>
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-3 col-sm-9">
      <button type="submit" class="btn btn-primary">{{ (isset($profile->id)?'Salvar':'Enviar') }} </button>
    </div>
  </div>
</form>
