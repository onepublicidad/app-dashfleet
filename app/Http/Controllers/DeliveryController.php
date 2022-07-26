<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Delivery;
 
class DeliveryController extends Controller{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        //
    }

    public function makeConsult( Request $request ){
      $this->validate($request, [
        'delivery_code' => 'required|int', 
        'document_type' => 'required|int',
        'document_number' => 'required|int'
      ]);

      $response = Delivery::makeConsult($request);


      if( $response != null ) return response()->json([ 'request'=>$response ], 200);
      else return response()->json('Falló la consulta', 402);
    } //
}