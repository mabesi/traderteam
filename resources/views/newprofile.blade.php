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

            @include('layouts.formprofile')

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
