<?php

namespace App\Http\Controllers\Item;

use App\Http\Controllers\Controller;
use App\Models\Item\DistributionItemModel;
use App\Models\Item\ListDistributionItemModel;
use App\Models\Room\RoomModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class DistributionItemController extends Controller
{
    public function formDistributionItem(Request $request)
    {
        if ($request->param == 'add') {
            $form = 'Tambah Distribusi Barang';
            $paramOutgoing = 'save';
            $searchDistributionItem = null;
        } elseif ($request->param == 'edit') {
            $form = 'Edit Distribusi Barang';
            $paramOutgoing = 'update';
            $searchDistributionItem = DistributionItemModel::findOrFail(Crypt::decrypt($request->id));
        } else {
            return redirect()->back()->with('error', 'Parameter url tidak valid !');
        }

        $rooms = RoomModel::orderBy('ruangan', 'DESC')->get();
        $listDistributionItems = ListDistributionItemModel::orderBy('kode_distribusi', 'DESC')->get();

        $data = [
            'title' => 'Manajemen Barang',
            'bc1' => 'Distribusi Barang',
            'bc2' => $form,
            'distributionItem' => $searchDistributionItem,
            'param' => Crypt::encrypt($paramOutgoing),
            'rooms' => $rooms,
            'listDistributionItems' => $listDistributionItems
        ];
        return view('item.form-distribution-item', $data);
    }
}
