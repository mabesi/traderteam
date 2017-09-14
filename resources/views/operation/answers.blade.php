<div class="box box-widget">
  <div class="box-footer box-comments">
  @foreach ($comment->answers->take(10) as $answer)
    <div class="box-comment">
      {!! getUserAvatar("img-circle img-sm","Avatar",$answer->user) !!}
      <div class="comment-text">
        <span class="username">
          {{ $answer->user->name }}
          <span class="text-muted pull-right">{{ humanPastTime($answer->updated_at) }}</span>
        </span>
        {{ $answer->content }}
      </div>
      <!-- /.comment-text -->
    </div>
  @endforeach

    <div class="box-footer no-padding no-margin">
      <form action="#" method="post">
        {!! getUserAvatar("img-circle img-sm","Avatar") !!}
        <!-- .img-push is used to add margin to elements next to floating images -->
        <div class="img-push">
          <input class="form-control input-sm" placeholder="Digite uma resposta e pressione enter..." type="text">
        </div>
      </form>
    </div>
  </div>

</div>
