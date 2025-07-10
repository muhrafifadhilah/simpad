@extends('layouts.app')
@section('content')
<div class="container">
    <h4>Executive Summary Wajib Pajak</h4>
    <div class="alert alert-info">Selamat datang, {{ Auth::user()->name }}!</div>
    <a href="{{ route('wp.sptpd') }}" class="btn btn-primary">Lihat Data SPTPD Saya</a>
</div>
@endsection
