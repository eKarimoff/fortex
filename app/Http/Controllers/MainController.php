<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Qarzdorlik;
use App\Models\Davlatlar;
use App\Models\User;
use App\Models\Polis;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class MainController extends Controller
{
    public function polisKiritish()
    {
        $davlatlar = Davlatlar::all();
        $users = User::all();
        $polislar = Polis::with(['davlat','user'])->orderBy('created_at')->paginate(25);
        $kunlik = $polislar->sum('summa');
        
   
        return view('boshsahifa')->with(['davlatlar' => $davlatlar,'users' => $users,'polislar' => $polislar,'kunlik'=>$kunlik]);
  
    } 
    public function boshsahifa()
    {
        return view('boshsahifa');
    }
    public function approve(Request $request ,$id)
    {
        $approve = Polis::find($id);
        $approve->status = $request->post('action');
        $approve->save();
       return redirect()->back();
    }

    public function polisYozish(Request $request)
    {
        $polis = new Polis();

        $polis->sana = $request->sana;
        $polis->user_id = $request->user_id;
        $polis->davlat_id = $request->davlat_id;
        $polis->summa = $request->summa;
        $polis->mashina_raqami = $request->mashina_raqami;
        $polis->polis_raqami = $request->polis_raqami;
        $polis->mijoz_ismi = $request->mijoz_ismi;
        $polis->save();
        session()->flash('success','Ma\'lumot muvofaqiyatli saqlandi!');

        return redirect()->back();
    }

    public function qarzdor_qoshish(Request $request)
    {
        $qarz = new Qarzdorlik();
        $qarz->user_id = $request->user_id;
        $qarz->qarzdor_ismi = $request->qarzdor_ismi;
        $qarz->davlat_id = $request->davlat_id;
        $qarz->summa = $request->summa;
        $qarz->polis_raqami = $request->polis_raqami;
        $qarz->mashina_raqami = $request->mashina_raqami;
        $qarz->sana = $request->sana;
        $qarz->save();
        
        session()->flash('success', 'Ma\'lumotlar muvofaqiyatli saqlandi!');
        return redirect()->back();
    }

    public function qarzdorKiritish()
    {
        $qarzlar = Qarzdorlik::all();
        $davlatlar = Davlatlar::all();
        $users = User::all();
        return view('qarzdorlar')->with(['davlatlar' => $davlatlar,'users' => $users,'qarzlar' => $qarzlar]);
    }

    public function hisoblash()
    {
  
        $kunlik = DB::table("polislar")->select('id',DB::raw("SUM(CASE WHEN created_at >= NOW() - INTERVAL 1 WEEK THEN amount ELSE 0 END"))->get();
        return view('boshsahifa')->with(['kunlik'=>$kunlik]);
       
    // $billings = DB::table("polislar")->select(
    //     "sales.store",
    //     DB::raw("SUM(CASE WHEN created_at >= NOW() - INTERVAL 1 WEEK THEN amount ELSE 0 END) weekly_sales",
    //     DB::raw("SUM(CASE WHEN created_at >= NOW() - INTERVAL 1 MONTH THEN amount ELSE 0 END) monthly_sales",
    //     DB::raw("SUM(CASE WHEN created_at >= NOW() - INTERVAL 1 YEAR THEN amount ELSE 0 END) yearly_sales",
    //     DB::raw("SUM(amount) total_sales"))->groupBy("sales.store")->orderByRaw('sales.store ASC'))))

    }
    public function search(Request $request)
    {
        $search = $request->search;
     
        $polislar = Polis::with(['davlat','user'])->whereHas('user', function($q) use ($search) {
            $q->where('name', 'LIKE', '%'.$search.'%');
        })->orWhereHas('davlat', function($q1) use ($search) {
            $q1->where('name', 'LIKE', '%'.$search.'%');
        })
        ->orWhere('summa', 'LIKE', '%'.$search.'%')
        ->orWhere('mashina_raqami','LIKE', '%'.$search.'%')
        ->orWhere('polis_raqami','LIKE', '%'.$search.'%')
        ->orWhere('sana','LIKE', '%'.$search.'%')
        ->orWhere('mijoz_ismi','LIKE', '%'.$search.'%')
        ->paginate(25);
       
        $users = User::all();
        $davlatlar = Davlatlar::all();
        $kunlik = $polislar->sum('summa');

        return view('boshsahifa')->with(['polislar'=> $polislar,'davlatlar' => $davlatlar,'users' => $users,'kunlik'=>$kunlik]);
    }
}