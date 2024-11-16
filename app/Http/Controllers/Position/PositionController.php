<?php

namespace App\Http\Controllers\Position;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Position\PositionRequest;
use App\Models\Position\PositionModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Crypt;

class PositionController extends Controller
{
    public function formPosition(Request $request)
    {
        if ($request->param == 'add') {
            $form = 'Tambah Jabatan';
            $paramOutgoing = 'save';
            $searchPosition = null;
        } elseif ($request->param == 'edit') {
            $form = 'Edit Jabatan';
            $paramOutgoing = 'update';
            $searchPosition = PositionModel::findOrFail(Crypt::decrypt($request->id));
        } else {
            return redirect()->back()->with('error', 'Paramater url tidak valid !')->withInput();
        }

        $data = [
            'title' => 'Manajemen Jabatan',
            'bc1' => 'Jabatan',
            'bc2' => $form,
            'position' => $searchPosition,
            'param' => Crypt::encrypt($paramOutgoing)
        ];
        return view('position.form-positions', $data);
    }

    public function savePosition(PositionRequest $request): RedirectResponse
    {
        $request->validated();
        $formData = [
            'jabatan' => htmlspecialchars($request->input('jabatan')),
            'kode_jabatan' => htmlspecialchars($request->input('kodeJabatan')),
            'keterangan' => htmlspecialchars($request->input('keterangan')),
        ];

        $paramIncoming = Crypt::decrypt($request->input('param'));
        $save = null;

        if ($paramIncoming == 'save') {
            $save = PositionModel::create($formData);
            $success = 'Jabatan berhasil disimpan !';
            $error = 'Jabatan gagal disimpan !';
        } elseif ($paramIncoming == 'update') {
            $position  = PositionModel::findOrFail(Crypt::decrypt($request->input('id')));
            $save = $position->update($formData);
            $success = 'Jabatan berhasil diperbarui !';
            $error = 'Jabatan gagal diperbarui !';
        } else {
            return redirect()->back()->with('error', 'Parameter tidak valid !')->withInput();
        }

        if (!$save) {
            return redirect()->back()->with('error', $error)->withInput();
        }
        return redirect()->route('dashboard.jabatan')->with('success', $success);
    }

    public function deletePosition(Request $request): RedirectResponse
    {
        $position = PositionModel::findOrFail(Crypt::decrypt($request->id));
        if ($position) {
            $position->delete();
            return redirect()->route('dashboard.jabatan')->with('success', 'Jabatan berhasil dihapus !');
        }
        return redirect()->route('dashboard.jabatan')->with('error', 'Jabatan gagal dihapus !');
    }
}
