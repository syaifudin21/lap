<?php

namespace App\Http\Controllers;

use App\Models\Tagihan;
use Illuminate\Http\Request;

class TagihanController extends Controller
{
    public function home()
    {
        $tagihans = Tagihan::all();
        return view('welcome', compact('tagihans'));
    }
    public function trx($id)
    {
        $rand = rand(100, 999);
        return $rand.$id;
    }
    public function store(Request $request)
    {
        $tagihan = new Tagihan();
        $tagihan->fill($request->all());
        $tagihan['items'] = '[["LENOVO IdeaCentre C320 444 All-in-One - White","500","1"]]';
        $tagihan['status'] = 'Belum Lunas';
        $tagihan->save();
        $tagihan['no_trx'] = $this->trx($tagihan->id);
        $tagihan->save();

        if($tagihan){
            return back()
            ->with(['alert'=> "'title':'Berhasil','text':'Data Berhasil Disimpan', 'icon':'success','buttons': false, 'timer': 1200"]);
        }else{
            return back()
            ->with(['alert'=> "'title':'Gagal Menyimpan','text':'Data gagal disimpan, periksa kembali data inputan', 'icon':'error'"])
            ->withInput($request->all());
        }
    }
    public function send($target, $parameter = NULL, $method = 'POST')
    {
        $target = 'https://payment.linkaja.id/linkaja-api/api/payment';
        $content = array('http' =>
                            array(
                                'method'  => $method,
                                'header'=> "Content-type: application/x-www-form-urlencoded\r\n",
                                'content' => http_build_query($parameter)
                            )
                        );
        $result = file_get_contents($target, false, stream_context_create($content));
        return json_decode($result, TRUE);
    }
    public function lunasi()
    {
        if(!isset($_GET['noTrx'])){
            return back()
            ->with(['alert'=> "'title':'Gagal Menyimpan','text':'No Transaksi tidak ada, periksa kembali data inputan', 'icon':'error'"]);
        }else{
            $trx = $_GET['noTrx'];
            $tagihan = Tagihan::where('no_trx',$trx)->first();

            $parameter['trxId'] = $tagihan->no_trx.rand(1,100);
            $parameter['terminalId'] = env('LA_TERMINAL_ID');
            $parameter['userKey'] = env('LA_USER_KEY');
            $parameter['password'] = env('LA_PASSWORD');
            $parameter['signature'] = env('LA_SIGNKEY');
            $parameter['total'] = $tagihan->tagihan;
            $parameter['successUrl'] = route('success');
            $parameter['items'] = $tagihan->items;
            $parameter['msisdn'] = $tagihan->nomor;
            $parameter['failedUrl'] = route('error');
            dd($parameter);

            $token = $this->send('https://payment.linkaja.id/linkaja-api/api/payment', $parameter);

            return redirect(url('https://payment.linkaja.id/checkout/payment?Message=').$token['pgpToken']);

            

            // dd($result);
        }
    }


}
