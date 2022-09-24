<?php

//app/Http/Controllers/Controller.php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
 /**
     * @OA\Info(
     *      version="1.0.0",
     *      title="Demo Dokumentasi API Blanjaloka",
     *      description="Dokumentasi dengan UI Swagger",
     *
     *)
     **/

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}


