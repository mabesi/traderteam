@foreach ($users as $user)
    <div class="col-sm-10 col-offset-2 top-5">
        {!! getUserLine($user) !!}
    </div>
@endforeach
