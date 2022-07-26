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
        
        <form method="POST" action="{{ url('polisYozish') }}">
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
                              <select name="davlat_id" id="" class="form-control mb-3">
                                <option value="">Davlatni Tanlang</option>
                                @foreach ($davlatlar as $davlat)
                                <option value="{{ $davlat->id }}">{{ $davlat->name }}</option>
                                @endforeach
                              </select>
                              <input type="text" class="form-control mb-3" placeholder="Mijoz ismi" name="qarzdor_ismi">
                              <input type="text" class="form-control mb-3" placeholder="Summa" name="summa">
                              <input type="text" class="form-control mb-3" placeholder="Mashina Raqami" name="mashina_raqami">
                              <input type="text" class="form-control mb-3" placeholder="Polis Raqami" name="polis_raqami">
                              <input type="text" class="form-control mb-3" placeholder="Mijoz ismi" name="mijoz_ismi">
                              <input type="text" class="form-control mb-3" placeholder="Sana:" name="sana" >
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
                 <h3>3,150</h3> 
                </div>
                <div>
                  {{-- <span class="fw-semibold text-success">12%</span> increase --}}
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
              
                 <h3>{{ $kunlik }} so'm</h3> 
                 
                 
                </div>
                <div>
                  {{-- <span class="fw-semibold text-success">12%</span> increase --}}
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
                 <h3>3,150</h3> 
                </div>
                <div>
                  {{-- <span class="fw-semibold text-success">12%</span> increase --}}
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
                <th>Qaysi Davlatga To'langan</th>
                <th>Polis Summa</th>
                <th>Polis Raqami</th>
                <th>To'lov Holati</th>
                <th>Mijoz ismi</th>
              </tr>
              @foreach ($polislar as $polis)
              <tr>
                  <td>{{ $polis->sana }}</td>
                  <td>{{ $polis->user->name }}</td>
                  <td>{{ $polis->mashina_raqami }}</td>
                  <td>{{ $polis->davlat->name }}</td>
                  <td>{{ $polis->summa }}</td>
                  <td>{{ $polis->polis_raqami }}</td>
                  <td>
                    <form class="form-horizontal" action="{{url('approve', $polis->id)}}" method="post">
                      @csrf
                      @if($polis->status == 'Approved' || $polis->status == 'Rejected')
                      <input name="action" value="Pending" type="hidden">
                      @elseif($polis->status == 'Pending')
                      <input name="action" value="Approved" type="submit" class="btn btn-info mt-2">
                      <input name="action" value="Rejected" type="submit" class="btn btn-danger mt-2">
                      @endif
                   </form>
                </td>
                  <td>{{ $polis->mijoz_ismi }}</td>
              </tr>
              
              @endforeach
            </table>
            <div class="d-flex" style="justify-content: center;">
            {{ $polislar->links() }}
          </div>
      
      </div>

@endsection



