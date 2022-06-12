<?php

namespace App\Traits;

trait crudsTraits
{
     function SaveImage($photo)
{
    $image_extension = $photo->getClientOriginalExtension();


     $image = $photo;

       $filename= time().'.'.$image->getClientOriginalName().$image_extension;
       $path='uploads/quiz';
       $photo->move($path,$filename);
     return  $path1='uploads/quiz/' . $filename;

}
function SaveAvatar($photo)
{
    $image_extension = $photo->getClientOriginalExtension();


     $image = $photo;

       $filename= time().'.'.$image->getClientOriginalName().$image_extension;
       $path='uploads/avatar';
       $photo->move($path,$filename);
     return  $path1='uploads/avatar/' . $filename;

}

}






