<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GiaoVienBoMonResource extends JsonResource
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
            'gv_id' => \App\Http\Resources\GiaoVienResource::make($this->getGV),
            'monhoc_id' => \App\Http\Resources\MonHocResource::make($this->getMonHoc),
            'namhoc'=>$this->namhoc,
        ];
    }
}
