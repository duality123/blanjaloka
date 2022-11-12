<?php

namespace App\Http\Controllers\UMKM;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;
use Illuminate\Support\Facades\DB;

class ProdukController extends Controller
{
    public function pertama(Request $request)
    {
       if(!$request->user()->usaha->isUsahaComplete()){
            return Inertia::render('Profil/Lockedscreen',['title'=>'Profil Produk Belum Dapat Diisi','desc'=>'Harap penuhi profil usaha terlebih dahulu']);
        }
        return Inertia::render('Profil/produk/Pertama');
    }

    public function process_pertama(Request $request)
    {
        $data = [];
          $rules = [
            'jenis_produk' => 'required|max:50',
            'jumlah_produk_yang_dijual' => 'required|numeric|max:100000000',
            'bahan_produk' => 'required|max:100',
            'kategori_produk' => 'required|max:50',
            'harga_produk' => 'required',
            'manfaat_fungsional' => 'required',
            'manfaat_nonfungsional' => 'required',
        ];

        $customMessages = [
            'required' => 'Harap diisi bagian ini !.',
            'max'=>'Karakter yang anda input melebihi batas :max .'

        ];

        $this->validate($request, $rules, $customMessages);
        $data = [];

        if ($request->file('keterangan_halal')) {
             $ket_halal = $request->file('keterangan_halal')->store('umkm/keterangan_halal','public') ; 
            $data['keterangan_halal'] = $ket_halal;
        };
      $data['jenis_produk'] = $request->post('jenis_produk');
      $data['jumlah_produk_yang_dijual'] = $request->post('jumlah_produk_yang_dijual');
      $data['bahan_produk'] = $request->post('bahan_produk');
      $data['kategori_produk'] = $request->post('kategori_produk');
      $data['harga_produk']=$request->post('harga_produk');
      $data['manfaat_fungsional'] = $request->post('manfaat_fungsional');
      $data['manfaat_nonfungsional'] = $request->post('manfaat_nonfungsional');
      //dd($data['manfaat_nonfungsional'] );
        $produk =  Produk::where('user_id','=',$request->user()->id)->update($data);
        return redirect('umkm/dashboard/kajian_finansial/1');

    }
}
