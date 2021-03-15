<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image,Validator, Helper;
use Illuminate\Support\Facades\Storage;


class UploaderController extends Controller
{

  public $file_path;
  public $full_path;
  public $allowedFileExtensions = 'jpeg,jpg,png,gif';
  public $folder = 'images';
  public $thumbFolder = 'thumbs';

  public function upload($q,$is_image = true,$image_width = 0,$image_height = 0,$thumb_width = 0,$thumb_height = 0){
    if(!isset($q->only('file')['file'])){
      return Helper::responseData('failed',false);
    }
    $validator = validator()->make(['file' => $q->only('file')['file']], [
      'file' => (($this->allowedFileExtensions) ? 'mimes:'.$this->allowedFileExtensions.'|' : '').'required'
    ]);
    if ($validator->fails())
    {
      return Helper::responseValidationError($validator->messages());
    }

    $disk = 'public';
    $file = $q->file;
    $fileName = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();
    $filePath = $this->folder.'/'.$fileName;

    // Upload Image
    if($is_image){

      if($image_width || $image_height){
        $resizeImage = Image::make(file_get_contents($file));

        if($image_width && $resizeImage->width() > $image_width && !$image_height){
          $resizeImage->resize($image_width,null,function($constraint) {
            $constraint->aspectRatio();
          });
        }elseif(!$image_width && $image_height){
          if ($resizeImage->height() > $image_height) {
            $resizeImage->resize(null,$image_height,function($constraint) {
              $constraint->aspectRatio();
            });
          }
        }elseif($image_width && $thumb_height) {
          $resizeImage->resize($image_width,$image_height);
        }

        Storage::disk($disk)->put($filePath, $resizeImage->encode());
      }else {
        Storage::disk($disk)->put($filePath, file_get_contents($file));
      }
      /* Make Thumbnail */
      if($thumb_width || $thumb_height){
        $ThumbImage = Image::make(file_get_contents($file));
        $thumbFileName = $fileName;

        if($thumb_width && $ThumbImage->width() > $thumb_width && !$thumb_height){
          $ThumbImage->resize($thumb_width,null,function($constraint) {
            $constraint->aspectRatio();
          });
        }elseif(!$thumb_width && $thumb_height){
          if ($ThumbImage->height() > $thumb_height) {
            $ThumbImage->resize(null,$thumb_height,function($constraint) {
              $constraint->aspectRatio();
            });
          }
        }elseif($thumb_width && $thumb_height) {
          $ThumbImage->resize($thumb_width,$thumb_height);
        }

        Storage::disk($disk)->put($this->thumbFolder.'/'.$thumbFileName, $ThumbImage->encode());
      }
    }else {
      // Upload File
      Storage::disk($disk)->put($filePath,file_get_contents($file));
    }

    return Helper::responseData('success',true,[
      'file_path' => Storage::disk($disk)->url($filePath),
      'path' => $fileName
    ]);
  }

  public function postUpload($type,Request $request){
    switch ($type) {
      case 'user-avatar':
        $this->folder = 'users/avatars';
        return $this->upload($request,true,0,256);
      break;
      case 'service-image':
        $this->folder = 'services/gallery';
        $this->thumbFolder = 'services/thumbs';
        return $this->upload($request,true,1000,0,320);
      break;
      case 'service-video':
        $this->folder = 'services/gallery';
        $this->allowedFileExtensions = 'mp4';
        return $this->upload($request,false);
      break;
      case 'attachment':
        $this->folder = 'attachments';
        // $docsExt = 'pdf,doc,docx,ppt,pptx,xls,xlsx,csv,xml,tif,tiff,rtf,txt';
        // $audioAndVideoExt = 'mp3,m4a,wav,mp4,m4v,mpg,wmv,mov,avi,swf';
        // $otherExt = 'zip,rar,rtf,ps,psd,eps,prn,html,odt,odp,ods,odg,odf,sxw,sxi,sxc,sxd,stw,pdf,ai,indd,u3d,prc,dwg,dwt,dxf,dwf,dst,xpsmpp,vsd,xd';
        // $this->allowedFileExtensions = $this->allowedFileExtensions.','.$docsExt.','.$audioAndVideoExt.','.$otherExt;
        $this->allowedFileExtensions = null; // allow all extensions
        return $this->upload($request,false);
      break;
    }
  }


    public function uploadSingle($file, $is_image = true, $image_width = 0, $image_height = 0, $thumb_width = 0, $thumb_height = 0)
    {

        if ($is_image)
            $validator = validator()->make(['file' => $file], [
                'file' => (($this->allowedFileExtensions) ? 'mimes:' . $this->allowedFileExtensions . '|' : '') . 'required'
            ]);
        else
            $validator = validator()->make(['file' => $file], [
                'file' => (($this->allowedFileExtensions) ? 'mimes:' . $this->allowedFileExtensions . ',pdf,docx|' : '') . 'required'
            ]);

            if ($validator->fails()) {
                return Helper::responseValidationError($validator->messages());
            }

        $disk = 'public';
        $file = $file;
        $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $filePath = $this->folder . '/' . $fileName;

        // Upload Image
        if ($is_image) {

            if ($image_width || $image_height) {
                $resizeImage = Image::make(file_get_contents($file));

                if ($image_width && $resizeImage->width() > $image_width && !$image_height) {
                    $resizeImage->resize($image_width, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                } elseif (!$image_width && $image_height) {
                    if ($resizeImage->height() > $image_height) {
                        $resizeImage->resize(null, $image_height, function ($constraint) {
                            $constraint->aspectRatio();
                        });
                    }
                } elseif ($image_width && $thumb_height) {
                    $resizeImage->resize($image_width, $image_height);
                }

                Storage::disk($disk)->put($filePath, $resizeImage->encode());
            } else {
                Storage::disk($disk)->put($filePath, file_get_contents($file));
            }
            /* Make Thumbnail */
            if ($thumb_width || $thumb_height) {
                $ThumbImage = Image::make(file_get_contents($file));
                $thumbFileName = $fileName;

                if ($thumb_width && $ThumbImage->width() > $thumb_width && !$thumb_height) {
                    $ThumbImage->resize($thumb_width, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                } elseif (!$thumb_width && $thumb_height) {
                    if ($ThumbImage->height() > $thumb_height) {
                        $ThumbImage->resize(null, $thumb_height, function ($constraint) {
                            $constraint->aspectRatio();
                        });
                    }
                } elseif ($thumb_width && $thumb_height) {
                    $ThumbImage->resize($thumb_width, $thumb_height);
                }

                Storage::disk($disk)->put($this->thumbFolder . '/' . $thumbFileName, $ThumbImage->encode());
            }
        } else {
            // Upload File
            Storage::disk($disk)->put($filePath, file_get_contents($file));
        }

        return [
            'file_path' => Storage::disk($disk)->url($filePath),
            'path' => $fileName
        ];
    }


}
