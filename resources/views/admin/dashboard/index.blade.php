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
                        <h5>Monitoring-Pajak Daerah</h5>
                        <div class="row" style="row-gap: 20px">
                            <div class="col-4">
                                <div class="card mb-4">
                                    <div class="card-body card-total-pajak">
                                        <div class="text-center">
                                            <h5 class="card-title mb-0 fw-bold">Keseluruhan Data Pajak</h5>
                                            <p class="fw-semibold">Jumlah Total: 3001</p>
                                        </div>
                                        <div class="custom-select-container">
                                            <select name="" id="select-data-pajak" class="custom-select">
                                                <option value="">Semua</option>
                                                <option value="">Pajak Reklame</option>
                                                <option value="">PBJT Mineral Bukan Logam Dan Batuan</option>
                                                <option value="">Pajak Air Tanah</option>
                                                <option value="">PBJT Atas Jasa Kesenian Dan Hiburan</option>
                                                <option value="">PBJT Atas Jasa Perhotelan</option>
                                                <option value="">PBJT Atas Makanan Dan/Atau Minuman</option>
                                                <option value="">PBJT Atas Tenaga Listrik</option>
                                                <option value="">PBJT Atas Jasa Parkir</option>
                                            </select>
                                            <span class="custom-arrow"></span>
                                        </div>
                                        <h5 class="mt-1 fw-bold">Potensi: Rp675.8282.878.212</h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body card-total-pajak">
                                        <div class="text-center">
                                            <h5 class="card-title mb-0 fw-bold">Opsen</h5>
                                            <p class="fw-semibold">Pajak Mineral bukan logam dan batuan</p>
                                            <h5 class="mt-2 fw-bold">Rp900.000.000</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="d-flex flex-row gap-3">
                                    <select name="tahun-pajak" id="tahun-pajak" class="p-2">
                                        <option value="">Tahun Pajak</option>
                                        <option value="">2016</option>
                                        <option value="">2017</option>
                                        <option value="">2018</option>
                                        <option value="">2019</option>
                                        <option value="">2020</option>
                                        <option value="">2021</option>
                                        <option value="">2022</option>
                                        <option value="">2023</option>
                                        <option value="">2024</option>
                                    </select>
                                    <select name="masa-pajak" id="masa-pajak" class="p-2">
                                        <option value="">Masa Pajak</option>
                                        <option value="">2016</option>
                                        <option value="">2017</option>
                                        <option value="">2018</option>
                                        <option value="">2019</option>
                                        <option value="">2020</option>
                                        <option value="">2021</option>
                                        <option value="">2022</option>
                                        <option value="">2023</option>
                                        <option value="">2024</option>
                                    </select>
                                </div>
                                <div class="card mt-2 border-0">
                                    <div class="card-body card-taget-realisasi">
                                        <h5 class="card-title mb-0 fw-bold text-center">Targer Dan Realisasi Tahun (2024)
                                        </h5>
                                        <div class="row mt-3 align-items-center">
                                            <div class="col-4 text-center">
                                                <h6 class="fw-bold">Persentase Target</h6>
                                                <canvas id="persentaseChart" width="200" height="200"></canvas>
                                                <div class="chart-legend d-flex flex-column mt-2">
                                                    <div class="legend-item">
                                                        <div class="legend-color" style="background-color: #F58220;"></div>
                                                        <span>Realisasi</span>
                                                    </div>
                                                    <div class="legend-item">
                                                        <div class="legend-color" style="background-color: #3BA935;"></div>
                                                        <span>Selisih</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-8">
                                                <canvas id="barChart"></canvas>
                                            </div>
                                        </div>
                                        <div class="d-flex-flex-column">
                                            <p class="mb-0 ps-2 fs-5">
                                                Total Anggaran: <b>Rp1.200.721.661.000</b>
                                            </p>
                                            <p class="mb-0 ps-2 fs-5">
                                                Selisih: <b>Rp420.038.973.059</b>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 d-flex justify-content-start">
                                <div class="card border-0" style="width: 80%">
                                    <div class="card-body card-penerimaan">
                                        <h5 class="mb-0">Penerimaan S.D Kemarin</h5>
                                        <p class="total fw-bold ps-2 fs-5 mb-0">
                                            Rp780.130.505.102
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 d-flex justify-content-center">
                                <div class="card border-0" style="width: 80%">
                                    <div class="card-body card-penerimaan">
                                        <h5 class="mb-0">Penerimaan Hari Ini</h5>
                                        <p class="total fw-bold ps-2 fs-5 mb-0">
                                            Rp552.182.839
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 d-flex justify-content-end">
                                <div class="card border-0" style="width: 80%">
                                    <div class="card-body card-penerimaan">
                                        <h5 class="mb-0">Penerimaan S.D Hari Ini</h5>
                                        <p class="total fw-bold ps-2 fs-5 mb-0">
                                            Rp780.682.687.941
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container my-4">
                        <div class="table-container">
                            <h4 class="text-start fw-bold mb-3 ms-3">Tabel List - (Jenis Pajak)</h4>
                            <table class="table table-bordered table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>NPWPD</th>
                                        <th>Nama Wajib Pajak</th>
                                        <th>Jenis MBLB</th>
                                        <th>SPTPD/Pelaporan (Tonase)</th>
                                        <th>Penerimaan</th>
                                        <th>Rencana Produksi</th>
                                        <th>Pengawasan Produksi</th>
                                        <th>Opsen MBLB</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>P.2.0001522.09.127</td>
                                        <td>BATU JAYA MAKMUR, PT</td>
                                        <td>Andesit</td>
                                        <td>2024.09.02.00045/<br>200 T<br><button class="btn btn-custom"
                                                data-bs-toggle="modal" data-bs-target="#showModal">Lihat</button></td>
                                        <td>97.362.720</td>
                                        <td>Agustus 2024</td>
                                        <td>Agustus 2024</td>
                                        <td>25%</td>
                                    </tr>
                                    <tr>
                                        <td>P.2.0001522.09.127</td>
                                        <td>ALOMA WANGI II, PT</td>
                                        <td>Andesit</td>
                                        <td>2024.09.02.00044/<br>0 T<br><button class="btn btn-custom"
                                                data-bs-toggle="modal" data-bs-target="#showModal">Lihat</button></td>
                                        <td>0</td>
                                        <td>Agustus 2024</td>
                                        <td>Agustus 2024</td>
                                        <td>0%</td>
                                    </tr>
                                    <!-- Tambahkan Baris Lainnya -->
                                    <tr>
                                        <td>P.2.0001522.09.127</td>
                                        <td>ALOMA WANGI II, PT</td>
                                        <td>Andesit</td>
                                        <td>2024.09.02.00044/<br>0 T<br><button class="btn btn-custom"
                                                data-bs-toggle="modal" data-bs-target="#showModal">Lihat</button></td>
                                        <td>0</td>
                                        <td>Agustus 2024</td>
                                        <td>Agustus 2024</td>
                                        <td>0%</td>
                                    </tr>
                                    <tr>
                                        <td>P.2.0001522.09.127</td>
                                        <td>ALOMA WANGI II, PT</td>
                                        <td>Andesit</td>
                                        <td>2024.09.02.00044/<br>0 T<br><button class="btn btn-custom"
                                                data-bs-toggle="modal" data-bs-target="#showModal">Lihat</button></td>
                                        <td>0</td>
                                        <td>Agustus 2024</td>
                                        <td>Agustus 2024</td>
                                        <td>0%</td>
                                    </tr>
                                </tbody>
                            </table>
                            <!-- Pagination -->
                            <nav aria-label="Page navigation">
                                <ul class="pagination justify-content-center">
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#" tabindex="-1">Previous</a>
                                    </li>
                                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#">Next</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
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

    <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="showModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="showModalLabel">Unduh Dokumen SPTPD</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-0 ps-0">
                    <button class="btn btn-cetak mb-2">
                        Cetak SPTPD
                    </button>
                    <ol>
                        <li>Batu Jaya Makmur 1</li>
                        <li>Batu Jaya Makmur 2</li>                        
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <script>
        const ctx = document.getElementById('persentaseChart').getContext('2d');

        // Data untuk chart
        const data = {
            labels: ['Selisih', 'Realisasi'], // Label pada chart
            datasets: [{
                data: [34.98, 65.02],
                backgroundColor: ['#3BA935', '#F58220'], // Warna pada chart
                hoverBackgroundColor: ['#3BA935', '#F58220'],
            }]
        };
        const options = {
            plugins: {
                legend: {
                    display: false // Hilangkan legenda default Chart.js
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.label + ': ' + context.raw + '%'; // Menampilkan label & persentase
                        }
                    }
                }
            }
        };

        // Inisialisasi Chart.js
        new Chart(ctx, {
            type: 'pie',
            data: data,
            options: options
        });

        const ctxBar = document.getElementById('barChart').getContext('2d');

        // Data untuk chart Bar
        const barData = {
            labels: ['Jumlah Anggaran (Total)'], // Label untuk sumbu X
            datasets: [{
                    label: 'Kemarin',
                    data: [778755647666], // Data untuk Kemarin
                    backgroundColor: 'rgba(132, 129, 255, 0.6)', // Warna latar belakang bar
                    borderColor: 'rgba(132, 129, 255, 1)', // Warna border bar
                    borderWidth: 1
                },
                {
                    label: 'Hari Ini',
                    data: [77875564766], // Data untuk Hari Ini
                    backgroundColor: 'rgba(255, 99, 132, 0.6)', // Warna latar belakang bar
                    borderColor: 'rgba(255, 99, 132, 1)', // Warna border bar
                    borderWidth: 1
                },
                {
                    label: 'S/D Hari Ini',
                    data: [779288310755], // Data untuk S/D Hari Ini
                    backgroundColor: 'rgba(102, 204, 255, 0.6)', // Warna latar belakang bar
                    borderColor: 'rgba(102, 204, 255, 1)', // Warna border bar
                    borderWidth: 1
                }
            ]
        };

        const optionsBar = {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom' // Posisi legenda di bawah chart
                }
            },
            scales: {
                y: {
                    beginAtZero: true, // Memulai sumbu Y dari 0
                    ticks: {
                        callback: function(value) {
                            return value.toLocaleString(); // Format angka dengan pemisah ribuan
                        }
                    }
                }
            }
        };

        // Inisialisasi Chart.js untuk Bar Chart
        new Chart(ctxBar, {
            type: 'bar',
            data: barData,
            options: optionsBar
        });
    </script>
@endsection
