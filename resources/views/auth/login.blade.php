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
            <h6 class="text-center my-2">Cara Lain</h6>
            <div class="d-flex justify-content-center">
              <a href="{{ route('auth.google.redirect') }}" class="btn btn-danger">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-google"
                  viewBox="0 0 16 16">
                  <path
                    d="M15.545 6.558a9.42 9.42 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.689 7.689 0 0 1 5.352 2.082l-2.284 2.284A4.347 4.347 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.792 4.792 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.702 3.702 0 0 0 1.599-2.431H8v-3.08h7.545z" />
                </svg>
                With Google
              </a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection