<div>
@if($user->profile==Null)
  <span class="user-line">
    {!! getUserAvatar('img-circle','Avatar',$user) !!} {{ $user->name }}
  </span>
  {{ nbsp(2) }}
  <i class="fa fa-star text-gray"></i>
@else
<a class="user-line" href="{{ url('profile/'.$user->profile->id) }}">
  {!! getUserAvatar('img-circle','Avatar',$user) !!} {{ $user->name }}
</a>
{{ nbsp(2) }}
{!! getRankStars($user->rank) !!}
@endif
</div>
