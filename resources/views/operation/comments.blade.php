<div class="box box-widget">
  <div class="box-header">
    <span class="text-blue font-16">Comentários ({{ $operation->comments->count() }})</span>
  </div>

  <div class="box-footer box-comments">

  @foreach ($operation->comments->sortBy('updated_at')->take(-10) as $comment)
    <div class="box-comment">

      {!! getUserAvatar("img-circle img-sm","Avatar",$comment->user) !!}
      <div class="comment-text">
        <span class="username">
          {{ $comment->user->name }} <small class="text-muted">({{ $comment->answers->count() }} resp.)</small>
          <span class="text-muted pull-right">{{ humanPastTime($comment->updated_at) }}</span>
        </span>

        <div class="box no-border collapsed-box no-margin">
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
      <form action="#" method="post">
        {!! getUserAvatar("img-circle img-sm","Avatar") !!}
        <!-- .img-push is used to add margin to elements next to floating images -->
        <div class="img-push">
          <input class="form-control input-sm" placeholder="Digite um comentário e pressione enter..." type="text">
        </div>
      </form>
    </div>
  </div>

</div>
