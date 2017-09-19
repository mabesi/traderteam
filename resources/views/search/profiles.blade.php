@foreach ($profiles as $profile)
    <div class="col-sm-10 col-offset-2 top-5">
        {!! getUserLine($profile->user) !!} - {{ $profile->occupation }} - {{ $profile->city }} - {{ $profile->state }} - {{ $profile->country }}
    </div>
@endforeach
