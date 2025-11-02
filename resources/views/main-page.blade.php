@extends('layouts.app')

@section('content')

        <div class="container">
         <div>
          @if(Session::has('success'))
          <div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>
          @endif
        <div>
          <a href="#" class="btn btn-outline-success mb-2" style="float: right" data-toggle="modal"
              data-target="#exampleModal">+Yangi Polis Yozish</a>
          </div>

        <form method="POST" action="{{ url('createInsurance') }}">
          @csrf
          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
              aria-hidden="true">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Yangi Polis Yozish</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body">
                              <select name="user_id" class="form-control mb-3">
                                <option value="">Kim Tomonidan To'ldirildi</option>
                                @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                              <input type="text" class="form-control mb-3" placeholder="Mijoz ismi" name="client_name">
                              <input type="text" class="form-control mb-3" placeholder="Summa" name="budget">
                              <input type="text" class="form-control mb-3" placeholder="Mashina Raqami"
                                     name="car_number">
                              <input type="text" class="form-control mb-3" placeholder="Polis Raqami"
                                     name="insurance_number">
                      </div>
                      <div class="modal-footer">
                          <div id="total"> </div>
                          <button class="btn btn-primary">Saqlash</button>
                      </div>
                  </div>
              </div>
          </div>
        </form>
        <div class="row">
        <div class="col-md-4 col-sm-12 ">
          <div class="card mb-4 rounded-3 shadow-sm">
            <div class="card-header py-3">
              <h4 class="my-0 fw-normal">Kunlik Sotuv</h4>
            </div>
            <div class="card-body d-flex align-items-center">
              <div>
                <h3><i class="bi bi-currency-dollar rounded-circle me-3 " style="color:green; background-color:rgb(225, 251, 225); padding:5px 15px"></i></h3>
              </div>
              <div>
                <div>
                 <h3>{{ $sale['daily'] }} $</h3>
                </div>
                <div>
                   <span class="fw-semibold text-success">{{ $sale['diffWithYesterday'] }}%</span> increase
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4 col-sm-12 ">
          <div class="card mb-4 rounded-3 shadow-sm">
            <div class="card-header py-3">
              <h4 class="my-0 fw-normal">Haftalik Sotuv</h4>
            </div>
            <div class="card-body d-flex align-items-center">
              <div>
                <h3><i class="bi bi-currency-dollar rounded-circle me-3 " style="color:green; background-color:rgb(225, 251, 225); padding:5px 15px"></i></h3>
              </div>
              <div>
                <div>
                 <h3>{{$sale['weekly']}}</h3>
                </div>
                <div>
                   <span class="fw-semibold text-success">{{ $sale['diffWithLastWeek'] }}%</span> increase
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4 col-sm-12 ">
          <div class="card mb-4 rounded-3 shadow-sm">
            <div class="card-header py-3">
              <h4 class="my-0 fw-normal">Oylik Sotuv</h4>
            </div>
            <div class="card-body d-flex align-items-center">
              <div>
                <h3><i class="bi bi-currency-dollar rounded-circle me-3 " style="color:green; background-color:rgb(225, 251, 225); padding:5px 15px"></i></h3>
              </div>
              <div>
                <div>
                 <h3>0</h3>
                </div>
                <div>
                   <span class="fw-semibold text-success">12%</span> increase
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
      <div class="container" >
        <h3 style="text-align:center">Polislar Bo'limi</h3>
          <table class="table table-bordered">
              <tr>
                  <th>Sana:</th>
                  <th>Kim To'ldirgani</th>
                  <th>Mashina Raqami</th>
                  <th>Polis Summa</th>
                  <th>Polis Raqami</th>
                  <th>Mijoz ismi</th>
                  <th>To'lov Holati</th>
              </tr>
              @foreach ($insurances as $insurance)
              <tr>
                  <td>{{ $insurance->created_at->format('Y-m-d') }}</td>
                  <td>{{ $insurance->user->name }}</td>
                  <td>{{ $insurance->car_number }}</td>
                  <td>{{ $insurance->budget }}</td>
                  <td>{{ $insurance->insurance_number }}</td>
                  <td>{{ $insurance->client_name }}</td>
                  <td>
                    <form class="form-horizontal" action="{{url('approveInsurance', $insurance->id)}}" method="post">
                      @csrf
                      @if($insurance->status == 'approved' || $insurance->status == 'rejected')
                      <div class="btn btn-secondary">{{ ucfirst($insurance->status) }}</div>
                      @elseif($insurance->status == 'pending')
                      <input name="status" value="approved" type="submit" class="btn btn-info mt-2">
                      <input name="status" value="rejected" type="submit" class="btn btn-danger mt-2">
                      @endif
                   </form>
                </td>
              </tr>

              @endforeach
            </table>
            <div class="d-flex" style="justify-content: center;">
            {{ $insurances->links() }}
          </div>

      </div>

@endsection



