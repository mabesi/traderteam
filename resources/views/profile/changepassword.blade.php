<form class="form-horizontal" action="{{ url('/user/'.$user->id.'/changepassword') }}" method="POST" >

  {{ csrf_field() }}

  <div class="col-sm-3">
  </div>
  <div class="col-sm-9">
    <p class="text-muted">
@if (isAdmin())
  <i><b>Administrador:</b> No campo <b>Senha Atual</b> insira a sua senha, mesmo que esteja alterando a senha de outro usuário.</i>
@else
  Todos os campos marcados com * são obrigatórios.
@endif
    </p>
  </div>

  <div class="form-group">
    <label for="password" class="col-sm-3 control-label">Senha Atual *</label>

    <div class="col-sm-9">
      <input type="password" name="password" class="form-control" id="password" required>
    </div>
  </div>

  <div class="form-group">
    <label for="newpassword" class="col-sm-3 control-label">Nova Senha *</label>

    <div class="col-sm-9">
      <input type="password" name="newpassword" class="form-control" id="newPassword" required>
    </div>
  </div>
  <div class="form-group">
    <label for="newpassword_confirmation" class="col-sm-3 control-label">Confirme a Senha *</label>

    <div class="col-sm-9">
      <input type="password" name="newpassword_confirmation" class="form-control" id="confirmPassword" required>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-3 col-sm-9">
      <button type="submit" class="btn btn-danger">Alterar</button>
    </div>
  </div>
</form>
