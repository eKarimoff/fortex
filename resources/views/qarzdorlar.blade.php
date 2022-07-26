@extends('layouts.app')

@section('content')
<div class="container">
  @if(Session::has('success'))
  <div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>
  @endif
<div>
  <a href="#" class="btn btn-outline-success mb-2" style="float: right" data-toggle="modal"
      data-target="#exampleModal">Yangi Qarzdor Qo'shish</a>
  </div>

<form method="POST" action="{{ url('qarzdor_qoshish') }}">
  @csrf
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Yangi Qarzdor Qo'shish</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                {{-- <label for="exampleInputEmail1" class="form-label">Kim Tomonidan To'ldirildi</label> --}}
                      <select name="user_id" class="form-control mb-3">
                        <option value="">Kim Tomonidan To'ldirildi</option>
                        @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                {{-- <label for="exampleInputEmail1" class="form-label">Qaysi Davlat</label> --}}
                      <select name="davlat_id" id="" class="form-control mb-3">
                        <option value="">Davlatni Tanlang</option>
                        @foreach ($davlatlar as $davlat)
                        <option value="{{ $davlat->id }}">{{ $davlat->name }}</option>
                        @endforeach
                      </select>
                      {{-- <label class="form-check-label" for="exampleCheck1">Qarzdor ismi</label> --}}
                      <input type="text" class="form-control mb-3" placeholder="Qarzdor ismi" name="qarzdor_ismi">
                      {{-- <label class="form-check-label" for="exampleCheck1">Qaysi Davlatga To'langan</label> --}}
                      {{-- <label class="form-check-label" for="exampleCheck1">Summa</label> --}}
                      <input type="text" class="form-control mb-3" placeholder="Summa" name="summa">
                      {{-- <label class="form-check-label" for="exampleCheck1">Mashina Raqami</label> --}}
                      <input type="text" class="form-control mb-3" placeholder="Mashina Raqami" name="mashina_raqami">
                      {{-- <label class="form-check-label" for="exampleCheck1">Polis Raqami</label> --}}
                      <input type="text" class="form-control mb-3" placeholder="Polis Raqami" name="polis_raqami">
                      {{-- <label class="form-check-label" for="exampleCheck1">Sana:</label> --}}
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
<h3 style="text-align: center">Qarzdorlar Bo'limi</h3>
    <table class="table table-bordered">
        <tr>
          <th>Kim Tomonidan To'ldirildi</th>
          <th>Qarzdor Ismi</th>
          <th>Qaysi Davlatga To'ldirildi</th>
          <th>Summa</th>
          <th>Mashina Raqami</th>
          <th>Polis Raqami</th>
          <th>Sana: </th>
        </tr>
        @foreach ($qarzlar as $qarz)
        <tr>
          <td>{{ $qarz->user->name }}</td>
          <td>{{ $qarz->qarzdor_ismi }}</td>
          <td>{{ $qarz->davlat->name }}</td>
          <td>{{ $qarz->summa }}</td>
          <td>{{ $qarz->mashina_raqami }}</td>
          <td>{{ $qarz->polis_raqami }}</td>
          <td>{{ $qarz->sana }}</td>
        </tr>
        
        @endforeach
      </table>
</div>
@endsection