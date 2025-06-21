<?php

namespace App\Http\Controllers\Item;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Item\ItemModel;
use App\Models\Item\UnitItemModel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests\Item\ItemRequest;
use App\Models\Item\ConditionItemModel;
use App\Models\Item\DistributionItemModel;
use App\Models\Officer\OfficerModel;
use App\Models\Setting\SettingModel;
use Illuminate\Support\Facades\Storage;
use App\Models\Verification\VerificationModel;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use PDF;
use Symfony\Component\CssSelector\Node\FunctionNode;

class ItemController extends Controller
{
    public function formItem(Request $request)
    {
        if ($request->param == 'add') {
            $form = 'Tambah Barang';
            $paramOutgoing = 'save';
            $searchItem = null;
        } elseif ($request->param == 'edit') {
            $form = 'Edit Barang';
            $paramOutgoing = 'update';
            $searchItem = ItemModel::findOrFail(Crypt::decrypt($request->id));
        } else {
            return redirect()->back()->with('error', 'Paramater url tidak valid !');
        }

        $unitItem = UnitItemModel::orderBy('satuan', 'asc');
        $conditionItem = ConditionItemModel::orderBy('kondisi', 'asc');

        $data = [
            'title' => 'Manajemen Barang',
            'bc1' => 'Pendataan',
            'bc2' => $form,
            'item' => $searchItem,
            'param' => Crypt::encrypt($paramOutgoing),
            'unitItem' => $unitItem,
            'conditionItem' => $conditionItem
        ];

        return view('item.form-items', $data);
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

        return view('item.detail-items', $data);
    }

    public function saveItem(ItemRequest $request): RedirectResponse
    {
        $request->validated();
        $formData = [
            'id' => htmlentities($request->input('id')),
            'kode_barang' => htmlentities($request->input('kodeBarang')),
            'nama_barang' => htmlentities($request->input('namaBarang')),
            'jenis' => htmlentities($request->input('jenis')),
            'merek' => htmlentities($request->input('merek')),
            'tipe' => htmlentities($request->input('tipe')),
            'nomor_seri' => htmlentities($request->input('nomorSeri')),
            'ukuran' => htmlentities($request->input('ukuran')),
            'bahan' => htmlentities($request->input('bahan')),
            'jumlah' => htmlentities($request->input('jumlah')),
            'stok_distribusi' => htmlentities($request->input('jumlah')),
            'satuan_barang_id' => htmlentities($request->input('satuan')),
            'harga' => htmlentities($request->input('harga')),
            'sumber_dana' => htmlentities($request->input('sumberDana')),
            'kondisi_barang_id' => htmlentities($request->input('kondisi')),
            'tahun_pengadaan' => htmlentities($request->input('tahun')),
            'nomor_kontrak' => htmlentities($request->input('nomorKontrak')),
            'tanggal_kontrak' => Carbon::createFromFormat('d F Y', htmlentities($request->input('tanggalKontrak')))->format('Y-m-d')
        ];

        $paramIncoming = Crypt::decrypt($request->input('param'));
        $save = null;

        $uploadedDirKontrak = 'edoc/kontrak/';
        $uploadedDirImage = 'edoc/images/';

        if ($paramIncoming == 'save') {
            // Upload edoc file
            if (!$request->file('edoc')) {
                return redirect()->back()->with('error', 'Edoc file belum di unggah ulang !')->withInput();
            }
            $fileEdoc = $request->file('edoc');

            $uploadedFileName = time() . '-' . $fileEdoc->hashName();
            $uploadedPath = $uploadedDirKontrak . $uploadedFileName;

            $fileUpload = $fileEdoc->storeAs($uploadedDirKontrak, $uploadedFileName, 'public');
            if (!$fileUpload) {
                return back()->with('error', 'Unggah edoc file gagal !')->withInput();
            }

            // Upload image file
            if (!$request->file('image')) {
                return redirect()->back()->with('error', 'Gambar belum di unggah ulang !')->withInput();
            }
            $fileImage = $request->file('image');

            $uploadedImageFileName = time() . '-' . $fileImage->hashName();
            $uploadedImagePath = $uploadedDirImage . $uploadedImageFileName;

            $fileImageUpload = $fileImage->storeAs($uploadedDirImage, $uploadedImageFileName, 'public');
            if (!$fileImageUpload) {
                return back()->with('error', 'Unggah edoc file gagal !')->withInput();
            }

            $formData['file_edoc'] = $uploadedPath;
            $formData['status'] = 'Pengajuan';
            $formData['keterangan'] = htmlentities($request->input('keterangan'));
            $formData['diinput_oleh'] = Auth::user()->id;
            $formData['file_image'] = $uploadedImagePath;

            $save = ItemModel::create($formData);
            $success = 'Pendataan barang berhasil disimpan !';
            $error = 'Pendataan barang gagal disimpan !';
        } elseif ($paramIncoming == 'update') {
            $item = ItemModel::findOrFail(Crypt::decrypt($request->input('id')));

            if ($request->hasFile('edoc')) {
                // Upload edoc file
                $fileEdoc = $request->file('edoc');

                $uploadedFileName = time() . '-' . $fileEdoc->hashName();
                $uploadedPath = $uploadedDirKontrak . $uploadedFileName;

                $fileUpload = $fileEdoc->storeAs($uploadedDirKontrak, $uploadedFileName, 'public');
                if (!$fileUpload) {
                    return back()->with('error', 'Unggah edoc file gagal !')->withInput();
                }

                // Remove old edoc file
                if ($item->file_edoc && Storage::disk('public')->exists($item->file_edoc)) {
                    Storage::disk('public')->delete($item->file_edoc);
                }
                $formData['file_edoc'] = $uploadedPath;
            }
            $formData['status'] = 'Pengajuan';
            $formData['keterangan'] = htmlentities($request->input('keterangan'));
            $formData['diinput_oleh'] = Auth::user()->id;

            if ($request->hasFile('image')) {
                // Upload image file
                $fileImage = $request->file('image');

                $uploadedImageFileName = time() . '-' . $fileImage->hashName();
                $uploadedImagePath = $uploadedDirImage . $uploadedImageFileName;

                $fileUpload = $fileImage->storeAs($uploadedDirImage, $uploadedImageFileName, 'public');
                if (!$fileUpload) {
                    return back()->with('error', 'Unggah gambar gagal !')->withInput();
                }

                // Remove old image file
                if ($item->file_image && Storage::disk('public')->exists($item->file_image)) {
                    Storage::disk('public')->delete($item->file_image);
                }
                $formData['file_image'] = $uploadedImagePath;
            }

            $save = $item->update($formData);
            $success = 'Pendataan barang berhasil diperbarui !';
            $error = 'Pendataan barang gagal diperbarui !';
        } else {
            return redirect()->back()->with('error', 'Parameter tidak valid !')->withInput();
        }

        if (!$save) {
            return redirect()->back()->with('error', $error)->withInput();
        }
        return redirect()->route('dashboard.barang')->with('success', $success);
    }

