<?php

namespace App\Http\Controllers\Officer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Officer\OfficerRequest;
use App\Models\Officer\OfficerModel;
use App\Models\Position\PositionModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Crypt;

class OfficerController extends Controller
{
    public function formOfficer(Request $request)
    {
        if ($request->param == 'add') {
            $form = 'Tambah Guru & Pegawai';
            $paramOutgoing = 'save';
            $searchOfficer = null;
        } elseif ($request->param == 'edit') {
            $form = 'Edit Guru & Pegawai';
            $paramOutgoing = 'update';
            $searchOfficer = OfficerModel::findOrFail(Crypt::decrypt($request->id));
        } else {
            return redirect()->back()->with('error', 'Paramater url tidak valid !');
        }

        $position = PositionModel::orderBy('jabatan', 'asc');

        $data = [
            'title' => 'Manajemen Guru & Pegawai',
            'bc1' => 'Guru & Pegawai',
            'bc2' => $form,
            'officer' => $searchOfficer,
            'position' => $position,
            'param' => Crypt::encrypt($paramOutgoing)
        ];
        return view('officer.form-officers', $data);
    }

    public function saveOfficer(OfficerRequest $request): RedirectResponse
    {
        $request->validated();
        $formData = [
            'nip' => htmlspecialchars($request->input('nip')),
            'nama' => htmlspecialchars($request->input('namaLengkap')),
            'jabatan_id' => htmlspecialchars($request->input('jabatan')),
            'status' => htmlspecialchars($request->input('status')),
        ];

        $paramIncoming = Crypt::decrypt($request->input('param'));
        $save = null;

        if ($paramIncoming == 'save') {
            $save = OfficerModel::create($formData);
            $success = 'Guru/Pegawai berhasil disimpan !';
            $error = 'Guru/Pegawai gagal disimpan !';
        } elseif ($paramIncoming == 'update') {
            $officer  = OfficerModel::findOrFail(Crypt::decrypt($request->input('id')));
            $save = $officer->update($formData);
            $success = 'Guru/Pegawai berhasil diperbarui !';
            $error = 'Guru/Pegawai gagal diperbarui !';
        } else {
            return redirect()->back()->with('error', 'Parameter tidak valid !')->withInput();
        }

        if (!$save) {
            return redirect()->back()->with('error', $error)->withInput();
        }
        return redirect()->route('dashboard.guru-pegawai')->with('success', $success);
    }

    public function deleteOfficer(Request $request): RedirectResponse
    {
        $officer = OfficerModel::findOrFail(Crypt::decrypt($request->id));
        if ($officer) {
            $officer->delete();
            return redirect()->route('dashboard.guru-pegawai')->with('success', 'Guru/Pegawai berhasil dihapus !');
        }
        return redirect()->route('dashboard.guru-pegawai')->with('error', 'Guru/Pegawai gagal dihapus !');
    }
}
