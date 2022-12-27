<?php

namespace App\Http\Middleware;
use Inertia\Inertia;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class shouldInvestor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        if($request->user()->Role->number != 3){
            return redirect('/');

        }
        /*
        Inertia::share('auth', function(Request $request){
            $data = [];
            $data['user'] = $request->user();
            $data['profilPerusahaan'] =$request->user()->profilPerusahaan->profilPerusahaanList();
            $data['profilPerusahaanComplete'] =$request->user()->profilPerusahaan->isProfilPerusahaanComplete();
            $data['dokumenPerusahaan'] =$request->user()->dokumenPerusahaan->dokumenPerusahaanList();
            $data['dokumenPerusahaanComplete'] =$request->user()->dokumenPerusahaan->isDokumenPerusahaanComplete();
            $data['profil'] = $request->user()->profil->profilList();
            $data['profileComplete']= $request->user()->profil->isProfileComplete();
           
                

            
            return $data;
        });
        return $next($request);
        */
    }
}
