<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Delivery extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'deliveries';
    protected $fillable = [
        'delivery_code', 'delivery_address', 'delivery_status', 'delivery_date'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public static function makeConsult($data){
        $response = DB::table('deliveries')
                    ->where('delivery_code', $data->input('delivery_code'))
                    ->where('delivery_doc_type', $data->input('document_type'))
                    ->where('delivery_doc_num', $data->input('document_number'))
                    ->first();

                    
        if( $response ){ 
            $response->product = DB::table('deliveries_product as dp')->where('dl_id', $response->id)->get(['dp.product','dp.ref', 'dp.quantity']);
            return $response;

        }else return $response = 'Sin Resultados';
    }
}