    public function deleteItem(Request $request): RedirectResponse
    {
        $item = ItemModel::findOrFail(Crypt::decrypt($request->id));
        if ($item) {

            // Remove old edoc file
            if ($item->file_edoc && Storage::disk('public')->exists($item->file_edoc)) {
                Storage::disk('public')->delete($item->file_edoc);
            }

            // Remove old image file
            if ($item->file_image && Storage::disk('public')->exists($item->file_image)) {
                Storage::disk('public')->delete($item->file_image);
            }

            $item->delete();
            return redirect()->route('dashboard.barang')->with('success', 'Pendataan barang berhasil dihapus !');
        }
        return redirect()->route('dashboard.barang')->with('error', 'Pendataan barang gagal dihapus !');
    }

    public function printItemCollection(Request $request)
    {
        $searchItem = ItemModel::findOrFail(Crypt::decrypt($request->id));
        $unitItem = UnitItemModel::find($searchItem->satuan_barang_id);
        $conditionItem = ConditionItemModel::find($searchItem->kondisi_barang_id);
        $user = User::find($searchItem->diinput_oleh);
        if (VerificationModel::find($searchItem->verifikasi_id)) {
            $verification = VerificationModel::find($searchItem->verifikasi_id);
            $verifikator =  User::find($verification->verifikator_id);
        } else {
            $verification = null;
            $verifikator = null;
        }


        $pageTitle = 'Lembar Pendataan ' . $searchItem->nama_barang . ' Tanggal ' . $searchItem->created_at;

        $data = [
            'title' => 'Verifikasi Barang',
            'bc1' => 'Verifikasi Barang',
            'bc2' => 'Detail : ' . $searchItem->nama_barang,
            'item' => $searchItem,
            'unitItem' => $unitItem,
            'conditionItem' => $conditionItem,
            'user' => $user,
            'verification' => $verification,
            'verifikator' => $verifikator,
            'institusi' => SettingModel::first(),
            'pageTitle' => $pageTitle
        ];

        $pdf = PDF::loadView('item.pdf.template-pdf-collection', $data);
        $pdf->setPaper('A4', 'potrait');
        return $pdf->stream($pageTitle . '.pdf');
    }
    public function printItemCard(Request $request)
    {
        $searchItem = ItemModel::findOrFail(Crypt::decrypt($request->id));
        $pageTitle = 'Kartu Inventaris ' . $searchItem->nama_barang . ' Tanggal ' . $searchItem->created_at;
        $url = url('/verification') . '/' . $searchItem->id;
        $qrCode = base64_encode(QrCode::format('png')->size(60)->generate($url));

        $data = [
            'title' => 'Verifikasi Barang',
            'bc1' => 'Verifikasi Barang',
            'bc2' => 'Detail : ' . $searchItem->nama_barang,
            'item' => $searchItem,
            'institusi' => SettingModel::first(),
            'pageTitle' => $pageTitle,
            'qrCode' => $qrCode
        ];

        $pdf = PDF::loadView('item.pdf.template-pdf-inventory-card', $data);
        $pdf->setPaper('A4', 'potrait');
        return $pdf->stream($pageTitle . '.pdf');

        // return view('item.pdf.template-pdf-inventory-card', $data);
    }
    public function printListDistributionItem(Request $request)
    {
        $searchDistributionItem =DistributionItemModel::with('rooms')->with('listDistributionItems.items')->find(Crypt::decrypt($request->id));
        $pageTitle = 'Daftar Inventaris Ruangan, Tanggal' . $searchDistributionItem->created_at;
        $searchReceiver = OfficerModel::findOrfail($searchDistributionItem->penerima);
        $searchVerificator = VerificationModel::findOrfail($searchDistributionItem->verifikasi_id);
        $verifikator = User::findOrfail($searchVerificator->verifikator_id);

        $data = [
            'title' => 'Daftar Inventaris Ruangan',
            'bc1' => 'Daftar Inventaris Ruangan',
            'bc2' => 'Detail : ' . $searchDistributionItem->rooms[0]->ruangan,
            'distribution' => $searchDistributionItem,
            'institusi' => SettingModel::first(),
            'pageTitle' => $pageTitle,
            'penerima' => $searchReceiver,
            'verifikator' => $verifikator
        ];
        $pdf = PDF::loadView('item.pdf.template-pdf-dir', $data);
        $pdf->setPaper('A4', 'potrait');
        return $pdf->stream($pageTitle . '.pdf');
    }
}
