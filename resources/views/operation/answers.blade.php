<div class="box box-widget">
  <div class="box-footer box-comments">
  @foreach ($comment->answers->take(-$amore) as $answer)
    <div id="answer-{{ $answer->id }}" class="box-comment">
      {!! getUserAvatar("img-circle img-sm","Avatar",$answer->user) !!}
      <div class="comment-text">
        <span class="username">
          {!! getUserLink($answer->user,True) !!}
          <span class="text-muted pull-right">
            {{ humanPastTime($answer->updated_at) }}
            {!! nbsp(4).getReportUserIcon($answer->user).nbsp(2) !!}
@if ((isAdmin() || $answer->user_id==getUserId()) && isNotSuperAdmin($answer->user))
            {{ nbsp(4) }}
            <a href="{{ url('answer/'.$answer->id) }}" data-resource="False" class="delete-button" data-token="{{ csrf_token() }}" data-previous="{{ URL::previous() }}">
              <i class="fa text-danger fa-trash"></i>
            </a>
@endif
          </span>
        </span>
        {{ $answer->content }}
      </div>
      <!-- /.comment-text -->
    </div>
  @endforeach

    <div class="box-footer no-padding no-margin">
      <form action="{{ url('comment/'.$comment->id.'/addanswer') }}" method="post">
        {{ csrf_field() }}
        {!! getUserAvatar("img-circle img-sm","Avatar") !!}
        <!-- .img-push is used to add margin to elements next to floating images -->
        <div class="img-push">
          <input class="form-control input-sm" placeholder="Digite uma resposta e pressione enter..."
           type="text" name="content">
        </div>
      </form>
    </div>
  </div>

</div>
