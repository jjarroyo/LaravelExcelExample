<?php

namespace App\Http\Controllers;

use App\Exports\PersonExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
   
    public function export(Request $request) {
        $data = $request->all();
        return Excel::download(new PersonExport($data["records"]), 'person.xlsx');       
    }
}
