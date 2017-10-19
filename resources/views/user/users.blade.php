@extends('layouts.panel')

@section('content')

      <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">
                Relação de Usuários ({{ $totalUsers.' no total' }})

                {!! $followLabel !!}
              </h3>
              <a class="pull-right" href="{{ url('user/myfollowers') }}">
                <button type="button" class="btn btn-sm btn-success" name="button">Meus Seguidores</button>
              </a>
              <a class="pull-right" href="{{ url('user/following') }}">
                <button type="button" class="btn btn-sm btn-danger" name="button">Seguindo</button>
                {{ nbsp(2) }}
              </a>
              <a class="pull-right" href="{{ url('users') }}">
                <button type="button" class="btn btn-sm btn-primary" name="button">Exibir Todos</button>
                {{ nbsp(2) }}
              </a>
            </div>
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tbody>
                  <tr>
                    <th>Tipo</th>
                    <th>Rank <a href="?sort=rank&dir={{ ($sort=='rank'?$newDir:'desc') }}">
                      <i class="fa fa-sort-amount-{{ ($sort=='rank'?$newDir:'desc') }}"></i></a></th>
                    <th>
                      <div class="col-xs-5">
                        Nome <a href="?sort=name&dir={{ ($sort=='name'?$newDir:'asc') }}">
                          <i class="fa fa-sort-alpha-{{ ($sort=='name'?$newDir:'asc') }}"></i></a>

                      </div>
                      <div class="col-xs-7">
                        <form class="" action="{{ url('users') }}" method="get">
                          <div class="input-group input-group-sm" style="width:150px;">
                            <input type="text" name="search" class="form-control" placeholder="Pesquisar Nome">
                            <div class="input-group-btn">
                              <button type="submit" class="btn btn-default">
                                <i class="fa fa-search"></i>
                              </button>
                            </div>
                          </div>
                        </form>
                      </div>

                    </th>

                    <th>Ocupação</th>
                    <th>Localização</th>
                    <th>Estratégias <a href="?sort=strategies_count&dir={{ ($sort=='strategies_count'?$newDir:'desc') }}">
                      <i class="fa fa-sort-amount-{{ ($sort=='strategies_count'?$newDir:'desc') }}"></i></a></th>
                    <th>Operações <a href="?sort=operations_count&dir={{ ($sort=='operations_count'?$newDir:'desc') }}">
                      <i class="fa fa-sort-amount-{{ ($sort=='operations_count'?$newDir:'desc') }}"></i></a></th>
                    <th>Seguidores <a href="?sort=followers_count&dir={{ ($sort=='followers_count'?$newDir:'desc') }}">
                      <i class="fa fa-sort-amount-{{ ($sort=='followers_count'?$newDir:'desc') }}"></i></a></th>
                      <th>Registro <a href="?sort=created_at&dir={{ ($sort=='created_at'?$newDir:'desc') }}">
                        <i class="fa fa-sort-amount-{{ ($sort=='created_at'?$newDir:'desc') }}"></i></a></th>
                  </tr>
@foreach ($users as $user)
                  <tr>
                  <td class="text-center text-bold">{!! getUserTypeLabel($user->type) !!}</td>
                  <td>{!! getRankStars($user->rank) !!}</td>
                  <td>
                     {!! getUserLine($user) !!}
                     {{ nbsp(2) }}
                     {!! getUserAdminIcons($user,'False') !!}
                  </td>
                  <td>{!! getFieldOrQuestion($user->profile,'occupation',True) !!}</td>
                  @if($user->profile==Null)
                  <td><i class="fa fa-question text-gray"></i></td>
                @else
                  @if ($user->profile->city==Null)
                    <td><i class="fa fa-question text-gray"></i></td>
                  @else
                    <td>{!! nameInitials($user->profile->city,2,True).
                          ($user->profile->state==Null?'':', '.nameInitials($user->profile->state,1,True)).
                          ($user->profile->country==Null?'':' - '.$user->profile->country) !!}
                    </td>
                  @endif
                @endif
                <td><a href="{{ url('strategies/user/'.$user->id) }}">{{ $user->strategies->count() }}</a></td>
                <td><a href="{{ url('operations/user/'.$user->id) }}">{{ $user->operations->count() }}</a></td>
                    <td><a href="{{ url('user/'.$user->id.'/followers') }}">{{ $user->followers->count() }}</a></td>
                    <td>{{ getBRDateFromMysql($user->created_at,True) }}</td>
                  </tr>
@endforeach
                </tbody>
              </table>
            </div>
            <div class="box-footer">
              {{ $users->links() }}
            </div>
          </div>

        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

@endsection

@push('scripts')
<script src="{{ asset("/js/form-helper.js") }}"></script>
@endpush
