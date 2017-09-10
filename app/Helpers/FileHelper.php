<?php

use Illuminate\Support\Facades\Storage;

function saveImage($request,$fieldName,$dir,$imageName,$oldName=Null,$default=Null)
{
  //dd($oldName);
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
