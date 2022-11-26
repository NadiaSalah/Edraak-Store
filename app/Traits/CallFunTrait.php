<?php

namespace App\Traits;

use App\Models\MainCategory;
use App\Models\Size;



trait CallFunTrait
{
  public function imgPath($imgReq, $imgFolder)
  {
    $extention = strip_tags($imgReq->extension());
    $img_name = time() . '.' . $extention;
    $path = 'assets/images/' . $imgFolder . '/';
    $imgReq->move($path, $img_name);
    return  $path . $img_name;
  }

 
}
