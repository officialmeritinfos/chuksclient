<?php
namespace App\Defaults;

use Illuminate\Support\Facades\Http;

trait Wallet{

    private $privyKey;
    private $pubKey;
    private $url;

    public function __construct()
    {
        $this->url = 'https://api.plisio.net/api/v1';
        $this->pubKey = 'ukTuFEiDhF7r4IIzs3u7wCVjimCwOVHIKBr_GZEN902Tdl0TbOyJgWDJxLBhATdr';
    }

    public function createInvoice($data)
    {
        $data['api_key']=$this->pubKey;
        $url = $this->url.'/invoices/new?'.http_build_query($data);
        return  $this->curlGet($url);
    }

    public function checkInvoice($ref)
    {
        $url = 'https://api.plisio.net/api/v1/operations/'.$ref.'?api_key=ukTuFEiDhF7r4IIzs3u7wCVjimCwOVHIKBr_GZEN902Tdl0TbOyJgWDJxLBhATdr';
        return $this->curlGet($url);
    }
    public function curlGet($url)
    {
        return Http::get($url);
    }

    public function curlPost($url,$data = null)
    {
        return Http::withHeaders([
            'x-api-key'=>$this->pubKey,
            'x-api-sec'=>$this->privyKey
        ])->post($url,$data);
    }
}
