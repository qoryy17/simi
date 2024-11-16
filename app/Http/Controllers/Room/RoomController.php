<?php

namespace App\Http\Controllers\Room;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Room\RoomRequest;
use App\Models\Room\RoomModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Crypt;

class RoomController extends Controller
{
    public function formRoom(Request $request)
    {
        if ($request->param == 'add') {
            $form = 'Tambah Ruangan';
            $paramOutgoing = 'save';
            $searchRoom = null;
        } elseif ($request->param == 'edit') {
            $form = 'Edit Ruangan';
            $paramOutgoing = 'update';
            $searchRoom = RoomModel::findOrFail(Crypt::decrypt($request->id));
        } else {
            return redirect()->back('error', 'Paramater url tidak valid !');
        }

        $data = [
            'title' => 'Manajemen Ruangan',
            'bc1' => 'Ruangan',
            'bc2' => $form,
            'room' => $searchRoom,
            'param' => Crypt::encrypt($paramOutgoing)
        ];
        return view('room.form-rooms', $data);
    }

    public function saveRoom(RoomRequest $request): RedirectResponse
    {
        $request->validated();
        $formData = [
            'ruangan' => htmlspecialchars($request->input('ruangan')),
            'kode_ruangan' => htmlspecialchars($request->input('kodeRuangan')),
            'keterangan' => htmlspecialchars($request->input('keterangan')),
        ];

        $paramIncoming = Crypt::decrypt($request->input('param'));
        $save = null;

        if ($paramIncoming == 'save') {
            $save = RoomModel::create($formData);
            $success = 'Ruangan berhasil disimpan !';
            $error = 'Ruangan gagal disimpan !';
        } elseif ($paramIncoming == 'update') {
            $room = RoomModel::findOrFail(Crypt::decrypt($request->input('id')));
            $save = $room->update($formData);
            $success = 'Ruangan berhasil diperbarui !';
            $error = 'Ruangan gagal diperbarui !';
        } else {
            return redirect()->back()->with('error', 'Parameter tidak valid !')->withInput();
        }

        if (!$save) {
            return redirect()->back()->with('error', $error)->withInput();
        }
        return redirect()->route('dashboard.ruangan')->with('success', $success);
    }

    public function deleteRoom(Request $request): RedirectResponse
    {
        $room = RoomModel::findOrFail(Crypt::decrypt($request->id));
        if ($room) {
            $room->delete();
            return redirect()->route('dashboard.ruangan')->with('success', 'Ruangan berhasil dihapus !');
        }
        return redirect()->route('dashboard.ruangan')->with('error', 'Ruangan gagal dihapus !');
    }
}
