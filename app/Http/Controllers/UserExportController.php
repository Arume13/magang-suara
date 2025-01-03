<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Imports\UsersImport;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Maatwebsite\Excel\Facades\Excel;

use function Termwind\render;

class UserExportController extends Controller
{
    public function index()
    {
        return Inertia::render('Users/Import', [
        ]);
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        $request->file('file');
        $file = $request->file('file');
        $import = new UsersImport();
        Excel::import($import, $file);

            //redirect
            return redirect()->route('users.index')->with(['success' => 'Data Berhasil Diimport!']);
    }

    public function export() 
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }
}
