@extends('layouts.base')
@section('content')
<div class="container" >
<h1 align="center">ketikan email anda untuk dikirim link verifikasi</h1>
    @if (session('status'))
    <div class="mb-4 font-medium text-sm text-green-600">
        {{ session('status') }}
    </div>
@endif
<div class="d-flex justify-content-center">
<form method="post" >
   @csrf
    <label class="col-sm-10 col-form-label">Masukkan Email</label>
    <div class="col-sm-10">
      <input type="email" name="email"  class="form-control " >
    </div>
<button type="submit" class="btn btn-primary">Kirim</button><br>
<small>Klik link berikut untuk resend :)</small>
</form>
    </div>

</div>
@endsection