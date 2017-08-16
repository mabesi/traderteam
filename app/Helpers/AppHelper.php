<?php

use Illuminate\Support\Facades\Auth;

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
  $src = asset("/storage/avatar/".Auth::user()->avatar);

  return getHtmlImage($src,$class,$alt);
}

function getHtmlImage($src,$class=Null,$alt=Null,$id=Null,$title=Null,$width=Null,$height=Null,$style=Null)
{
  $img = "<img src='".$src."'";

  if ($id != Null){
    $img .=" id='$id'";
  }

  if ($class != Null){
    $img .=" class='$class'";
  }

  if ($title != Null){
    $img .=" title='$title'";
  }

  if ($alt != Null){
    $img .=" alt='$alt'";
  }

  if ($width != Null){
    $img .=" width='$width'";
  }

  if ($height != Null){
    $img .=" height='$height'";
  }

  if ($style != Null){
    $img .=" style='$style'";
  }

  $img .=" />";

  return $img;
}
