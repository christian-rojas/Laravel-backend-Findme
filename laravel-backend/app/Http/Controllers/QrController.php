<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QrController extends Controller
{
    public function make(){
    	$file = public_path('qr.png');
    	return \QRCode::text('QR Code Generator for Laravel!')->setOutfile($file)->png();   
    }
}
