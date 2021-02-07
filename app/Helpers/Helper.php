<?php

namespace App\Helpers;

use App\Models\Category;

class Helper {

    /**
     * Response data
     * return response as json in specific format includes message code and description
     * 
     * @param string $message
     * @param boolean $status
     * @param mixed $data
     * @param string $messageString
     * @param integer $returnCode
     */
    public static function responseData($message = 'success',$status = true,$data = false,$messageString = false,$returnCode = 200){
        $returnCode = ($status === false && $returnCode == 200) ? 403 : $returnCode;

        if($messageString === false){
            $messageString = ($status === true) ? __('default.success_message.default') : __('default.error_message.default');
        }

        $response = ['message' => $message,'message_string' => $messageString,'status' => $status];
        if($data !== false){
            $response['data'] = $data;
        }
        return response()->json($response,$returnCode);
    }

    /**
     * Response validation error
     * 
     * @param array $errors
     */
    public static function responseValidationError($errors){
        return self::responseData('invalid_fields',false,['errors' => $errors],__('default.error_message.invalid_fields'));
    }


    /**
     * Clean array values if has value contains specific seperator
     * 
     * @param array $Items
     * @param string $Seperator
     */
    public static function cleanArraySeperator($Items,$Seperator){
        $newArray = [];
        if(is_array($Items)){
            foreach($Items as $Item){
                $newArray[] = str_replace($Seperator,'',$Item);
            }
        }
        return $newArray;
    }

    public static function getMainCategoriesType($all = false,$lang = 'ar'){
        $categories_ar = ['technical' => 'تقنية','consultation' => 'استشارات','training' => 'تدريب'];
        $categories_en = ['technical' => 'Technical','consultation' => 'Consultation','training' => 'Training'];
        if($all){
            $categories_ar['all'] = 'الكل';
            $categories_en['all'] = 'All';
        }
        if($lang == 'en'){
            return $categories_en;
        }
        return $categories_ar;
    }

    public static function getCategories(){
        $categories = Category::selectCard()->get();
        return $categories;
    }

}
