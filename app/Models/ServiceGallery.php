<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Storage;

class ServiceGallery extends Model
{
  protected $table = 'services_gallery';
  protected $appends = [
    'is_video','full_path','thumb_path'
  ];
  protected $hidden = ['service_id'];

  /**
   * Get full path
   */
  public function getFullPathAttribute(){
    return Storage::url('services/gallery/'.$this->path);
  }

  /**
   * Get thumb path
   */
  public function getThumbPathAttribute(){
    if(preg_match('/\.(jpg|jpeg|png|bmp|gif)(?:[\?\#].*)?$/i', $this->path)){
      return Storage::url('services/thumbs/'.$this->path);
    }else {
      return null;
    }
  }

  /**
   * Get is video
   */
  public function getIsVideoAttribute(){
    $result = false;
    if(!preg_match('/\.(jpg|jpeg|png|bmp|gif)(?:[\?\#].*)?$/i', $this->path)){
      $result = true;
    }
    return $result;
  }

}
