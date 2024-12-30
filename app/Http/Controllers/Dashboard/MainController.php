<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Item\DistributionItemModel;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Item\ItemModel;
use App\Models\Room\RoomModel;
use App\Models\Item\UnitItemModel;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Setting\SettingModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Crypt;
use App\Models\Position\PositionModel;
use App\Models\Item\ConditionItemModel;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Setting\SettingRequest;

class MainController extends Controller
{
    public function home()
    {
        if (Auth::user()->role == 'Verifikator') {
            $view = 'home.home-verificator';
        } else {
            $view = 'home.home';
        }
        $data = [
            'title' => 'Selamat Datang Di SIMI',
            'page' => 'Dashboard SIMI'
        ];
        return view($view, $data);
    }

    public function manageUser()
    {
        $data = [
            'title' => 'Manajemen Pengguna',
            'bc1' => 'Pengguna',
            'users' => User::orderBy('created_at', 'DESC')->get()
        ];
        return view('user.users', $data);
    }

    public function manageOfficer()
    {
        $query = DB::table('simi_pegawai')->select(
            'simi_pegawai.*',
            'simi_jabatan.jabatan'
        )->from('simi_pegawai')->leftJoin('simi_jabatan', 'simi_pegawai.jabatan_id', '=', 'simi_jabatan.id')->orderBy('created_at', 'desc')->get();

        $data = [
            'title' => 'Manajemen Guru & Pegawai',
            'bc1' => 'Guru & Pegawai',
            'officers' => $query
        ];
        return view('officer.officers', $data);
    }

    public function managePosition()
    {
        $data = [
            'title' => 'Manajemen Jabatan',
            'bc1' => 'Jabatan',
            'positions' => PositionModel::orderBy('created_at', 'desc')->get()
        ];

        return view('position.positions', $data);
    }

    public function manageRoom()
    {
        $data = [
            'title' => 'Manajemen Ruangan',
            'bc1' => 'Ruangan',
            'rooms' => RoomModel::orderBy('created_at', 'DESC')->get()
        ];
        return view('room.rooms', $data);
    }

    public function manageItem()
    {
        $data = [
            'title' => 'Manajemen Pendataan Barang',
            'bc1' => 'Manajemen Barang',
            'bc2' => 'Pendataan Barang',
            'items' => ItemModel::orderBy('created_at', 'DESC')->get()
        ];
        return view('item.items', $data);
    }

    public function manageUnitItem()
    {
        $data = [
            'title' => 'Manajemen Satuan Barang',
            'bc1' => 'Manajemen Barang',
            'bc2' => 'Satuan Barang',
            'unitItems' => UnitItemModel::orderBy('created_at', 'DESC')->get()
        ];
        return view('item.unit-items', $data);
    }

    public function manageConditionItem()
    {
        $data = [
            'title' => 'Manajemen Kondisi Barang',
            'bc1' => 'Manajemen Barang',
            'bc2' => 'Kondisi Barang',
            'conditionItems' => ConditionItemModel::orderBy('created_at', 'DESC')->get()
        ];
        return view('item.condition-items', $data);
    }

    public function manageDistributionItem()
    {
        $data = [
            'title' => 'Manajemen Distribusi Barang',
            'bc1' => 'Manajemen Barang',
            'bc2' => 'Distribusi Barang',
            'distributionItems' => DistributionItemModel::orderBy('created_at', 'DESC')->get()
        ];
        return view('item.distribution-items', $data);
    }

    public function manageBorrowing()
    {
        $data = [
            'title' => 'Manajemen Peminjaman',
            'bc1' => 'Peminjaman',
        ];
        return view('borrowing.borrowings', $data);
    }

    public function manageSetting()
    {
        $data = [
            'title' => 'Pengaturan',
            'bc1' => 'Pengaturan Aplikasi',
            'setting' => SettingModel::first()
        ];

        return view('setting.setting-app', $data);
    }

    public function saveSetting(SettingRequest $request): RedirectResponse
    {
        $request->validated();
        $formData = [
            'cabdis_provinsi' => htmlspecialchars($request->input('cabdisProvinsi')),
            'cabdis_kabupaten' => htmlspecialchars($request->input('cabdisProvinsi')),
            'npsn' => htmlspecialchars($request->input('npsn')),
            'nama_sekolah' => htmlspecialchars($request->input('namaSekolah')),
            'alamat' => htmlspecialchars($request->input('alamat')),
            'email' => htmlspecialchars($request->input('email')),
            'telepon' => htmlspecialchars($request->input('telepon')),
            'website' => htmlspecialchars($request->input('website')),
        ];

        $save = null;

        $setting = SettingModel::first();
        $directory = 'images/config/';

        if ($setting) {
            if ($request->file('logo')) {

                if (Storage::disk('public')->exists($directory.$setting->logo)) {
                    Storage::disk('public')->delete($directory.$setting->logo);
                }
                $request->validate(
                    [
                        'logo' => ['required', 'image', 'mimes:png,jpg', 'max:5120']
                    ],
                    [
                        'logo.required' => 'Logo wajib diunggah !',
                        'logo.mimes' => 'Logo hanya boleh bertipe png/jpg',
                        'logo.max' => 'Logo hanya boleh berukuran maksimal 2 MB'
                    ]
                );

                $fileLogo = $request->file('logo');
                $fileHashname = $fileLogo->hashName();
                $uploadPath = $directory . $fileHashname;

                $fileUpload = $fileLogo->storeAs($directory, $fileHashname, 'public');

                if (!$fileUpload) {
                    return redirect()->back()->with('error', 'Unggah logo gagal !')->withInput();
                }
                $formData['logo'] = $uploadPath;
            }

            $save = $setting->update($formData);
            $success = 'Pengaturan berhasil diperbarui !';
            $error = 'Pengaturan gagal diperbarui !';
        } else {
            $request->validate(
                [
                    'logo' => ['required', 'image', 'mimes:png,jpg', 'max:5120']
                ],
                [
                    'logo.required' => 'Logo wajib diunggah !',
                    'logo.mimes' => 'Logo hanya boleh bertipe png/jpg',
                    'logo.max' => 'Logo hanya boleh berukuran maksimal 2 MB'
                ]
            );

            $fileLogo = $request->file('logo');
            $fileHashname = $fileLogo->hashName();
            $uploadPath = $directory . $fileHashname;

            $fileUpload = $fileLogo->storeAs($directory, $fileHashname, 'public');

            if (!$fileUpload) {
                return redirect()->back()->with('error', 'Unggah logo gagal !')->withInput();
            }
            $formData['logo'] = $uploadPath;
            $save = SettingModel::create($formData);
            $success = 'Pengaturan berhasil disimpan !';
            $error = 'Pengaturan gagal disimpan !';
        }

        if (!$save) {
            return redirect()->back()->with('error', $error)->withInput();
        }

        return redirect()->route('dashboard.pengaturan')->with('success', $success);
    }
}
