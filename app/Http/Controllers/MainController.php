<?php

namespace App\Http\Controllers;

use App\Http\Repositories\CountryRepository;
use App\Http\Repositories\UserRepository;
use App\Services\CalculateSales;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Insurance;

class MainController extends Controller
{
    /**
     * @param \App\Http\Repositories\UserRepository $userRepository
     * @param \App\Http\Repositories\CountryRepository $countryRepository
     * @param \App\Services\CalculateSales $calculateSales
     */
    public function __construct(UserRepository $userRepository, CountryRepository $countryRepository, CalculateSales $calculateSales)
    {
        $this->userRepository    = $userRepository;
        $this->countryRepository = $countryRepository;
        $this->calculateSales    = $calculateSales;
    }
    public function getInsurances()
    {
        $insurances = Insurance::with(['user'])->orderBy('created_at')->paginate(25);

        return view('main-page')
                ->with(['users'     => $this->userRepository->all(),
                        'insurances' => $insurances,
                        'sale'=> [
                            'daily' => $this->calculateSales->calculateDailySale(),
                            'weekly' => $this->calculateSales->calculateWeeklySale(),
                            'diffWithLastWeek' => $this->calculateSales->compareSaleWithLastWeek(),
                            'diffWithYesterday' => $this->calculateSales->compareSaleWithYesterday(),
                    ]
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

        return view('main-page')
            ->with(['insurances'=> $insurances,
                    'countries' => $this->countryRepository->getCountries(),
                    'users'     => $this->userRepository->all(),
                    'sale'=> [
                        'daily' => $this->calculateSales->calculateDailySale(),
                        'weekly' => $this->calculateSales->calculateWeeklySale(),
                        'diffWithLastWeek' => $this->calculateSales->compareSaleWithLastWeek(),
                        'diffWithYesterday' => $this->calculateSales->compareSaleWithYesterday(),
                    ]
            ]);
    }
}
