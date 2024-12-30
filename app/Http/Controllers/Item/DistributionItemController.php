<?php

namespace App\Http\Controllers\Item;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Room\RoomModel;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use App\Models\Item\DistributionItemModel;
use App\Http\Requests\Item\DistributionItemRequest;

class DistributionItemController extends Controller
{
    public function formDistributionItem(Request $request)
    {
        if ($request->param == 'add') {
            $form = 'Tambah Distribusi Barang';
            $paramOutgoing = 'save';
            $searchDistributionItem = null;
            $distributionCode = Str::uuid();
        } elseif ($request->param == 'edit') {
            $form = 'Edit Distribusi Barang';
            $paramOutgoing = 'update';
            $searchDistributionItem = DistributionItemModel::findOrFail(Crypt::decrypt($request->id));
            $distributionCode = $searchDistributionItem->kode_distribusi;
        } else {
            return redirect()->back()->with('error', 'Parameter url tidak valid !');
        }

        $rooms = RoomModel::orderBy('ruangan', 'DESC')->get();
        $officers = DB::table('simi_pegawai')
            ->select('simi_pegawai.*', 'simi_jabatan.jabatan')
            ->from('simi_pegawai')
            ->leftJoin('simi_jabatan', 'simi_pegawai.jabatan_id', '=', 'simi_jabatan.id')->get();

        $data = [
            'title' => 'Manajemen Barang',
            'bc1' => 'Distribusi Barang',
            'bc2' => $form,
            'distributionItem' => $searchDistributionItem,
            'param' => Crypt::encrypt($paramOutgoing),
            'rooms' => $rooms,
            'officers' => $officers,
            'distributionCode' => $distributionCode
        ];
        return view('item.form-distribution-item', $data);
    }
    public function saveDistributionItem(DistributionItemRequest $request)
    {
        $request->validated();
        $formData = [
            "kode_distribusi" => htmlspecialchars($request->input("kodeDistribusi")),
            "nomor_bast" => htmlspecialchars($request->input("nomorBast")),
            "ruangan_id" => htmlspecialchars($request->input("ruangan")),
            "penerima" => htmlspecialchars($request->input("penerima")),
            "keterangan" => htmlspecialchars($request->input("keterangan")),
            "status" => "Pratinjau",
            "diinput_oleh" => Auth::user()->id
        ];

        $paramIncoming = Crypt::decrypt($request->input('param'));
        $save = null;

        if ($paramIncoming == 'save') {
            $save = DistributionItemModel::create($formData);
            $success = 'Distribusi Barang berhasil disimpan !';
            $error = 'Distribusi Barang gagal disimpan !';
        } elseif ($paramIncoming == 'update') {
            $room = DistributionItemModel::findOrFail(Crypt::decrypt($request->input('id')));
            $save = $room->update($formData);
            $success = 'Distribusi Barang berhasil diperbarui !';
            $error = 'Distribusi Barang gagal diperbarui !';
        } else {
            return redirect()->back()->with('error', 'Parameter tidak valid !')->withInput();
        }

        if (!$save) {
            return redirect()->back()->with('error', $error)->withInput();
        }
        return redirect()->route('dashboard.distribusi-barang')->with('success', $success);
    }
}
