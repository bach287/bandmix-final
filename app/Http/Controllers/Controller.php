<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function uploadFile($file)
    {
        $clientFileName = $file->getClientOriginalName();
        $info = pathinfo($clientFileName);
        $ext = $info['extension'];
        $path = "/uploads/avatar";
        $fileName = str_random(10).time().'.'.$ext;
        $file->move(public_path($path),$fileName);
        return $path.'/'.$fileName;
    }
    
}
