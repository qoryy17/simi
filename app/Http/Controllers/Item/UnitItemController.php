<?php

namespace App\Http\Controllers\Item;

use Illuminate\Http\Request;
use App\Models\Item\UnitItemModel;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests\Item\UnitItemRequest;

class UnitItemController extends Controller
{
    public function formUnitItem(Request $request)
    {
        if ($request->param == 'add') {
            $form = 'Tambah Satuan Barang';
            $paramOutgoing = 'save';
            $searchUnitItem = null;
        } elseif ($request->param == 'edit') {
            $form = 'Edit Satuan Barang';
            $paramOutgoing = 'update';
            $searchUnitItem = UnitItemModel::findOrFail(Crypt::decrypt($request->id));
        } else {
            return redirect()->back()->with('error', 'Paramater url tidak valid !');
        }

        $data = [
            'title' => 'Manajemen Barang',
            'bc1' => 'Satuan Barang',
            'bc2' => $form,
            'unitItem' => $searchUnitItem,
            'param' => Crypt::encrypt($paramOutgoing)
        ];
        return view('item.form-unit-items', $data);
    }

    public function saveUnitItem(UnitItemRequest $request): RedirectResponse
    {
        $request->validated();
        $formData = [
            'satuan' => htmlspecialchars($request->input('satuan')),
            'keterangan' => htmlspecialchars($request->input('keterangan')),
        ];

        $paramIncoming = Crypt::decrypt($request->input('param'));
        $save = null;

        if ($paramIncoming == 'save') {
            $save = UnitItemModel::create($formData);
            $success = 'Satuan barang berhasil disimpan !';
            $error = 'Satuan barang gagal disimpan !';
        } elseif ($paramIncoming == 'update') {
            $room = UnitItemModel::findOrFail(Crypt::decrypt($request->input('id')));
            $save = $room->update($formData);
            $success = 'Satuan barang berhasil diperbarui !';
            $error = 'Satuan barang gagal diperbarui !';
        } else {
            return redirect()->back()->with('error', 'Parameter tidak valid !')->withInput();
        }

        if (!$save) {
            return redirect()->back()->with('error', $error)->withInput();
        }
        return redirect()->route('dashboard.satuan-barang')->with('success', $success);
    }

    public function deleteUnitItem(Request $request): RedirectResponse
    {
        $unitItem = UnitItemModel::findOrFail(Crypt::decrypt($request->id));
        if ($unitItem) {
            $unitItem->delete();
            return redirect()->route('dashboard.satuan-barang')->with('success', 'Satuan barang berhasil dihapus !');
        }
        return redirect()->route('dashboard.satuan-barang')->with('error', 'Satuan barang gagal dihapus !');
    }
}
