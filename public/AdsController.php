<?php

namespace App\Http\Controllers\Api\WebServ;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator,Auth,Artisan;
use App\Models\Ads;
use App\Models\Section;
use App\Http\Resources\AdsResource;
use App\Http\Controllers\Api\Admin\BaseController;
use App\Http\Controllers\Api\Admin\ImagesController;
use App\Http\Controllers\Api\WebServ\RateingController;
use App\Models\Category;
use App\Models\City;
use App\Models\ads_pakages;
use App\Http\Resources\ads_pakagesResource;

class AdsController extends Controller
{
    use ApiResponseTrait;

    public function getAds(Request $request,$categoriesid)
    {
        $page = $request->page;
        $cat=Category::find($categoriesid);
        $Ads = Ads::where('categoriesid', $categoriesid)->where('type',$request->type)->where('status', 1)->skip($page * 20)->take(20)->get();
        $lang = $request->header('lang');
        $msg = $lang == 'ar' ? 'تمت العملية بنجاح' : 'Success';

        return response()->json(['data'=>adsResource::collection($Ads),'status'=>true,'message'=>$msg]);
    }


    public function my_ad(Request $request)
    {
        $user=Auth::user();
        $page = $request->page;
        $Ads = Ads::where('client_id', $user->id)->where('status', 1)->skip($page * 20)->take(20)->get();
        $lang = $request->header('lang');
        $msg = $lang == 'ar' ? 'تمت العملية بنجاح' : 'Success';
        return response()->json(['data'=>adsResource::collection($Ads),'status'=>true,'message'=>$msg]);

    }


    public  function  getSingleAds(Request $request,$Ads_id)
    {

        $lang = $request->header('lang');
        $Ads = Ads::find($Ads_id);
        if(is_null($Ads))
        {
            $msg=$lang=='ar' ? 'هذا المحل غير موجود' : 'this Ads not found';
            return $this->apiResponseError($msg,404);
        }
        $msg = $lang == 'ar' ? 'تمت العملية بنجاح' : 'Success';
        //return 1;
        return $this->apiResponseSuccess(new adsResource($Ads), $msg);
    }

    // Add Ad

    public function add_ad(Request $request)
    {
        $lang = $request->header('lang');
        $user=Auth::user();
            if(is_null($user))
            {
            $msg=$lang=='ar' ? 'هذا العضو غير موجود' : 'this user not found';
            return $this->apiResponseError($msg,404);
            }
            $input = $request->all();
            $validationMessages = [
                'name.required' => $lang == 'en' ? "name is required" : 'من فضلك ادخل  اسم المنتج',
                'categoriesid.required' => $lang == 'en' ? "category is required" : 'من فضلك ادخل القسم',
                'city_id.required'=>$lang == 'en' ? "city is required" : 'من فضلك ادخل المدينة',
                'name.required' => $lang == 'en' ? "price is required" : 'من فضلك ادخل  سعر المنتج',

            ];

            $validator = Validator::make($input, [
                'name' => 'required',
                'city_id'=>'required',
                'price'=>'required',
                'categoriesid'=>'required'
            ], $validationMessages);
            if ($validator->fails()) {
                return $this->apiResponseError( $validator->messages()->first(), 401);
            }
            $city=City::find($request->city_id);
            if(is_null($city))
            {
                $msg=$lang=='ar' ? 'City not exist' : 'المدينة غير موجودة';
                return $this->apiResponseError( $msg, 404);
            }
            if($city->main == 0){
                $msg=$lang=='ar' ? 'cannot add user to country please choose city' : ' لا يمكن اضافة المستخدم الي دولة من فضلك اختار مدينة ';
                return $this->apiResponseError( $msg, 404);
    
            }
            $Category=Category::find($request->categoriesid);
            if(is_null($Category))
            {
                $msg=$lang=='ar' ? 'Category not exist' : 'القسم  غير موجودة';
                return $this->apiResponseError( $msg, 404);
            }
            $style=$request->type == 1 ?4 : 1;
            if(!$Category->isRoleSection($style)){
                $msg=$lang=='ar' ? 'cannot add in this Category' : 'لا يمكن الاضافة في هذا القسم';
                return $this->apiResponseError( $msg, 404);
            }
            $Ads=new Ads;
            if($lang=='ar'){
                $Ads->name_ar=$request->name;
                $Ads->desc_ar=$request->desc;
            }else{
                $Ads->name_en=$request->name;
                $Ads->desc_en=$request->desc;
            }
            $Ads->categoriesid=$request->categoriesid;
            $Ads->city_id=$request->city_id;
            $Ads->lat=$request->lat;
            $Ads->lang=$request->lang;
            $Ads->price=$request->price;
            $Ads->client_id=$user->id;
            $Ads->type=$request->type;
            $Ads->status=2;
            $Ads->rate=0;
            $Ads->period=$request->period;
            $Ads->period_type=$request->period_type;
    
            if($request->icon)
            {
                $name=BaseController::addImage('Ads',$request->file('icon'));
                $Ads->icon=$name;
            }
            $Ads->save();
            if($request->images){
                for($i=0;$i<count($request->images);$i++)
                {
                    ImagesController::saveImageFromApi($request->images[$i],$Ads->id,2);
                }
            }
            $msg = $lang == 'ar' ? 'تم اضافة الاعلان بنجاح ... بانتظار موافقة الادارة  ' : 'The Ad was added successfully, pending the approval of the Administration';
            //return 1;
            return $this->apiResponseSuccess(new AdsResource($Ads), $msg);
    }


