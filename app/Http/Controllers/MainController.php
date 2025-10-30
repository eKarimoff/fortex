<?php

namespace App\Http\Controllers;

use App\Http\Repositories\CountryRepository;
use App\Http\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Models\Debtor;
use App\Models\Country;
use App\Models\User;
use App\Models\Insurance;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    /**
     * @param \App\Http\Repositories\UserRepository $userRepository
     * @param \App\Http\Repositories\CountryRepository $countryRepository
     */
    public function __construct(UserRepository $userRepository, CountryRepository $countryRepository)
    {
        $this->userRepository    = $userRepository;
        $this->countryRepository = $countryRepository;
    }
    public function getInsurances()
    {
        $insurances = Insurance::with(['country','user'])->orderBy('created_at')->paginate(25);

        return view('main-page')
                ->with(['countries'
                        => $this->countryRepository->all(),'users' => $this->userRepository->all(),
                        'insurances' => $insurances,'daily'=>$insurances->sum('budget')
                ]);

    }

    public function approveInsurance(Request $request, int $id)
    {
        Insurance::updateOrCreate(
            ['id' => $id],
            ['status' => $request->status]
        );

        return redirect()->back();
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createInsurance(Request $request)
    {
         Insurance::create([
            'user_id' =>  $request->user_id,
            'country_id' => $request->country_id,
            'car_number' => $request->car_number,
            'budget' => $request->budget,
            'insurance_number' => $request->insurance_number,
            'client_name' => $request->client_name,
        ]);

        return redirect()->back()->with('success','Ma\'lumot muvofaqiyatli saqlandi!');
    }

    public function createDebtor(Request $request)
    {
        $qarz = new Debtor();
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
        return view('qarzdorlar')
            ->with(
                [
                    'countries' => $this->countryRepository->all(),
                    'users' => $this->userRepository->all(),
                ]);
    }

    public function hisoblash()
    {
        $kunlik = DB::table("insurances")
            ->select('id',DB::raw("SUM(CASE WHEN created_at >= NOW() - INTERVAL 1 WEEK THEN amount ELSE 0 END"))->get();
        return view('main-page')->with(['kunlik'=>$kunlik]);
    }

    public function search(Request $request)
    {
        $search = $request->search;

        $insurances = Insurance::with(['country','user'])->whereHas('user', function($q) use ($search) {
            $q->where('name', 'LIKE', '%'.$search.'%');
        })->orWhereHas('country', function($q1) use ($search) {
            $q1->where('name', 'LIKE', '%'.$search.'%');
        })
        ->orWhere('budget', 'LIKE', '%'.$search.'%')
        ->orWhere('car_number','LIKE', '%'.$search.'%')
        ->orWhere('insurance_number','LIKE', '%'.$search.'%')
        ->orWhere('created_at','LIKE', '%'.$search.'%')
        ->orWhere('client_name','LIKE', '%'.$search.'%')
        ->paginate(25);

        $daily = $insurances->sum('budget');

        return view('main-page')
            ->with(['insurances'=> $insurances,
                    'countries' => $this->countryRepository->all(),
                    'users'     => $this->userRepository->all(),
                    'daily'     => $daily
            ]);
    }
}
