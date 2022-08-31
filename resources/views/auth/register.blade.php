@extends('layouts.base')
@section('content')
<div class="container" >
<h3 align="center">Register ;D</h3>
<div class="d-flex justify-content-center">
<form method="post" action="{{route('konfirmasi')}}">
    @csrf
<div class="mb-3 row">
    <label class="col-sm-10 col-form-label">Nama</label>
    <div class="col-sm-10">
      <input type="text" name="name"  class="form-control " >
    </div>
  </div>
<div class="mb-3 row">
    <label class="col-sm-10 col-form-label">Email</label>
    <div class="col-sm-10">
      <input type="email" name="email" class="form-control " >
    </div>
</div>
  <div class="mb-3 row">
    <label class="col-sm-10 col-form-label">Password</label>
    <div class="col-sm-10">
      <input type="password" name="password" class="form-control " >
    </div>
  </div>
<div class="mb-3 row">
    <label class="col-sm-10 col-form-label">Konfirm Password</label>
    <div class="col-sm-10">
      <input type="password" name="password2" class="form-control ">
    </div>
  </div>
<button type="submit" class="btn btn-primary">Daftar</button>
</form>
    </div>
</div>
@endsection