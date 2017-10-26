@push('css')
<link rel="stylesheet" href="{{ asset('/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
@endpush

<form class="form-horizontal" action="{{ url('/profile'.(isset($profile->id)?'/'.$profile->id:'')) }}" method="POST" enctype="multipart/form-data">

{{ csrf_field() }}

@if (isset($profile->id))
  <input type="hidden" name="_method" value="PUT">
@endif

<div class="form-group">
  <div class="col-sm-3">
  </div>
  <div class="col-sm-9">
    <p class="text-muted">
      Todas as informações são opcionais.
    </p>
  </div>
</div>

  <div class="form-group">
    <label for="avatar" class="col-sm-3 control-label">Imagem do Perfil</label>

    <div class="col-sm-5">
      <input id="avatar" name="avatar" class="btn btn-primary imagepreview" type="file"
       accept="image/png,image/jpeg" max-size="204800">
      <p class="help-block">Imagens permitidas: jpeg, jpg e png. Tamanho máximo: 200KB.</p>
    </div>
    <div class="col-sm-4">
      <img class="profile-user-img img-responsive img-circle avatar"
       src="{{ asset('/storage/avatar/'.getUserAvatarName($user))}}" />
    </div>
  </div>

  <div class="form-group">
    <label for="mybirthdate" class="col-sm-3 control-label">Data de Nascimento</label>

    <div class="col-sm-9">
      <input type="text" name="mybirthdate" class="form-control" id="mybirthdate" value="{{ old('mybirthdate',isset($profile->birthdate)?getBRDateFromMysql($profile->birthdate):Null) }}"
          placeholder="dd/mm/aaaa" >
    </div>
  </div>

  <div class="form-group">
    <label for="occupation" class="col-sm-3 control-label">Ocupação</label>

    <div class="col-sm-9">
      <input type="text" value="{{ old('occupation',isset($profile->occupation)?$profile->occupation:Null) }}"
       name="occupation" class="form-control" id="occupation" placeholder="Sua profissão. Ex: Médico, Empresário, Motorista...">
    </div>
  </div>
  <div class="form-group">
    <label for="city" class="col-sm-3 control-label">Cidade</label>

    <div class="col-sm-9">
      <input type="text" name="city" class="form-control" id="city"
       value="{{ old('city',isset($profile->city)?$profile->city:Null) }}" placeholder="Ex: Brasília, São Paulo, Bahia...">
    </div>
  </div>
  <div class="form-group">
    <label for="state" class="col-sm-3 control-label">Estado</label>

    <div class="col-sm-3">
      <input type="text" name="state" class="form-control" id="state"
       value="{{ old('state',isset($profile->state)?$profile->state:Null) }}" placeholder="Sigla do Estado. Ex: DF">
    </div>
    <label for="country" class="col-sm-3 control-label">País</label>

    <div class="col-sm-3">
      <input type="text" name="country" class="form-control" id="country" maxlength="2"
       value="{{ old('country',isset($profile->country)?$profile->country:'') }}" placeholder="Sigla do País. Ex: BR">
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
        <input class="form-control" id="site" name="site" type="url"  value="{{ old('site',isset($profile->site)?$profile->site:Null) }}" placeholder="http://www.nomedoseusite.com.br" >
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
        <input class="form-control" id="facebook" name="facebook" type="url"  value="{{ old('facebook',isset($profile->facebook)?$profile->facebook:Null) }}" placeholder="https://www.facebook.com/seunomedeusuario" >
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
        <input class="form-control" id="twitter" name="twitter" type="url" value="{{ old('twitter',isset($profile->twitter)?$profile->twitter:Null) }}" placeholder="https://twitter.com/seunomedeusuario" >
      </div>
    </div>
  </div>

@if (isSuperAdmin() || $user->id == getUserId())
  <div class="form-group">
    <label for="capital" class="col-sm-3 control-label">Capital</label>

    <div class="col-sm-9">
      <div class="input-group">
        <span class="input-group-addon">
          <i class="fa fa-money"></i>
        </span>
        <input class="form-control" id="capital" name="capital" type="number" min="1000" max="100000000" step="0.01" value="{{ old('capital',isset($profile->capital)?$profile->capital:Null) }}">
      </div>
      <small class="text-muted text-justify">Obs: Valor real ou arbitrário, usado para estatísticas. Mínimo:1.000,00 | Máximo 100.000.000,00.
                                 Caso não seja informado, será utilizado o valor fictício de 100.000,00. Este valor será utilizado
                                 como restrição no montante de suas operações. Somente você poderá ver esta informação.</small>
    </div>
  </div>
@endif

@if (isAdmin())

  <hr>
  <div class="form-group">
    <label for="type" class="col-sm-3 control-label"><span class="label bg-yellow font-14">Confirmado (Email)</span></label>

    <div class="col-sm-9">
      <input type="checkbox" name="confirmed" value="1" {{ ($user->confirmed?'CHECKED':'') }}>
    </div>
  </div>

  <div class="form-group">
    <label for="type" class="col-sm-3 control-label"><span class="label bg-red font-14">Bloqueado</span></label>

    <div class="col-sm-9">
      <input type="checkbox" name="locked" value="1" {{ ($user->locked?'CHECKED':'') }}>
    </div>
  </div>

@endif

@if (isSuperAdmin())

  <hr>
  <div class="form-group">
    <label for="cofounder" class="col-sm-3 control-label"><span class="label bg-blue font-14">Co-Fundador</span></label>

    <div class="col-sm-9">
      <input type="checkbox" name="cofounder" value="1" {{ ($profile->cofounder?'CHECKED':'') }}>
    </div>
  </div>

  <div class="form-group">
    <label for="type" class="col-sm-3 control-label">Tipo de Usuário *</label>

    <div class="col-sm-9">
      <div class="radio">
        <label>
          <input id="typeU" name="type" value="U" type="radio" {{ ((isset($user->type)?$user->type:'')=='U'?'checked':'') }} >
          <span class=" label bg-gray">Usuário</span>
        </label>
      </div>
      <div class="radio">
        <label>
          <input id="typeA" name="type" value="A" type="radio" {{ ((isset($user->type)?$user->type:'')=='A'?'checked':'') }} >
          <span class=" label bg-red">Administrador</span>
        </label>
      </div>
      <div class="radio">
        <label>
          <input id="typeS" name="type" value="S" type="radio" {{ ((isset($user->type)?$user->type:'')=='S'?'checked':'') }} >
          <span class=" label bg-black">Super Administrador</span>
        </label>
      </div>
    </div>
  </div>
@endif

  <div class="form-group">
    <div class="col-sm-offset-3 col-sm-9">
      <button type="submit" class="btn btn-primary">{{ (isset($profile->id)?'Salvar':'Enviar') }} </button>
    </div>
  </div>
</form>

@push('scripts')
<script src="{{ asset("/js/form-helper.js") }}"></script>
<script src="{{ asset("/js/img-helper.js") }}"></script>
<script src="{{ asset("/adminlte/plugins/input-mask/jquery.inputmask.js") }}"></script>
<script src="{{ asset("/adminlte/plugins/input-mask/jquery.inputmask.date.extensions.js") }}"></script>
<script src="{{ asset("/adminlte/plugins/input-mask/jquery.inputmask.extensions.js") }}"></script>
<script src="{{ asset("/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js") }}"></script>
<script>
  $(function () {
    $('.textarea').wysihtml5();
    //$('[data-mask]').inputmask();
  });
</script>
@endpush
