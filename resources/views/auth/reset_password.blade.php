@extends('layouts.base')
@section('content')
<div class="container" >
<h1 align="center">Kode verifikasi dan link reset telah dikirim ke email anda :). Token akan kadaluwarsa dalam 24 jam.</h1>
<div class="d-flex justify-content-center">
<form method="post" action="{{ route('password.update') }}">
   @csrf
<div class="mb-3 row">
    <label class="col-sm-10 col-form-label">Masukkan email anda !</label>
    <div class="col-sm-10">
      <input type="email" name="email"  class="form-control " >
    </div>
  </div>
    <div class="mb-3 row">
    <label class="col-sm-10 col-form-label">Masukkan password baru!</label>
    <div class="col-sm-10">
      <input type="password" name="password"  class="form-control " >
    </div>
  </div>
    <div class="mb-3 row">
    <label class="col-sm-10 col-form-label">Konfrimasi password baru !</label>
    <div class="col-sm-10">
      <input type="password" name="password_confirmation"  class="form-control " >
    </div>
  </div>
       
      <input type="hidden" name="token" value="{{ $request->route('token') }}"  >
   
<button type="submit" class="btn btn-primary">Kirim</button><br>
</form>
    </div>

</div>
@endsection