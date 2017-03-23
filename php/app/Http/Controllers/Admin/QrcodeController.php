<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrcodeController extends Controller
{
    public function index(){
        return QrCode::encoding('UTF-8')->size(200)->generate('http://'.$_SERVER['HTTP_HOST']);
    }
}
