@extends('layouts.panel')

@push('css')
<link rel="stylesheet" href="{{ asset('/adminlte2/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
@endpush

@section('content')

      <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Informações do Perfil</h3>
            </div>
            <form class="form-horizontal">

              <div class="form-group">
                <label for="avatar" class="col-sm-3 control-label">Imagem do Perfil</label>

                <div class="col-sm-5">
                  <input id="avatar" name="avatar" class="btn btn-primary" type="file" accept="image/png,image/jpeg"  onchange="readURL(this,'avatarpreview')">
                  <p class="help-block">Imagens permitidas: jpeg, jpg e png. Tamanho máximo: 200KB.</p>
                </div>
                <div class="col-sm-4">
                  <img id="avatarpreview" class="profile-user-img img-responsive img-circle" src="{{ asset('/img/avatar/default.png')}}" />
                </div>
              </div>

              <div class="form-group">
                <label for="mybirthdate" class="col-sm-3 control-label">Data de Nascimento</label>

                <div class="col-sm-9">
                  <input type="date" name="mybirthdate" class="form-control" id="mybirthdate" value="{{ old('mybirthdate') }}" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask="">
                </div>
              </div>

              <div class="form-group">
                <label for="occupation" class="col-sm-3 control-label">Ocupação</label>

                <div class="col-sm-9">
                  <input type="text" value="{{ old('occupation') }}" name="occupation" class="form-control" id="occupation">
                </div>
              </div>
              <div class="form-group">
                <label for="city" class="col-sm-3 control-label">Cidade</label>

                <div class="col-sm-9">
                  <input type="text" name="city" class="form-control" id="city" value="{{ old('city') }}">
                </div>
              </div>
              <div class="form-group">
                <label for="state" class="col-sm-3 control-label">Estado</label>

                <div class="col-sm-3">
                  <input type="text" name="state" class="form-control" id="state" value="{{ old('state') }}">
                </div>
                <label for="country" class="col-sm-3 control-label">País</label>

                <div class="col-sm-3">
                  <input type="text" name="country" class="form-control" id="country" value="{{ old('country') }}">
                </div>
              </div>
              <div class="form-group">
                <label for="mydescription" class="col-sm-3 control-label">Minha Descrição</label>

                <div class="col-sm-9">
                  <textarea class="textarea form-control" name="mydescription" id="mydescription" >{!! old('description') !!}</textarea>
                </div>
              </div>

              <div class="form-group">
                <label for="site" class="col-sm-3 control-label">Site</label>

                <div class="col-sm-9">
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="fa fa-globe"></i>
                    </span>
                    <input class="form-control" id="site" name="site" type="url"  value="{{ old('site') }}">
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
                    <input class="form-control" id="facebook" name="facebook" type="url"  value="{{ old('facebook') }}">
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
                    <input class="form-control" id="twitter" name="twitter" type="url" value="{{ old('twitter') }}">
                  </div>
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                  <button type="submit" class="btn btn-primary">Enviar</button>
                </div>
              </div>
            </form>
            <br />
          </div>

        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

@endsection

@push('scripts')
<script src="{{ asset("/js/img-helper.js") }}"></script>
<script src="{{ asset("/adminlte2/plugins/input-mask/jquery.inputmask.js") }}"></script>
<script src="{{ asset("/adminlte2/plugins/input-mask/jquery.inputmask.date.extensions.js") }}"></script>
<script src="{{ asset("/adminlte2/plugins/input-mask/jquery.inputmask.extensions.js") }}"></script>
<script src="{{ asset("/adminlte2/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js") }}"></script>
<script>
  $(function () {
    $('.textarea').wysihtml5();
    $('[data-mask]').inputmask();
  });
</script>
@endpush
