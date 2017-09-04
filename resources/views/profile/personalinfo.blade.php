<strong><i class="fa fa-birthday-cake margin-r-5"></i> {{ humanPastTime($profile->birthdate) }}</strong>
<p class="text-muted">
  Aniversário em {{ birthday($profile->birthdate,true) }}
</p>

<strong><i class="fa fa-briefcase margin-r-5"></i> Ocupação</strong>
<p class="text-muted">
  {{ $profile->occupation }}
</p>

<strong><i class="fa fa-map-marker margin-r-5"></i> Localização</strong>
<p class="text-muted">
  {{ $profile->city.(isset($profile->state)?', ':'').$profile->state.(isset($profile->country)?' - ':'').$profile->country }}
</p>

<strong><i class="fa fa-commenting margin-r-5"></i> Quem Sou Eu?</strong>
<p class="text-muted text-justify">
  {!! $profile->description !!}
</p>

<strong><i class="fa fa-globe margin-r-5"></i> Site</strong>
<p class="text-muted text-justify">
  <a href="{!! $profile->site !!}" target="_blank" >{!! $profile->site !!}</a>
</p>

<strong><i class="fa  fa-facebook-square margin-r-5"></i> Facebook</strong>
<p class="text-muted text-justify">
  <a href="{!! $profile->facebook !!}" target="_blank" >{!! $profile->facebook !!}</a>
</p>

<strong><i class="fa  fa-twitter-square margin-r-5"></i> Twitter</strong>
<p class="text-muted text-justify">
  <a href="{!! $profile->twitter !!}" target="_blank" >{!! $profile->twitter !!}</a>
</p>

@if ($profile->user_id == getUserId())
<strong><i class="fa  fa-money margin-r-5"></i> Capital de Investimento</strong> <small class="text-muted">(* Somente você vê isto!)</small>
<p class="text-muted text-justify">
  {{ formatCurrency($profile->capital) }}
</p>
@endif
