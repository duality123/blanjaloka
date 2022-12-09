<?php

namespace App\Http\Controllers\UMKM;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Finansial;
use App\Models\Notifikasi;
use Illuminate\Support\Facades\DB;

class FinansialController extends Controller
{
    public function form_wizard(Request $request)
    {
        if(!$request->user()->produk->isProdukComplete()){
            return Inertia::render('Profil/Lockedscreen',['title'=>'Profil Kajian finansial Belum Dapat Diisi','desc'=>'Harap penuhi profil produk terlebih dahulu']);
        }
        return Inertia::render('Profil/UMKM/finansial/form_wizard');
    }

    public function process_form_wizard(Request $request)
    { 
        $rules = [
            'capex' => 'required|max:200',
            'opex' => 'required|max:100',
            'swot_faktor_eksternal' => 'required|max:50',
            'payback_period' => 'required|max:500',
            'swot_faktor_internal' => 'required|max:100',
            'key_partners' => 'required|max:1000',
            'key_activity' => 'required',
            'value_propotions' => 'required|max:300',
            'customer_relationship' => 'required|max:255',
            'channels' => 'required|max:500',
            'cost_structure' => 'required|max:100',
            'revenue_streams' => 'required|max:100'
        ];

        $customMessages = [
            'required' => 'Harap diisi bagian ini !.',
            'max'=>'Karakter yang anda input melebihi batas :max .'

        ];

        $this->validate($request, $rules, $customMessages);
        $data = [];
        $data['capex']= $request->post('capex');
        $data['opex']= $request->post('opex');
        $data['swot_faktor_eksternal']= $request->post('swot_faktor_eksternal');
        $data['payback_period']= $request->post('payback_period');
        $data['swot_faktor_internal']= $request->post('swot_faktor_internal');
        $data['key_partners']= $request->post('key_partners');
        $data['key_activity']= $request->post('key_activity');
        $data['value_propotions']= $request->post('value_propotions');
        $data['customer_relationship']=$request->post('customer_relationship');
        $data['channels'] = $request->post('channels');
        $data['cost_structure'] = $request->post('cost_structure');
        $data['revenue_streams']=$request->post('revenue_streams');
        $profil = Finansial::where('user_id','=',$request->user()->id)->update($data);
       
        $admins = DB::table('roles')->select('user_id')->where('number','=',1)->get();
        $isNotifExist = DB::table('notifikasi')->select('id')->where('redirect','=',$request->user()->id)->first();
        if (!$isNotifExist) {
             foreach ($admins as $admin) {
                 $notif = Notifikasi::create(['nama'=>'Pengajuan Data Baru','pesan'=>'Seorang user mengajukan data barunya','user_id'=>$admin->user_id,'redirect'=> $request->user()->id,'tanggal'=>now()]);
                 $updateNotif =  DB::table('users')->select('notifikasi')->where('id','=',$admin->user_id)->first();
                 $updateNotif = $updateNotif->notifikasi+= 1;
                User::where('id','=',$admin->user_id)->update(['notifikasi'=>$updateNotif]);

            }
        }
        return redirect('umkm/dashboard/kajian_finansial');

    }
}
