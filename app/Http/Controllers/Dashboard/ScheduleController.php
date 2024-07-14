<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\Users;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{

    public function index(Request $request)
    {
        $currentYear = date('Y');
        $data['availableYears'] = range($currentYear,$currentYear - 5 );
        $data['selectedYear'] = $request->input('year', date('Y'));
        $data['schedule'] = Schedule::with(['users','audit'])
            ->whereYear('date_start','=',$request->year ?? $currentYear)
            ->orderByDesc('created_at')->get();
        $data['users'] = Users::where('role_id','=',1)->orderBy('name','asc')->get();
        $data['audit'] = Users::where('role_id','=',2)->orderBy('name','asc')->get();
        return view('dashboard.schedule.index',$data);
    }

    public function request(Request $request)
    {
        $redudance =  Schedule::where('id_users','=',$request->pic)->where(function ($query) use ($request) {
                $query->where(function ($subquery) use ($request) {
                    $subquery->where('date_start', '<=', $request->date_end)
                        ->where('date_end', '>=', $request->date_start);
                });
            })
            ->first();

        if ($redudance){
            return redirect()->route('schedule.index')->with(['failed' => 'Schedule Sudah Ada']);
        }else {
            $data_array = array(
                'id_users' => $request->pic,
                'id_audit' => $request->audit,
                'date_start' => $request->date_start,
                'date_end' => $request->date_end,
            );

            $schedule = Schedule::insert($data_array);
            if($schedule == true){
                return redirect()->route('schedule.index')->with(['success' => 'Berhasil Melakukan Request Schedule Assesment']);
            }else{
                return redirect()->route('schedule.index')->with(['failed' => 'Gagal melakukan Request Schedule Assesment']);
            }
        }
    }

    public function delete($id)
    {
        $schedule = Schedule::find($id);
        $delete = $schedule->delete();

        if($delete == true){
            return redirect()->route('schedule.index')->with(['success' => 'Data Schedule Berhasil Di Delete']);
        }else{
            return redirect()->route('schedule.index')->with(['failed' => 'Data Schedule Gagal Di Delete']);
        }
    }


}
