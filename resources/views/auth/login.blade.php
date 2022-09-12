@extends('layouts.base')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-lg-5">
      <div class="card">
        <div class="card-body">
          <h3 class="text-center mb-4">Login :D</h3>
          <form method="post" action="{{route('login')}}">
            @csrf
            <div class="mb-3">
              <label class="form-label">Email</label>
              <input type="email" name="email" class="form-control">
            </div>
            <div class="mb-3">
              <label class="form-label">Password</label>
              <input type="password" name="password" class="form-control">
            </div>
            <div class="d-flex align-items-end gap-2">
              <button type="submit" class="btn btn-primary">Login</button>
              <a href="/forgot-password">lupa password klik link ini :)</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection