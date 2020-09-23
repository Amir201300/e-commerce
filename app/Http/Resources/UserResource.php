<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Controllers\Manage\BaseController;


class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'phone' => $this->phone,
            'email' => $this->email,
            'status' => (int)$this->status,
            'social'=>(int)$this->social,
            'notification'=>$this->notification ? 1 : 0,
            'message'=>$this->message ? 1 : 0,
            'lang'=>$this->lang,
            'lat' => $this->lat,
            'lng' => $this->lng,
           // 'orders'=>OrderResource::collection($this->orders),
            'image' => getImageUrl('users',$this->image),
            'token' => $this->token,
        ];
    }
}
