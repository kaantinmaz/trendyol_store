<?php namespace efast\TrendyolStoreApi;

use http\Env\Request;

class TrendyolStore{

    public function getProducts()
    {

        $seller_id = config('trendyol-store.SELLER_ID');
        $store_id = config('trendyol-store.STORE_ID');
        $api_key = config('trendyol-store.API_KEY');
        $secret_key = config('trendyol-store.SECRET_KEY');

        if (!empty($seller_id) && !empty($store_id) && !empty($api_key) && !empty($secret_key)){

            $url = 'https://api.trendyol.com/grocerygw/suppliers/'.$seller_id.'/stores/'.$store_id.'/products';

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_USERPWD, $api_key.':'.$secret_key);
            $result = json_decode(curl_exec($ch), true);
            curl_close($ch);

            return $result;

        }
    }

    public function getProductSingle($barcode)
    {

        $seller_id = config('trendyol-store.SELLER_ID');
        $store_id = config('trendyol-store.STORE_ID');
        $api_key = config('trendyol-store.API_KEY');
        $secret_key = config('trendyol-store.SECRET_KEY');

        if (!empty($seller_id) && !empty($store_id) && !empty($api_key) && !empty($secret_key)){

//            $url = 'https://api.trendyol.com/grocerygw/suppliers/'.$seller_id.'/stores/'.$store_id.'/products';
              $url = 'https://api.trendyol.com/grocerygw/suppliers/'.$seller_id.'/stores/'.$store_id.'/products?barcode='.$barcode;

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_USERPWD, $api_key.':'.$secret_key);
            $result = json_decode(curl_exec($ch), true);
            curl_close($ch);

            return $result;

        }
    }

    public function getOrders()
    {

        $seller_id = config('trendyol-store.SELLER_ID');
        $store_id = config('trendyol-store.STORE_ID');
        $api_key = config('trendyol-store.API_KEY');
        $secret_key = config('trendyol-store.SECRET_KEY');

        if (!empty($seller_id) && !empty($store_id) && !empty($api_key) && !empty($secret_key)){

            $status = 'Created';
            $sortDirection = 'DESC';
            $size = '50';

            $url = 'https://api.trendyol.com/grocerygw/suppliers/'.$seller_id.'/packages?storeId='.$store_id.'&status='.$status.'&status=Delivered&sortDirection='.$sortDirection.'&size='.$size;
//            $url = "https://api.trendyol.com/sapigw/suppliers/{MAGAZAID}/orders?status=Created&startDate=&endDate=&orderByField=PackageLastModifiedDate&orderByDirection=DESC&size=50";

            $ch = curl_init($url);

            $header = array(
                'Authorization: Basic '. base64_encode($api_key),
                'Content-Type: application/json'
            ); //Trenyol bağlantısını APIKEY doğruluyoruz.

            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
            $result = json_decode(curl_exec($ch), true);
            curl_close($ch);

            if (isset($result)){
                foreach ($result['content'] as $ma ){ //İLK ***
                    $sipno=$ma['orderNumber'];
                    $eposta=$ma['customerEmail'];
                    $teslimkisi=$ma['shipmentAddress']['fullName']; $ad=$teslimkisi;
                    $tt1=$ma['shipmentAddress']['address1'];
                    $tt2=$ma['shipmentAddress']['address2'];
                    $teslimilce=$ma['shipmentAddress']['district'];
                    $teslimilce = mb_strtoupper($teslimilce, "UTF-8");
                    $teslimsehir=$ma['shipmentAddress']['city'];
                    $teslimsehir = mb_strtoupper($teslimsehir, "UTF-8");
                    $kargono=$ma['cargoTrackingNumber'];
                    $tc=$ma['tcIdentityNumber'];
                    $ff1=$ma['invoiceAddress']['address1'];
                    $ff2=$ma['invoiceAddress']['address2'];
                    $trendyolid=$ma['id'];
                    $fatilce=$ma['invoiceAddress']['district'];
                    $fatsehir=$ma['invoiceAddress']['city'];

                    $fatilce = mb_strtoupper($fatilce, "UTF-8");
                    $fatsehir = mb_strtoupper($fatsehir, "UTF-8");
                    $fadres="$ff1 $ff2";
                    $funvan=$ad;

                    //Burada siparişe ait temel değerleri aldık, sipariş numarası, teslimat ve fatura bilgileri gibi...
                    // veritabanı için bu alana ait işlemleri burada yapmalısınız...
                    foreach ($ma['lines'] as $maa ){ //İKİ ***
                        $urunadeti=$maa['quantity'];
                        $urunno=$maa['merchantSku'];
                        $ufiyat=$maa['amount'];
                        $satirid=$maa['id'];
                        //siparişe ait ürün kalemlerini bu döngüde sorguladık,
                        //bu alana ait veritabanı işlemlerini de burada yapmalısınız...
                    }
                }
            }

        }
    }

}
