@extends('layouts.panel')

@section('content')

  <div class="row">
    <div class="col-md-12">

      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Indicadores de Análise Técnica</h3>
          <a href="{{ url('indicator/create') }}" class="btn btn-success pull-right">Novo Indicador</a>
        </div>
        <div class="boxbody">
          @foreach ($indicators as $indicator)
          <div class="post">
            <div class="row">
              <div class="col-sm-9">
                <h3><a>{{ $indicator->name.' ('.$indicator->acronym.')' }}</a>

                   <form class="form pull-right form-delete" method="POST" action="{{ url('indicator/'.$indicator->id) }}" >
                     {{ method_field('DELETE') }}
                     {{ csrf_field() }}
                     <a href="{{ url('indicator/'.$indicator->id.'/edit') }}" class="btn btn-xs btn-primary">Editar</a>
                     <button type="submit" class="btn btn-xs btn-danger" >Excluir</button>
                   </form>
                </h3>
                <p>Tipo de Indicador: <strong>{{ indicatorType($indicator->type) }}</strong></p>
                <p>{!! $indicator->description !!}</p>

              </div>
              <div class="col-sm-3">
                {!! $indicator->getImage() !!}
              </div>
            </div>
          </div>
          @endforeach
        </div>

        <br />
      </div>

    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->

@endsection

@push('scripts')
<script src="{{ asset("/js/form-helper.js") }}"></script>
@endpush
