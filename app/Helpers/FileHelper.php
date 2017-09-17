<?php

use Illuminate\Support\Facades\Storage;

function saveImage($request,$fieldName,$dir,$imageName,$oldName=Null,$default=Null)
{
  if ($request->hasFile($fieldName)){

    if ($request->file($fieldName)->isValid()) {

      $image = $request->file($fieldName);
      $imageName = strtolower($imageName.'.'.$image->getClientOriginalExtension());
      $pathImage = $image->storeAs($dir, $imageName, 'public');

      if ($oldName != Null){
        $oldPath = $dir.'/'.$oldName;
        $defaultPath = $dir.'/'.$default;
        if ($pathImage != $oldPath && $oldPath != $defaultPath){
          Storage::disk('public')->delete($oldPath);
        }
      }
      return $imageName;
    }
  }
  return false;
}

function deleteAvatar($avatar)
{
  deleteFile('avatar/'.$avatar);
}

function deleteFile($file)
{
  if ($file!='avatar/default.png' && $file!='operations/loading.gif' && $file!='indicators/loading.gif'){
    Storage::disk('public')->delete($file);
  }
}

function deleteDir($dir)
{
  if ($dir!='avatar' && $dir!='operations' && $dir!='indicators'){
    Storage::disk('public')->deleteDirectory($dir);
  }
}
