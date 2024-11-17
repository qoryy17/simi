<?php

namespace App\Http\Controllers\Item;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;

class ItemController extends Controller
{
    public function formItem(Request $request)
    {
        if ($request->param == 'add') {
            $form = 'Tambah Barang';
            $paramOutgoing = 'save';
            $searchItem = null;
        } elseif ($request->param == 'edit') {
            $form = 'Edit Barang';
            $paramOutgoing = 'update';
            $searchItem = '';
        } else {
            return redirect()->back()->with('error', 'Paramater url tidak valid !');
        }

        $data = [
            'title' => 'Manajemen Barang',
            'bc1' => 'Barang',
            'bc2' => $form,
            'items' => $searchItem,
            'param' => Crypt::encrypt($paramOutgoing)
        ];

        return view('item.form-items');
    }
}
