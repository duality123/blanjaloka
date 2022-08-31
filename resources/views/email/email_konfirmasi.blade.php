@extends('layouts.base')
@section('content')
<h3>Harap konfirmasikan akun anda</h3>
ketikkan token berikut pada form input {{$token}} atau <a href="route('tokenLinkVerify',$token)">klik link ini</a>
@endsection