<?php

namespace App\Http\Controllers\Verification;

use App\Http\Controllers\Controller;
use App\Models\Item\ItemModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class VerificationController extends Controller
{
    public function verificationItem(Request $request)
    {

        $data = [
            "title" => "Detail Informasi Barang",
            "item" => ItemModel::findOrFail($request->param),
        ];
        return view("verification.item", $data);
    }
}
