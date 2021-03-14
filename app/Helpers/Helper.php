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

    public static function payment($user, $amount = 0, $payment_token = '') {
        $url = "https://api.tap.company/v2/charges";

        $body = [
            'amount' => 10,
            'currency' => 'SAR',
            'customer' => array(
                'first_name' =>  $user->name,
                "email" => $user->email,
                "phone" => array("country_code" => 966, "number" => '5098465151')
            ),
            'source' => array("id" => $payment_token),
            'redirect' => array("url" => url('/success_payment'))

//            'amount' => $amount,
//            'currency' => 'SAR',
//            'customer' => [
//                'first_name' => $user->name,
//                'email' => $user->email,
//                'phone' => [
//                    'country_code' => '966',
//                    'number' => $user->phone ? ''.$user->phone : '5098465151',
//                ],
//            ],
//            'source' => [
//                'id' => $payment_token
//            ],
//            'redirect' => [
//                'id' => url('/')
//            ],
        ];
//        $body = '{
//                  "amount": 1,
//                  "currency": "KWD",
//                  "threeDSecure": true,
//                  "save_card": false,
//                  "description": "Test Description",
//                  "statement_descriptor": "Sample",
//                  "metadata": {
//                    "udf1": "test 1",
//                    "udf2": "test 2"
//                  },
//                  "reference": {
//                    "transaction": "txn_0001",
//                    "order": "ord_0001"
//                  },
//                  "receipt": {
//                    "email": false,
//                    "sms": true
//                  },
//                  "customer": {
//                    "first_name": "test",
//                    "middle_name": "test",
//                    "last_name": "test",
//                    "email": "test@test.com",
//                    "phone": {
//                      "country_code": "965",
//                      "number": "50000000"
//                    }
//                  },
//                  "merchant": {
//                    "id": ""
//                  },
//                  "source": {
//                    "id": "'.$payment_token.'"
//                  },
//                  "post": {
//                    "url": "http://your_website.com/post_url"
//                  },
//                  "redirect": {
//                    "url": "http://your_website.com/redirect_url"
//                  }
//                }';
//        $ch = curl_init();
//        curl_setopt($ch, CURLOPT_URL, $url);
//        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
//            'Authorization:Bearer sk_test_XKokBfNWv6FIYuTMg5sLPjhJ'));
////        curl_setopt($ch, CURLOPT_POST, 1);
//        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
//        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//        $responseData = curl_exec($ch);
//        if(curl_errno($ch)) {
//            return curl_error($ch);
//        }
//        curl_close($ch);
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.tap.company/v2/charges",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($body),
            CURLOPT_HTTPHEADER => array(
                "authorization: Bearer sk_test_XKokBfNWv6FIYuTMg5sLPjhJ",
                "content-type: application/json"
            ),
        ));

        $response = curl_exec($curl);
        return json_decode($response, true);
    }

    public static function payment_response($id) {
        $url = "https://api.tap.company/v2/charges/" . $id;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization:Bearer sk_test_vCLBYaJsDTwlIGu3FS8efmtO'));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if(curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);
        return json_decode($responseData, true);
    }

}
