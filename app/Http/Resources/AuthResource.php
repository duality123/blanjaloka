<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AuthResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    protected $dataUser;
    protected $messageForUser;

    public function __construct($data,$message){
        parent::__construct($data);
    }
    public function toArray($request)
    {   
        $data['data'] = $this->dataUser;
        $data['meta']['message'] = $this->messageForUser;

        return $data;
    }


}
