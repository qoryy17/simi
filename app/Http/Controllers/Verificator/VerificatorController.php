<?php

namespace App\Http\Controllers\Verificator;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Item\ItemModel;
use App\Models\Item\UnitItemModel;
use App\Http\Controllers\Controller;
use App\Http\Requests\Verification\VerificationRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Crypt;
use App\Models\Item\ConditionItemModel;
use App\Models\Verification\VerificationModel;

class VerificatorController extends Controller
{
    public function itemVerified()
    {
        $data = [
            'title' => 'Manajemen Pendataan Barang',
            'bc1' => 'Manajemen Barang',
            'bc2' => 'Verifikasi Barang',
            'items' => ItemModel::orderBy('created_at', 'DESC')->get()
        ];
        return view('verificator.items', $data);
    }

    public function detailItem(Request $request)
    {
        $searchItem = ItemModel::findOrFail(Crypt::decrypt($request->id));
        $unitItem = UnitItemModel::find($searchItem->satuan_barang_id);
        $conditionItem = ConditionItemModel::find($searchItem->kondisi_barang_id);
        $user = User::find($searchItem->diinput_oleh);


        if ($searchItem->verifikasi_id == null) {
            $verification = null;
            $verifikator =  null;
        } else {
            $verification = VerificationModel::find($searchItem->verifikasi_id);
            $verifikator =  User::find($verification->verifikator_id);
        }

        $data = [
            'title' => 'Verifikasi Barang',
            'bc1' => 'Verifikasi Barang',
            'bc2' => 'Detail : ' . $searchItem->nama_barang,
            'item' => $searchItem,
            'unitItem' => $unitItem,
            'conditionItem' => $conditionItem,
            'user' => $user,
            'verification' => $verification,
            'verifikator' => $verifikator
        ];

        return view('verificator.detail-items', $data);
    }

    public function changeVerified(VerificationRequest $request): RedirectResponse
    {
        $request->validated();
        // it's available verification on item ?
        $onItem = ItemModel::find(Crypt::decrypt(htmlentities($request->input('id'))));

        $generateVerifiedCode = Str::uuid();
        $save = null;
        $verificationID = null;

        if (!$onItem) {
            return redirect()->back()->with('error', 'Barang tidak dapat ditemukan !');
        }

        if ($onItem->verifikasi_id == null) {
            $formData = [
                'kode_verifikasi' => $generateVerifiedCode,
                'status' => htmlentities($request->input('status')),
                'keterangan' => nl2br(htmlentities($request->input('keterangan'))),
                'verifikator_id' => Auth::user()->id
            ];
            $save = VerificationModel::create($formData);

            $getOnVerification = VerificationModel::where('kode_verifikasi', $generateVerifiedCode)->first();
            $verificationID = $getOnVerification->id;
        } else {
            $searchVerication = VerificationModel::find(Crypt::decrypt(htmlentities($request->input('idVerifikasi'))));
            $formData = [
                'status' => htmlentities($request->input('status')),
                'keterangan' => nl2br(htmlentities($request->input('keterangan'))),
                'verifikator_id' => Auth::user()->id
            ];
            $save = $searchVerication->update($formData);
            $verificationID = $searchVerication->id;
        }

        if ($formData['status'] == 'Disetujui') {
            $message = 'Verifikasi disimpan, verifikasi barang disetujui !';
            $statusItem = 'Selesai';
        } elseif ($formData['status'] == 'Ditolak') {
            $message = 'Verifikasi disimpan, verifikasi barang ditolak !';
            $statusItem = 'Pratinjau';
        } else {
            return redirect()->back()->with('error', 'Verifikasi gagal, status verifikasi tidak diketahui !')->withInput();
        }

        if (!$save) {
            return redirect()->back()->with('error', 'Verifikasi gagal !')->withInput();
        }

        // update verifikasi_id on item table
        if ($onItem) {
            $onItem->update(['status' => $statusItem, 'verifikasi_id' => $verificationID]);
        }

        return redirect()->route('verifikator.detail-item', ['id' => htmlentities($request->input('id'))])->with('success', $message);
    }
}
