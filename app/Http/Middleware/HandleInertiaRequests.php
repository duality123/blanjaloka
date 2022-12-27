<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Inertia\Middleware;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            //session
            'session' => [
                'status'     => fn () => $request->session()->get('status'),
                'success'   => fn () => $request->session()->get('success'),
                'error'        => fn () => $request->session()->get('error'),
            ],
          
           'auth' => [
                'user' => $request->user(),
                'user_role'=>$request->user()?$request->user()->Role->number:null,        
                'profil' => $request->user()?($request->user()->Role->number != 1 ?$request->user()->profil->profilList():null):null,
                'profileComplete'=> $request->user()?($request->user()->Role->number != 1 ?$request->user()->profil->isProfileComplete():null):null,
                'usahaComplete'=>$request->user()?($request->user()->Role->number == 2 ? $request->user()->usaha->isUsahaComplete():null):null,
                'produkComplete' =>$request->user()?($request->user()->Role->number == 2 ?  $request->user()->produk->isProdukComplete():null):null,
                'finansialComplete' =>$request->user()?($request->user()->Role->number == 2 ?$request->user()->finansial->isFinansialComplete():null):null,
                'usaha' => $request->user()?($request->user()->Role->number == 2 ? $request->user()->usaha->usahaList():null):null,
                'produk' => $request->user()?($request->user()->Role->number == 2 ? $request->user()->produk->produkList():null):null,
                'inkubasi' =>$request->user()?($request->user()->Role->number == 2 ? $request->user()->inkubasi():null):null,
                'finansial'=> $request->user()?($request->user()->Role->number == 2 ?$request->user()->finansial->finansialList():null):null,
                'profilPerusahaan' =>$request->user()?($request->user()->Role->number == 3 ?$request->user()->profilPerusahaan->profilPerusahaanList():null):null,
                'profilPerusahaanComplete' =>$request->user()?($request->user()->Role->number == 3 ?$request->user()->profilPerusahaan->isProfilPerusahaanComplete():null):null,
                'dokumenPerusahaan' =>$request->user()?($request->user()->Role->number == 3?$request->user()->dokumenPerusahaan->dokumenPerusahaanList():null):null,
                'dokumenPerusahaanComplete' =>$request->user()?($request->user()->Role->number == 3?$request->user()->dokumenPerusahaan->isDokumenPerusahaanComplete():null):null
            ]           
             
            ,
            'asset_url' => '/storage', 
            //route
            'route' => function () use ($request) {
                return [
                    'params' => $request->route()->parameters(),
                    'query' => $request->all(),
                ];
            },
        ]);
    }


}
