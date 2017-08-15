<?php

function getUserId()
{
  return Auth::user()->id;
}

function getUserName()
{
  return Auth::user()->name;
}

function getUserEmail()
{
  return Auth::user()->email;
}

function getUserAvatarName()
{
  return Auth::user()->avatar;
}

function getUserAvatar($class="img-circle",$alt="Foto do Perfil")
{
  $img = "<img src='".asset("/storage/avatar/".Auth::user()->avatar)."'";
  $img .=" class='$class' alt='$alt' />";

  return $img;
}
