<?php

namespace App\Http\Middleware;
use Inertia\Inertia;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class shouldUMKM
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

        if($request->user()->Role->number != 2){
            return redirect('/');


        }
         Inertia::share('auth', function(Request $request){
            $data = [];
            $data['user'] = $request->user();
            $data['usaha'] =$request->user()->usaha->usahaList();
            $data['usahaComplete']=$request->user()->usaha->isUsahaComplete();
            $data['produk']= $request->user()->produk->produkList();
            $data['produkComplete'] =$request->user()->produk->isProdukComplete();
            $data['finansial']= $request->user()->finansial->finansialList();
            $data['finansialComplete'] =$request->user()->finansial->isFinansialComplete();
            $data['inkubasi'] =$request->user()->inkubasi();
            $data['pendanaan'] = $request->user()->pendanaan();
            $data['janji_temu'] =$request->user()->janji_temu();
            $data['profil'] = $request->user()->profil->profilList();
            $data['profileComplete']= $request->user()->profil->isProfileComplete();            
            return $data;
        });

        return $next($request);
    }
}
