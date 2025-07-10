@extends('layouts.app')
@section('content')
<div class="container" style="margin-top: 20px;">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5>REGISTRASI WAJIB PAJAK</h5>
        <a href="{{ route('wp.create') }}" class="btn btn-primary">Tambah</a>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover" id="wpTable">
            <thead>
                <tr>
                    <th>User ID / NPWPD</th>
                    <th>Nama</th>
                    <th>Tgl. Register</th>
                    <th>Disabled</th>
                </tr>
            </thead>
            <tbody>
                @foreach($wajibPajak as $wp)
                <tr>
                    <td>{{ $wp->user->userid ?? '' }}</td>
                    <td>{{ $wp->name }}</td>
                    <td>{{ $wp->user->created_at ? $wp->user->created_at->format('d-m-Y') : '' }}</td>
                    <td>{{ $wp->disabled ? 'Ya' : 'Tidak' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
