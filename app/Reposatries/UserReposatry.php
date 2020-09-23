<?php

namespace App\Reposatries;

use App\Http\Controllers\Manage\EmailsController;
use App\Http\Resources\UserResource;
use App\Interfaces\UserInterface;
use App\User;
use Illuminate\Http\Request;
use Validator,Auth,Artisan,Hash,File,Crypt;

class UserReposatry implements UserInterface {
    use \App\Traits\ApiResponseTrait;

    /**
     * @param $request
     * @return User|mixed
     */
    public function register($request)
    {
        $lang = $request->header('lang');
        $user = new User();
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->lat  = $request->lat;
        $user->lng  = $request->lng;
        $user->status  = 0;
        $user->social  = $request->social;
        $user->lang=$lang;
        if(!$request->socail)
            $user->password = Hash::make($request->password);
        if($request->image)
            $user->image=saveImage('users',$request->file('image'));
        $user->save();
        $token = $user->createToken('TutsForWeb')->accessToken;
        $user['token']=$token;
        //EmailsController::verify_email($user->id,$lang);
        return $user;
    }

    /***
     * @param $request
     * @param $user_id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function validate_user($request, $user_id)
    {
        $lang = $request->header('lang');
        $input = $request->all();
        $validationMessages = [
            'first_name.required' => $lang == 'ar' ?  'من فضلك ادخل  اسمك الاول' :"first name is required" ,
            'password.required' => $lang == 'ar' ? 'من فضلك ادخل كلمة السر' :"password is required"  ,
            'password.confirmed' => $lang == 'ar' ? 'كلمتا السر غير متطابقتان' :"The password confirmation does not match"  ,
            'email.required' => $lang == 'ar' ? 'من فضلك ادخل البريد الالكتروني' :"email is required"  ,
            'email.unique' => $lang == 'ar' ? 'هذا البريد الالكتروني موجود لدينا بالفعل' :"email is already teken" ,
            'email.regex'=>$lang=='ar'? 'من فضلك ادخل بريد الكتروني صالح' : 'The email must be a valid email address',
            'phone.required' => $lang == 'ar' ? 'من فضلك ادخل  رقم الهاتف' :"phone is required"  ,
            'phone.unique' => $lang == 'ar' ? 'رقم الهاتف موجود لدينا بالفعل' :"phone is already teken" ,
            'last_name.required' => $lang == 'ar' ?  'من فضلك ادخل رقم اسم العائلة' :"last name name is required" ,
            'phone.min' => $lang == 'ar' ?  'رقم الهاتف يجب ان لا يقل عن 7 ارقام' :"The phone must be at least 7 numbers" ,
            'phone.numeric' => $lang == 'ar' ?  'رقم الهاتف يجب ان يكون رقما' :"The phone must be a number" ,


        ];

        $validator = Validator::make($input, [
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => $user_id ==0 ? 'required|unique:users|min:7|numeric' : 'required|unique:users,phone,'.$user_id.'|min:7|numeric',
            'email' => $user_id ==0 ? 'required|unique:users|regex:/(.+)@(.+)\.(.+)/i' : 'required|unique:users,email,'.$user_id.'|regex:/(.+)@(.+)\.(.+)/i',
            'password' => !$request->social ? 'required|confirmed' : '',
        ], $validationMessages);

        if ($validator->fails()) {
            return $this->apiResponseMessage(0,$validator->messages()->first(), 2500);
        }
    }


    /***
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response|mixed
     */
    public function login($request)
    {
        //return $request->emailOrphone;
        $lang = $request->header('lang');
        $user=User::where('email',$request->emailOrphone)->orWhere('phone',$request->emailOrphone);
        $request->social == 1 ? $user=$user->where('social',1) : '';
        $user=$user->first();
        if(is_null($user))
        {
            $msg=$lang=='ar' ?  'البيانات المدخلة غير موجودة لدينا ':'user does not exist' ;
            return $this->apiResponseMessage( 0,$msg, 200);
        }
        if($request->social !=1) {
            $password = Hash::check($request->password, $user->password);
            if ($password == false) {
                $msg = $lang == 'ar' ? 'كلمة السر غير صحيحة' : 'Password is not correct';
                return $this->apiResponseMessage(0, $msg, 200);
            }
        }
       // $user->token_fire_base($user,$request);
        $token = $user->createToken('TutsForWeb')->accessToken;
        $user['token']=$token;
        $msg=$lang=='ar' ? 'تم تسجيل الدخول بنجاح':'login success' ;
        return $this->apiResponseData(new UserResource($user),$msg,200);
    }


}
