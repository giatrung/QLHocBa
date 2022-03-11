<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DiemHocSinhResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'STT'=>$this->STT,
            'Ho'=>$this->Ho,
            'Ten'=>$this->Ten,
            'NgaySinh'=>$this->NgaySinh,
            'DiaChi'=>$this->DiaChi,
            'TenLop'=>$this->TenLop,
            'NamHoc'=>$this->NamHoc,
        ];;
    }
}
