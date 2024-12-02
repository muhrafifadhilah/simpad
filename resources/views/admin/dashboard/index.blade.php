@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4>Dashboard</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card text-center bg-success text-white mb-4">
                                <div class="card-body">
                                    <h5 class="card-title">Pendaftaran</h5>
                                    <p class="card-text">Manage subjek pajak, objek pajak, dan lainnya.</p>
                                    <a href="{{ url('/pendaftaran') }}" class="btn btn-light">Lihat</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-center bg-info text-white mb-4">
                                <div class="card-body">
                                    <h5 class="card-title">Pendataan</h5>
                                    <p class="card-text">Kelola data penting dan laporan pendataan.</p>
                                    <a href="{{ url('/pendataan') }}" class="btn btn-light">Lihat</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-center bg-warning text-white mb-4">
                                <div class="card-body">
                                    <h5 class="card-title">Penerimaan</h5>
                                    <p class="card-text">Pantau dan kelola penerimaan pajak.</p>
                                    <a href="{{ url('/penerimaan') }}" class="btn btn-light">Lihat</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-center bg-danger text-white mb-4">
                                <div class="card-body">
                                    <h5 class="card-title">Penagihan</h5>
                                    <p class="card-text">Kelola penagihan pajak dan status pembayaran.</p>
                                    <a href="{{ url('/penagihan') }}" class="btn btn-light">Lihat</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card text-center bg-secondary text-white mb-4">
                                <div class="card-body">
                                    <h5 class="card-title">Pelayanan</h5>
                                    <p class="card-text">Berikan pelayanan terbaik kepada wajib pajak.</p>
                                    <a href="{{ url('/pelayanan') }}" class="btn btn-light">Lihat</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-center bg-dark text-white mb-4">
                                <div class="card-body">
                                    <h5 class="card-title">Referensi</h5>
                                    <p class="card-text">Atur referensi dan data pendukung lainnya.</p>
                                    <a href="{{ url('/referensi') }}" class="btn btn-light">Lihat</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-center bg-primary text-white mb-4">
                                <div class="card-body">
                                    <h5 class="card-title">B-TAX</h5>
                                    <p class="card-text">Kelola B-TAX dan monitoring data.</p>
                                    <a href="{{ url('/b-tax') }}" class="btn btn-light">Lihat</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-center bg-light text-dark mb-4">
                                <div class="card-body">
                                    <h5 class="card-title">Beranda</h5>
                                    <p class="card-text">Kembali ke halaman utama.</p>
                                    <a href="{{ url('/') }}" class="btn btn-dark">Lihat</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
