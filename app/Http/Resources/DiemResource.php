<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DiemResource extends JsonResource
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
            'id' => $this->id,
            'hocsinh_id' => \App\Http\Resources\DiemHocSinhResource::make($this->diemHocSinh),
            'monhoc_id' => \App\Http\Resources\MonHocResource::make($this->tenMonHoc),
            'HKI' => $this->HKI,
            'HKII' => $this->HKII,
            'ThiLai'=>$this->ThiLai,
            'CaNam' => $this->CaNam
        ];
    }
}
