@php
  $more = request('comments',10);
  $totalComments = $operation->comments->count();
  $extra = 10;
  if ($extra>$totalComments-$more){
    $extra = $totalComments-$more;
  }
  $commentId = request('comment',-1);
  $amore = request('answers',10);
@endphp

<div class="box box-widget">
  <div id="comment-0" class="box-header">
    <span class="text-navy font-16">
       @if ($totalComments>$more)
         Comentários ({{ $more.'/'.$operation->comments->count() }})
         <a class="font-12" href="{{ url('operation/'.$operation->id.'?comment=0&comments='.($more+$extra)) }}">Carregar mais...</a>
       @else
         Comentários ({{ $operation->comments->count() }})
       @endif
     </span>
  </div>

  <div id="operation-comments" class="box-footer box-comments">

  @foreach ($operation->comments->sortBy('updated_at')->take(-$more) as $comment)

@php
$commentAnswers=$comment->answers->count();
@endphp

    <div id="comment-{{ $comment->id }}" class="box-comment">

      {!! getUserAvatar("img-circle img-sm","Avatar",$comment->user) !!}
      <div class="comment-text">
        <span class="username">
          {!! getUserLink($comment->user,True) !!} <small class="text-muted">({{ $commentAnswers.($commentAnswers>1?' respostas':' resposta') }})
@if ($commentAnswers>$amore)
          <a class="font-12" href="{{ url('operation/'.$operation->id.'?comment='.$comment->id.'&comments='.($more+$extra)).'&answers='.$commentAnswers }}">Ver todas...</a>
@endif
          </small>
          <span class="text-muted pull-right">
            {{ humanPastTime($comment->updated_at) }}
            {!! nbsp(4).getReportUserIcon($comment->user).nbsp(2) !!}
@if (isAdmin() || $comment->user_id==getUserId())
            {{ nbsp(2) }}
            <a href="{{ url('comment/'.$comment->id) }}" data-resource="False" class="delete-button" data-token="{{ csrf_token() }}" data-previous="{{ URL::previous() }}">
              <i class="fa text-danger fa-trash"></i>
            </a>
@endif
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

  {!! br(50) !!}

</div>

@if ($commentId>=0)
@push('scripts')
<script type="text/javascript">
$(document).ready(function() {
  var comment = $('{{ "#comment-".$commentId }}');
  $('html,body').animate({
    scrollTop: comment.offset().top
  },700);
});
</script>
@endpush
@endif
