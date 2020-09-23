<?php

namespace App\Traits;

trait ApiResponseTrait
{

    public function apiResponseData($data = null, $message = null, $code = 200)
    {

        return response()->json(['status'=>1, 'data'=>$data,'message'=>$message],200);
    }


    public function apiResponseMessage( $status,$message = null,$code = 200)
    {
        $array = [
            'status' =>  $status,
            'message' => $message,
            'data'=>null,
        ];
        return response($array, 200);
    }

    public function not_found($array,$arabic,$english,$lang){
        if(is_null($array)){
            $msg=$lang=='ar' ? $arabic . ' غير موجود' : $english .' not found';
            return response()->json(['status'=>0,'message'=>$msg,'data'=>null],200);
        }
    }

    /**
     * @param $lang
     * @return \Illuminate\Http\JsonResponse
     */
    public function not_found_v2($lang){
        $msg=$lang=='en' ? 'data not found' : 'الداتا غير موجودة';
        return response()->json(['status'=>0,'message'=>$msg,'data'=>null],200);
    }

    /**
     * @param string $lang
     * @param int $type
     * @return string
     */
    public function Message($lang,int $type)
    {
        $msg=$lang=='en' ? 'edited successfully' :'تم التعديل بنجاح'  ;
        if($type==1)
            $msg=$lang=='en' ? 'added successfully' :'تمت الاضافة بنجاح'  ;
        return $msg;
    }

}
