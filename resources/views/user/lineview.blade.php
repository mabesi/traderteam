<div>
@if($user->profile==Null)
  <span class="user-line">
    {!! getUserAvatar('img-circle','Avatar',$user) !!} {{ $user->name }}
  </span>
@else
<a class="user-line" href="{{ url('profile/'.$user->profile->id) }}">
  {!! getUserAvatar('img-circle','Avatar',$user) !!} {{ $user->name }}
</a>
@endif
</div>
