@php
  $now = date('Y-m-d H:i:s');;
  $yesterday = alterDate($now,"Y-m-d H:i:s",-1,0,0,True);
@endphp

@if ($operation->comments->count()>0)
  @if ($operation->comments->where('created_at', '>=', $yesterday)->count()>0)
    <i title="Esta operação possui comentários nas últimas 24 horas!" class="fa  fa-comments text-green"></i>
  @else
    <i title="Esta operação possui comentários!" class="fa  fa-comments-o text-muted"></i>
  @endif
@endif
