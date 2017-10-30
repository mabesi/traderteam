@if ($operation->comments->count()>0)
  @if (hasNewCommentsOrAnswers($operation,2))
    <i title="Esta operação possui comentários/respostas nas últimas 2 horas!" class="fa  fa-comments text-red"></i>
  @elseif (hasNewCommentsOrAnswers($operation,12))
    <i title="Esta operação possui comentários/respostas nas últimas 12 horas!" class="fa  fa-comments text-yellow"></i>
  @elseif (hasNewCommentsOrAnswers($operation,24))
    <i title="Esta operação possui comentários/respostas nas últimas 24 horas!" class="fa  fa-comments-o text-green"></i>
  @else
    <i title="Esta operação possui comentários/respostas!" class="fa  fa-comments-o text-muted"></i>
  @endif
@endif
