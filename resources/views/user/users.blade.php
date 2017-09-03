@extends('layouts.panel')

@section('content')

      <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">
                Relação de Usuários ({{ ($follow=='followers'?'Seguidores: ':($follow=='following'?'Seguindo: ':'')).$totalUsers.' no total' }})
              </h3>
              <a class="pull-right" href="{{ url('users?follow=followers') }}">
                <button type="button" class="btn btn-sm btn-success" name="button">Seguidores</button>
              </a>
              <a class="pull-right" href="{{ url('users?follow=following') }}">
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
                    <th>Rank <a href="?sort=level&dir={{ ($sort=='level'?$newDir:'desc') }}">
                      <i class="fa fa-sort-amount-{{ ($sort=='level'?$newDir:'desc') }}"></i></a></th>
                    <th>
                      <div class="col-xs-5">
                        Nome <a href="?sort=name&dir={{ ($sort=='name'?$newDir:'asc') }}">
                          <i class="fa fa-sort-amount-{{ ($sort=='name'?$newDir:'asc') }}"></i></a>

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
                  <td class="text-center text-bold">{{ $user->type }}</td>
                @if($user->profile==Null)
                  <td><i class="fa fa-star text-gray"></i></td>
                  <td>
                    <span class="user-line">{!! getUserAvatar('img-circle','Avatar',$user) !!}</span>
                     {{ $user->name }}
                     @if (Auth::user()->type=='S' || Auth::user()->type=='A')
                       {{ nbsp(1) }}
                       <a class="text-danger" href="{{ url('user/'.$user->id.'/delete') }}"><i class="fa fa-trash"></i></a>
                     @endif
                  </td>
                  <td><i class="fa fa-question text-gray"></i></td>
                  <td><i class="fa fa-question text-gray"></i></td>
                @else
                  <td class='text-yellow'>{!! getLevelStars($user->profile->level) !!}</td>
                  <td>
                    <a class="user-line" href="{{ url('profile/'.$user->profile->id) }}">
                      {!! getUserAvatar('img-circle','Avatar',$user) !!} {{ $user->name }}
                    </a>
                    @if (Auth::user()->type=='S' || Auth::user()->type=='A')
                      {{ nbsp(2) }}
                        <a href="{{ url('profile/'.$user->profile->id.'/edit') }}"><i class="fa fa-pencil"></i></a>
                      {{ nbsp(1) }}
                        <a class="text-danger" href="{{ url('user/'.$user->id.'/delete') }}"><i class="fa fa-trash"></i></a>
                    @endif
                  </td>
                  <td>{{ $user->profile->occupation }}</td>
                  <td>{{ $user->profile->city.', '.$user->profile->state }}</td>
                @endif
                    <td><a href="{{ url('user/'.$user->id.'/strategies') }}">{{ $user->strategies->count() }}</a></td>
                    <td><a href="{{ url('user/'.$user->id.'/operations') }}">{{ $user->operations->count() }}</a></td>
                    <td><a href="{{ url('user/'.$user->id.'/followers') }}">{{ $user->followers->count() }}</a></td>
                    <td>{{ getBRDateFromMysql($user->created_at,True) }}</td>
                  </tr>
@endforeach
                </tbody>
              </table>
            </div>
            <div class="box-footer">
              {{ $users->appends(['sort' => $sort,'dir' => $dir,'follow' => $follow])->links() }}
            </div>
          </div>

        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

@endsection