<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Officer\OfficerModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests\User\UserRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function formUser(Request $request)
    {
        if ($request->param == 'add') {
            $form = 'Tambah Pengguna';
            $paramOutgoing = 'save';
            $searchUser = null;
        } elseif ($request->param == 'edit') {
            $form = 'Edit Pengguna';
            $paramOutgoing = 'update';
            $searchUser = User::findOrFail(Crypt::decrypt($request->id));
        } else {
            return redirect()->back()->with('error', 'Paramater url tidak valid !');
        }

        $officers = DB::table('simi_pegawai')
            ->select('simi_pegawai.*', 'simi_jabatan.jabatan')
            ->from('simi_pegawai')
            ->leftJoin('simi_jabatan', 'simi_pegawai.jabatan_id', '=', 'simi_jabatan.id');

        $data = [
            'title' => 'Manajemen Pengguna',
            'bc1' => 'Pengguna',
            'bc2' => $form,
            'officers' => $officers,
            'user' => $searchUser,
            'param' => Crypt::encrypt($paramOutgoing)
        ];
        return view('user.form-users', $data);
    }

    public function saveUser(UserRequest $request): RedirectResponse
    {
        $getOfficer = OfficerModel::findOrFail(htmlspecialchars($request->input('pegawai')));
        $request->validated();
        $formData = [
            'name' => $getOfficer->nama,
            'email' => htmlspecialchars($request->input('email')),
            'email_verified_at' => now(),
            'password' => Hash::make(htmlspecialchars($request->input('password'))),
            'remember_token' => Str::random(5),
            'pegawai_id' => htmlspecialchars($request->input('pegawai')),
            'role' => htmlspecialchars($request->input('role')),
            'blokir' => htmlspecialchars($request->input('blokir')),
        ];

        $paramIncoming = Crypt::decrypt($request->input('param'));
        $save = null;

        if ($paramIncoming == 'save') {
            $request->validate(
                [
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
                    'password' => [
                        'required',
                        'min:8',
                        'string',
                        'regex:/[A-Z]/',       // must contain at least one uppercase letter
                        'regex:/[a-z]/',       // must contain at least one lowercase letter
                        'regex:/[0-9]/',       // must contain at least one digit
                        'regex:/[@$!%*?&]/'   // must contain a special character
                    ],
                ],
                [
                    'email.required' => 'Email harus di isi !',
                    'email.string' => 'Email harus berupa string !',
                    'email.email' => 'Email harus menggunakan format yang valid !',
                    'email.max' => 'Email maksimal 255 karakter !',
                    'email.unique' => 'Email harus unik tidak boleh sama !',
                    'password.required' => 'Password harus di isi !',
                    'password.string' => 'Password harus berupa string !',
                    'password.min' => 'Password harus mengandung 8 karakter.',
                    'password.regex' => 'Password harus mengandung huruf kapital, angka dan karakter',

                ]
            );
            $save = User::create($formData);
            $success = 'Pengguna berhasil disimpan !';
            $error = 'Pengguna gagal disimpan !';
        } elseif ($paramIncoming == 'update') {
            if ($request->input('password')) {
                $request->validate(
                    [
                        'email' => ['required', 'string', 'email', 'max:255'],
                        'password' => [
                            'required',
                            'min:8',
                            'string',
                            'regex:/[A-Z]/',       // must contain at least one uppercase letter
                            'regex:/[a-z]/',       // must contain at least one lowercase letter
                            'regex:/[0-9]/',       // must contain at least one digit
                            'regex:/[@$!%*?&]/'   // must contain a special character
                        ],
                    ],
                    [
                        'email.required' => 'Email harus di isi !',
                        'email.string' => 'Email harus berupa string !',
                        'email.email' => 'Email harus menggunakan format yang valid !',
                        'email.max' => 'Email maksimal 255 karakter !',
                        'password.required' => 'Password harus di isi !',
                        'password.string' => 'Password harus berupa string !',
                        'password.min' => 'Password harus mengandung 8 karakter.',
                        'password.regex' => 'Password harus mengandung huruf kapital, angka dan karakter',

                    ]
                );
            } else {
                $formData = [
                    'name' => $getOfficer->nama,
                    'email' => htmlspecialchars($request->input('email')),
                    'pegawai_id' => htmlspecialchars($request->input('pegawai')),
                    'role' => htmlspecialchars($request->input('role')),
                    'blokir' => htmlspecialchars($request->input('blokir')),
                ];
            }
            $user  = User::findOrFail(Crypt::decrypt($request->input('id')));
            $save = $user->update($formData);
            $success = 'Pengguna berhasil diperbarui !';
            $error = 'Pengguna gagal diperbarui !';
        } else {
            return redirect()->back()->with('error', 'Parameter tidak valid !')->withInput();
        }

        if (!$save) {
            return redirect()->back()->with('error', $error)->withInput();
        }
        return redirect()->route('dashboard.pengguna')->with('success', $success);
    }

    public function deleteUser(Request $request): RedirectResponse
    {
        $user = User::findOrFail(Crypt::decrypt($request->id));
        if ($user) {
            $user->delete();
            return redirect()->route('dashboard.pengguna')->with('success', 'Pengguna berhasil dihapus !');
        }
        return redirect()->route('dashboard.pengguna')->with('error', 'Pengguna gagal dihapus !');
    }
}
