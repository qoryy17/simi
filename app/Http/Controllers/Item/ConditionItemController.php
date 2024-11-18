<?php

namespace App\Http\Controllers\Item;

use App\Http\Controllers\Controller;
use App\Http\Requests\Item\ConditionItemRequest;
use App\Http\Requests\Item\ConditionRequest;
use App\Models\Item\ConditionItemModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ConditionItemController extends Controller
{
    public function formConditionItem(Request $request)
    {
        if ($request->param == 'add') {
            $form = 'Tambah Kondisi Barang';
            $paramOutgoing = 'save';
            $seacrhConditionItem = null;
        } elseif ($request->param == 'edit') {
            $form = 'Edit Kondisi Barang';
            $paramOutgoing = 'update';
            $seacrhConditionItem = ConditionItemModel::findOrFail(Crypt::decrypt($request->id));
        } else {
            return redirect()->back()->with('error', 'Paramater url tidak valid !');
        }

        $data = [
            'title' => 'Manajemen Barang',
            'bc1' => 'Kondisi Barang',
            'bc2' => $form,
            'conditionItem' => $seacrhConditionItem,
            'param' => Crypt::encrypt($paramOutgoing)
        ];
        return view('item.form-condition-item', $data);
    }
    public function saveConditionItem(ConditionItemRequest $request)
    {
        $request->validated();
        $formData = [
            'kondisi' => htmlspecialchars($request->input('kondisi')),
            'keterangan' => htmlspecialchars($request->input('keterangan')),
        ];

        $paramIncoming = Crypt::decrypt($request->input('param'));
        $save = null;

        if ($paramIncoming == 'save') {
            $save = ConditionItemModel::create($formData);
            $success = 'Kondisi barang berhasil disimpan !';
            $error = 'Kondisi barang gagal disimpan !';
        } elseif ($paramIncoming == 'update') {
            $room = ConditionItemModel::findOrFail(Crypt::decrypt($request->input('id')));
            $save = $room->update($formData);
            $success = 'Kondisi barang berhasil diperbarui !';
            $error = 'Kondisi barang gagal diperbarui !';
        } else {
            return redirect()->back()->with('error', 'Parameter tidak valid !')->withInput();
        }

        if (!$save) {
            return redirect()->back()->with('error', $error)->withInput();
        }
        return redirect()->route('dashboard.kondisi-barang')->with('success', $success);
    }
    public function deleteConditionItem(Request $request)
    {
        $conditionItem = ConditionItemModel::findOrFail(Crypt::decrypt($request->id));
        if ($conditionItem) {
            $conditionItem->delete();
            return redirect()->route('dashboard.kondisi-barang')->with('success', 'Kondisi barang berhasil dihapus !');
        }
        return redirect()->route('dashboard.kondisi-barang')->with('error', 'kondisi barang gagal dihapus !');
    }
}