    public function delete_my_ad(Request $request,$ad_id)
    {
        $lang = $request->header('lang');
        $user=Auth::user();
            if(is_null($user))
            {
            $msg=$lang=='ar' ? 'هذا العضو غير موجود' : 'this user not found';
            return $this->apiResponseError($msg,404);
            }
        $ad=Ads::find($ad_id);
        if(is_null($ad))
        {
        $msg=$lang=='ar' ? 'هذا الاعلان غير موجود' : 'this Ad not found';
        return $this->apiResponseError($msg,404);
        }
        if($ad->client_id == $user->id)
        {
            BaseController::deleteFile('Ads',$ad->icon);
            foreach($ad->images as $row)
            {
                BaseController::deleteFile('Images',$row->file);
                $row->delete();

            }
            $ad->delete();
            $msg=$lang=='ar' ? 'تم حذف الاعلان بنجاح' : 'Ad deleted successfully';
            return response()->json(['status'=>true,'message'=>$msg]);

        }
        $msg=$lang=='ar' ? 'هذا الاعلان لا يخصك' : 'this Ad not belongs to you';
        return $this->apiResponseError($msg,404);

    }

    // Add Rate
    public function rate(Request $request,$ad_id)
    {
        $lang = $request->header('lang');
        $user=Auth::user();
        if(is_null($user))
        {
        $msg=$lang=='ar' ? 'هذا العضو غير موجود' : 'this user not found';
        return $this->apiResponseError($msg,404);
        }
        $ad=Ads::find($ad_id);
        if(is_null($ad))
        {
        $msg=$lang=='ar' ? 'هذا الاعلان غير موجود' : 'this Ad not found';
        return $this->apiResponseError($msg,404);
        }
        $rate=RateingController::save_rate($request->comment,$ad->id,2,$request->rate,$user->id);
        //return $rate;
        $ad->rate=$rate;
        $ad->save();
        $msg=$lang=='ar' ? 'تم اضافة التقييم بنجاح' : 'rate added successfully';
        return response()->json(['status'=>true,'message'=>$msg]);

    }
      // Add Rate
      public function fav(Request $request,$ad_id)
      {
        $lang = $request->header('lang');
        $user=Auth::user();
        if(is_null($user))
        {
        $msg=$lang=='ar' ? 'هذا العضو غير موجود' : 'this user not found';
        return $this->apiResponseError($msg,404);
        }
        $ad=Ads::find($ad_id);
        if(is_null($ad))
        {
        $msg=$lang=='ar' ? 'هذا الاعلان غير موجود' : 'this Ad not found';
        return $this->apiResponseError($msg,404);
        }
          $fav=RateingController::save_fav($ad->id,2,$user->id);
       
          if ($fav==1) {
            $msg=$lang=='ar' ? 'تم اضافة الاعلان الي المفضلة بنجاح' : 'an ad has been added successfully to your WhisList';
        }else{
            $msg=$lang=='ar' ? 'تم ازالة الاعلان الي المفضلة بنجاح' : 'Ad deleted successfully from your WhisList';

        }         
         return response()->json(['status'=>true,'message'=>$msg]);

      }


          //package
    public function get_packages(Request $request,$ad_id)
    {
        $lang = $request->header('lang');
        $Ad=Ads::find($ad_id);
        if(is_null($Ad))
        {
        $msg=$lang=='ar' ? 'هذا الاعلان غير موجود' : 'this Ad not found';
        return $this->apiResponseError($msg,404);
        }
        $city=City::find($Ad->city_id);
        $packages=ads_pakages::where('city_id',$city->main)->where('status',1)->get();
        $msg = $lang == 'ar' ? 'تمت العملية بنجاح' : 'Success';
        //return 1;
        return $this->apiResponseSuccess(ads_pakagesResource::collection($packages), $msg);

    }

    public function add_ad_to_package(Request $request,$ad_id)
    {
        $lang = $request->header('lang');
        $input = $request->all();
        $validationMessages = [
            'payment_method.required' => $lang == 'en' ? "payment method is required" : 'من فضلك ادخل طرية الدفع',
            'package_id.required' => $lang == 'en' ? "package is required" : 'من فضلك ادخل الباقة المراد الاشتراك بها',
        ];

        $validator = Validator::make($input, [
            'payment_method' => 'required',
            'package_id'=>'required'
        ], $validationMessages);
        if ($validator->fails()) {
            return $this->apiResponseError( $validator->messages()->first(), 401);
        }
        $ad=Ads::find($ad_id);
        if(is_null($ad))
        {
        $msg=$lang=='ar' ? 'هذا الاعلان غير موجود' : 'this ad not found';
        return $this->apiResponseError($msg,404);
        }
        $package=ads_pakages::where('id',$request->package_id)->first();
        if(is_null($package))
        {
        $msg=$lang=='ar' ? 'الباقة  غير موجود' : 'this package not found';
        return $this->apiResponseError($msg,404);
        }
        $ad->pakage_id=$request->package_id;
        $ad->payment_method=$request->payment_method;
        $ad->status=3;
        $ad->save();
        $msg = $lang == 'ar' ? 'تم  الاشتراك بنجاح ... بانتظار موافقة الادارة  ' : ' Subscription successful, pending the approval of the Administration';
        return response()->json(['message'=>$msg,'status'=>true],200);

    }


}
