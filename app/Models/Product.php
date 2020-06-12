<?php

namespace App\Models;

use \Illuminate\Database\Eloquent\Model;
use App\Models\City;

class Product extends Model
{
    public $timestamps = false;
    public $page_limit;

    protected $fillable = [ 
        "name" , "code", "weight", 
        "quantity_msk", "quantity_spb", "quantity_smr", "quantity_srt", "quantity_kzn", "quantity_nsb", "quantity_chb", "quantity_dch",
        "price_msk", "price_spb", "price_smr", "price_srt", "price_kzn", "price_nsb", "price_chb", "price_dch", 
        "usage"
    ];

    protected $city_code;

    public function import($xml)
    {
        $this->city_code = (new City)->getCode( $xml->{'Классификатор'}->{'Ид'} );

        if( isset( $xml->{'Каталог'} ) ){

            $products = $xml->{'Каталог'}->{'Товары'}->{'Товар'};
            $this->importProducts($products);
        }
        elseif( isset( $xml->{'ПакетПредложений'} ) ){

            $offers = $xml->{'ПакетПредложений'}->{'Предложения'}->{'Предложение'};
            $this->importOffers($offers);
        }
    }

    protected function importProducts(&$products){

        foreach($products as $product){
            $this->add($product);
        }

    }

    protected function importOffers(&$offers){

        foreach($offers as $offer){
            $this->addDataFromOffer($offer);
        }
    }

    protected function add(&$product){

        if( !$this->exists( $product->{'Код'} ) )        
        {
            $data = $this->normalizationData($product);
            $this->create($data);
        }
    }

    protected function addDataFromOffer(&$offer){
        
        if( $this->exists($offer->{'Код'}) )        
        {
            $this->where('code', $offer->{'Код'})->update(
                [
                    ("quantity_".$this->city_code) => ($offer->{'Количество'} ?? 0),
                    ("price_".$this->city_code) => $this->selectionPrice($offer)
                ]
            );
        }
    }

    protected function exists($product_code){
        $existen = $this->where('code', $product_code ?? null)->first();
        return $existen != null ? $existen : false;
    }

    protected function normalizationData(&$product){
        
        return [
            "name" => $product->{'Наименование'},
            "code" => $product->{'Код'},
            "weight" => $product->{'Вес'},
            "quantity_msk" => 0,
            "quantity_spb" => 0,
            "quantity_smr" => 0,
            "quantity_srt" => 0,
            "quantity_kzn" => 0,
            "quantity_nsb" => 0,
            "quantity_chb" => 0,
            "quantity_dch" => 0,
            "price_msk" => 0,
            "price_spb" => 0,
            "price_smr" => 0,
            "price_srt" => 0,
            "price_kzn" => 0,
            "price_nsb" => 0,
            "price_chb" => 0,
            "price_dch" => 0,
            "usage" => $this->formationUsage($product)
        ];
    }

    protected function formationUsage(&$product){

        if( isset( $product->{'Взаимозаменяемости'} ) )
        {
            $usage = "";

            $list = $product->{'Взаимозаменяемости'}->{'Взаимозаменяемость'};

            foreach($list as $item)
            {
                $usage .=   $item->{'Марка'}."|".
                            $item->{'Модель'}."|".
                            $item->{'КатегорияТС'}.",";
            }

            return $usage;
        }

        return "";
    }

    protected function selectionPrice(&$offer){

        if( isset( $offer->{'Цены'}->{'Цена'} ) )
        {
            $price = 0;

            $list = $offer->{'Цены'}->{'Цена'};

            $count = 0;
            foreach($list as $item)
            {
                if ($count == 0){
                    $price += $item->{'ЦенаЗаЕдиницу'};
                }

                $count++;
            }

            return $price;
        }

        return 0;
    }


    public function paginate($limit){
        $this->page_limit = $limit;
        $offset = isset( $_GET['page'] ) ? $_GET['page'] - 1 : 0;

        return $this->offset($limit * $offset)->limit($limit)->orderBy('id', 'asc')->get();
    }

    public function pageLinks(){
        $current_page = $_GET['page'] ?? 1;
        $number_pages = ceil( $this->all()->count() / $this->page_limit );
        
        $previous = $current_page > 2 ? "?page=".($current_page - 1) : 'javascript:void(0);';
        $next = $current_page < $this->all()->count() ? "?page=".($current_page + 1) : 'javascript:void(0);';

        echo "<li class='page-item'><a class='page-link' href='".$previous."'>Предыдущая</a></li>";

        $start_offset = ($number_pages - $current_page) < 7 ? $number_pages - $current_page : 3;
        $start = ($current_page - 3) > 0 ? ($current_page - 3) : 1;
        $end = ($current_page + 3) < $number_pages ? ($current_page + 3) : $number_pages;

        for($i = $start; $i <= $end; $i++){
            $condition = $current_page == $i ? "active" : "";
            echo "<li class='page-item $condition'><a class='page-link' href='?page=$i'>$i</a></li>";
        }

        echo "<li class='page-item'><a class='page-link' href='".$next."'>Следующая</a></li>";
    }
}