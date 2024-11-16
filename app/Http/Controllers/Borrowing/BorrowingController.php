<?php

namespace App\Http\Controllers\Borrowing;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;

class BorrowingController extends Controller
{
    public function formOfficer(Request $request)
    {
        if ($request->param == 'add') {
            $form = 'Tambah Peminjaman';
        } elseif ($request->param == 'edit') {
            $form = 'Edit Peminjaman';
        } else {
            return redirect()->back('error', 'Paramater url tidak valid !');
        }

        $data = [
            'title' => 'Manajemen Peminjaman',
            'bc1' => 'Peminjaman',
            'bc2' => $form,
            'param' => Crypt::encrypt($request->param)
        ];
        return view('borrowing.form-borrowings', $data);
    }
}
