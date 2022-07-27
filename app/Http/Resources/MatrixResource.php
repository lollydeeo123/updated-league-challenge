<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MatrixResource extends JsonResource
{
    public static $wrap = 'echo';
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     * 
     */
    public function toArray($request)
    {
        //dd($request);
        $echo = parent::toArray($request);
        $ech = implode($echo,',');
        
        //'echo'  =>$this->filedata_array;
       
        return [
            // print_r($echo)
           //json_encode($echo)
           $echo
            ];
        
        // return [
        //     'echo'=>$request->echo, 
        //     'sum'=>$request->sum,

            
        // ];
    }
}
