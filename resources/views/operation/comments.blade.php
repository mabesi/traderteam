@php
  $more = request('comments',15);
  $totalComments = $operation->comments->count();
  $commentId = request('comment',0);
@endphp

<div class="box box-widget">
  <div class="box-header">
    <span class="text-navy font-16">
       @if ($totalComments>$more)
         Comentários ({{ $more.'/'.$operation->comments->count() }})
         <a class="font-12" href="{{ url('operation/'.$operation->id.'?comments='.($more+15)) }}">Carregar mais...</a>
       @else
         Comentários ({{ $operation->comments->count() }})
       @endif
     </span>
  </div>

  <div id="operation-comments" class="box-footer box-comments">

  @foreach ($operation->comments->sortBy('updated_at')->take(-$more) as $comment)
    <div id="comment-{{ $comment->id }}" class="box-comment">

      {!! getUserAvatar("img-circle img-sm","Avatar",$comment->user) !!}
      <div class="comment-text">
        <span class="username">
          {{ $comment->user->name }} <small class="text-muted">({{ $comment->answers->count() }} resp.)</small>
          <span class="text-muted pull-right">
            {{ humanPastTime($comment->updated_at) }}
            {{ nbsp(4) }}
            <a href="{{ url('comment/'.$comment->id) }}" data-resource="False" class="delete-button" data-token="{{ csrf_token() }}" data-previous="{{ URL::previous() }}">
              <i class="fa text-danger fa-trash"></i>
            </a>
          </span>
        </span>

        <div class="box no-border {{ ($commentId==$comment->id?'':'collapsed-box') }} no-margin">
          <div class="box-header">
            {{ $comment->content }}

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
              </button>
            </div>
          </div>
          <div class="box-body no-padding no-margin">
            @include('operation.answers')
          </div>
        </div>

      </div>
      <!-- /.comment-text -->

    </div>
  @endforeach

    <div class="box-footer">
      <form action="{{ url('operation/'.$operation->id.'/addcomment') }}" method="post">
        {{ csrf_field() }}
        {!! getUserAvatar("img-circle img-sm","Avatar") !!}
        <!-- .img-push is used to add margin to elements next to floating images -->
        <div class="img-push">
          <input class="form-control input-sm" placeholder="Digite um comentário e pressione enter..."
           type="text" name="content" >
        </div>
      </form>
    </div>
  </div>

  {!! br(0) !!}

</div>
