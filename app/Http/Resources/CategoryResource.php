<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $num=$this->products()->count();

        //dd($num);
        return [
            'id'    =>   $this->id,
            'name' => $this->name,
            'date_of_registration'=>$this->date_of_registration,
            'num_of_product'=>$this->products()->count()
        ];
    }
}
