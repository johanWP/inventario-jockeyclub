<?php

namespace App\Http\Controllers;

use App\Sector;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Response;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use PDF;

class PdfController extends Controller
{
    public function getUsers()
    {
        $sectores = Sector::all();
//        return view('pdf.guia', compact('sectores'));
        return PDF::loadView('pdf.guia', compact('sectores'))->stream('nombre-archivo.pdf');
    }
}
