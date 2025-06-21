<?php

namespace App\Http\Controllers\Borrowing;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Borrow\BorrowingItemModel;
use Illuminate\Support\Facades\Crypt;

class BorrowingController extends Controller
{
    public function formBorrowingItem(Request $request)
    {
        if ($request->param == 'add') {
            $form = 'Tambah Peminjaman';
            $paramOutgoing = 'save';
            $searchBorrowingItem = null;
        } elseif ($request->param == 'edit') {
            $form = 'Edit Peminjaman';
            $paramOutgoing = 'update';
            $searchBorrowingItem = BorrowingItemModel::findOrFail(Crypt::decrypt($request->id));
        } else {
            return redirect()->back('error', 'Paramater url tidak valid !');
        }

        $data = [
            'title' => 'Manajemen Peminjaman',
            'bc1' => 'Peminjaman',
            'bc2' => $form,
            'param' => Crypt::encrypt($request->param),
            'borrowingItems' => $searchBorrowingItem
        ];
        return view('borrowing.form-borrowings', $data);
    }

    // public function
}
