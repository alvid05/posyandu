<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Assesment;
use App\Models\HasilAss;
use App\Models\Schedule;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AssesmentController extends Controller
{

    public function index()
    {
        $assesment = new Assesment();
        $data['ass_audit'] = $assesment->idData(auth()->user()->id);
        $data['pack'] = $assesment->allData();
        $data['all'] = $assesment->allData();
        $data['schedule'] = Schedule::with('pic')->where('date_start','<=',now())
            ->where('date_end','>=',now())
            ->get();
        return view('dashboard.Assesment.assesment-sehat', $data);
    }

    public function create(Request $request)
    {

        $existingHasilAss = HasilAss::where('id_schedule', $request->schedule)
            ->first();

        // If no existing record, create a new one
        if (!$existingHasilAss) {
            $hasil = HasilAss::create([
                'id_schedule' => $request->schedule,
            ]);

        } else {
            // If an existing record is found, use it
            $hasil = $existingHasilAss;
        }

        $dataAssesment = [
            'id_schedule' => $request->schedule,
            'nilai' => '-',
            'hasil_id' => $hasil->id,
            'pack' => $request->pack,
            'kriteria_program' => ucwords(strtolower($request->kriteria)),
            'metode_verifikasi' => $request->metode,
            'deadline' => $request->deadline,
        ];

        $assesment = Assesment::create($dataAssesment);
        if ($assesment) {
            return redirect()->route('view-assesment')->with(['success' => 'Data Assesment Berhasil Ditambahkan.']);
        } else {
            return redirect()->route('view-assesment')->with(['failed' => 'Data Assesment Gagal Ditambahkan.']);
        }
    }


    public function upload(Request $request)
    {
        $file = $request->file('file');
        $file_name = $file->getClientOriginalName();
        $file->move('file',$file_name);

        $assesment = Assesment::find($request->id);
        $assesment->file = $file_name;
        $upload = $assesment->save();

        if ($upload == true){
            return redirect()->route('view-assesment')->with(['success' => 'Upload File Berhasil']);
        }else{
            return redirect()->route('view-assesment')->with(['failed' => 'Upload File Gagal']);
        }
    }

    public function update(Request $request)
    {
        $assesment = Assesment::find($request->id);
        $hasilAss = HasilAss::where('id','=',$assesment->hasil_id)->first();

        if (auth()->user()->role_id < 3){
            $assesment->nilai = $request->nilai;
            $assesment->akar_permasalahan = $request->akar_permasalahan;
            $assesment->akibat = $request->akibat;
            $assesment->rekomendasi = $request->rekomendasi;
            if ($request->nilai == '1'){
                $hasilAss->total = $hasilAss->total + 3.33;
                $hasilAss->save();
            }
            $update = $assesment->save();
        }else{
            $assesment->pack = ucwords(strtolower($request->pack));
            $assesment->kriteria_program = ucwords(strtolower($request->kriteria));
            $assesment->nilai = $request->nilai;
            $assesment->akar_permasalahan = $request->akar_permasalahan;
            $assesment->akibat = $request->akibat;
            $assesment->rekomendasi = $request->rekomendasi;
            $assesment->deadline = $request->deadline;
            $update = $assesment->save();
        }

        if ($update == true){
            return redirect()->route('view-assesment')->with(['success' => 'Data Sudah Di Tetapkan']);
        }else{
            return redirect()->route('view-assesment')->with(['failed' => 'Data Gagal Di Tetapkan']);
        }
    }

    public function delete($id)
    {
        $assesment = Assesment::find($id);

        $delete = $assesment->delete();
        if ($delete == true){
            return redirect()->route('view-assesment')->with(['success' => 'data Sudah Dihapus']);
        }else{
            return redirect()->route('view-assesment')->with(['failed' => 'data Gagal Dihapus']);
        }
    }

    public function add(Request $request)
    {
        $user = Users::where('audit_id', '=', $request->id_audit)->get();

        foreach ($user as $item) {
            // Check if HasilAss record already exists for the given users_id and audit_id
            $existingHasilAss = HasilAss::where('users_id', $item->id)
                ->first();

            // If no existing record, create a new one
            if (!$existingHasilAss) {
                $hasil = HasilAss::create([
                    'users_id' => $item->id,
                    'audit_id' => $request->id_audit,
                ]);
            } else {
                // If an existing record is found, use it
                $hasil = $existingHasilAss;
            }

            $dataAssesment = [
                'id_user' => $item->id,
                'id_audit' => $request->id_audit,
                'nilai' => '-',
                'hasil_id' => $hasil->id,
                'pack' => $request->pack,
                'kriteria_program' => ucwords(strtolower($request->kriteria)),
                'metode_verifikasi' => $request->metode,
                'deadline' => $request->deadline,
            ];

            $assesment = Assesment::create($dataAssesment);

        }
        if ($assesment) {
            return redirect()->route('view-assesment')->with(['success' => 'Data Assesment Berhasil Ditambahkan.']);
        } else {
            return redirect()->route('view-assesment')->with(['failed' => 'Data Assesment Gagal Ditambahkan.']);
        }
    }

    public function aggree($id)
    {
        $assesment = Assesment::find($id);
        $assesment->ket_setuju = 'Setuju';
        $assesment->ket_tidak_setuju = null;
        $assesment->save();

        if ($assesment) {
            return redirect()->route('view-assesment')->with(['success' => 'Comment Sudah Dikirimkan.']);
        } else {
            return redirect()->route('view-assesment')->with(['failed' => 'Comment Gagal Dikirimkan.']);
        }
    }

    public function disagree(Request $request,$id)
    {
        $assesment = Assesment::find($id);
        $assesment->ket_tidak_setuju = $request->tidak_setuju;
        $assesment->ket_setuju = null;
        $assesment->save();

        if ($assesment) {
            return redirect()->route('view-assesment')->with(['success' => 'Comment Sudah Dikirimkan.']);
        } else {
            return redirect()->route('view-assesment')->with(['failed' => 'Comment Gagal Dikirimkan.']);
        }
    }

}
