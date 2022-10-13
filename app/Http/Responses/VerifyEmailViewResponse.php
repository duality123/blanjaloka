<?php

namespace App\Http\Responses;

use Illuminate\Contracts\Support\Responsable as ResponsableContract;

class VerifyEmailViewResponse implements ResponsableContract
{
    public function toResponse($request)
    {

        return $request->wantsJson()
            ? response()->json(['two_factor' => false])
            : redirect()->intended('/dashboard/pengguna/admin');
    }
}
