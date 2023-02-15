<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Blanjaloka</title>

    <!-- Fonts -->

    <link rel="stylesheet" href="{{ Vite::asset('resources/css/app.scss') }}">
</head>
<body>
<section class="mx-2 my-2 mt-2 mb-2">
   <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-4">
<div class="card bg-primary-blue-1" style="width: 25rem;">
              <div class="card-body">
                      <div class="bg-primary-blue-1 p-3 mb-4 card-notif">
                    <img src="{{ Vite::asset('resources/js/assets/images/blanjaloka_logo_blue.png') }}">
                    <div class="mt-2">
                    <h1 class="text-neutral-gray-5">
                      Akun anda diterima Admin!
                    </h1>
                    <p>Selamat!, akun anda telah memenuhi syarat pendaftaran Blanjaloka.</p> 
                  </div>
                </div>
            </div>
          </div>
          </div>
</div>
</div>
</div>
</body>
</section>
<style type="text/css">
	
.card-notif h1 {
  font-size: 1.25rem;
}

@media (max-width: 575.98px) {
  section {
    margin-top: 15rem !important;
  }

  .card-notif h1 {
    font-size: 1rem;
  }
}
</style>