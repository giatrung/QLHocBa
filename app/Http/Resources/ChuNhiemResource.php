<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ChuNhiemResource extends JsonResource
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
            'gv_id' => $this->gv_id,
            'lop_id' => \App\Http\Resources\LopResource::make($this->getLop),
            'namhoc'=>$this->namhoc,
        ];
    }
}
