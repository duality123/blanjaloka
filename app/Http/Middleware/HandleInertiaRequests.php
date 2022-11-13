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
            //user authenticated
            'auth' => [
                'user'          => $request->user(),
                // 'permissions'   => $request->user() ? $request->user()->getPermissionArray() : []
                'profileComplete' => $request->user() ? $request->user()->profil->isProfileComplete():null,
                'usahaComplete' => $request->user() ? $request->user()->usaha->isUsahaComplete():null,
                'produkComplete' => $request->user() ? $request->user()->produk->isProdukComplete():null,
                'finansialComplete' => $request->user() ? $request->user()->finansial->isFinansialComplete():null,
                'profil' =>$request->user() ? $request->user()->profil->profilList():null,
                'usaha' => $request->user() ? $request->user()->usaha->usahaList():null,
                'produk' => $request->user() ? $request->user()->produk->produkList():null,
                'inkubasi' => $request->user() ? $request->user()->inkubasi():null,
                'finansial' => $request->user() ? $request->user()->finansial->finansialList():null,
                
            ],
            'asset_url' => 'http://127.0.0.1:5173/storage/app/public', 
            'isEmailSend'=> $request->session()->get('redirect')? true:false,
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
