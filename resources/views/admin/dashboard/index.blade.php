@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4>Executive Summary</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-end mb-3">
                            <button id="showTableButton" class="btn btn-success me-2 active">Tabel</button>
                            <button id="showChartButton" class="btn btn-success">Grafik</button>
                        </div>
                        <h5>TARGET ANGGARAN DAN REALISASI TAHUN 2024</h5>

                        <div id="tableContainer" class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th rowspan="2">JENIS PAJAK</th>
                                        <th rowspan="2">TARGET ANGGARAN</th>
                                        <th colspan="3">REALISASI</th>
                                        <th rowspan="2">%</th>
                                        <th>SELISIH</th>
                                    </tr>
                                    <tr>
                                        <th>KEMARIN</th>
                                        <th>HARI INI</th>
                                        <th>S/D HARI INI</th>
                                        <th>Nominal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($taxData as $tax)
                                        <tr>
                                            <td>{{ $tax['jenisPajak'] }}</td>
                                            <td>{{ number_format($tax['targetAnggaran'], 0, ',', '.') }}</td>
                                            <td>{{ number_format($tax['realisasi'], 0, ',', '.') }}</td>
                                            <td>0</td>
                                            <td>{{ number_format($tax['realisasi'], 0, ',', '.') }}</td>
                                            <td>{{ number_format(($tax['realisasi'] / $tax['targetAnggaran']) * 100, 2) }}%</td>
                                            <td>{{ number_format($tax['realisasi'] - $tax['targetAnggaran'], 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td style="font-weight: bold;">JUMLAH</td>
                                        <td style="font-weight: bold;">{{ number_format(array_sum(array_column($taxData, 'targetAnggaran')), 0, ',', '.') }}</td>
                                        <td style="font-weight: bold;">{{ number_format(array_sum(array_column($taxData, 'realisasi')), 0, ',', '.') }}</td>
                                        <td style="font-weight: bold;">0</td>
                                        <td style="font-weight: bold;">{{ number_format(array_sum(array_column($taxData, 'realisasi')), 0, ',', '.') }}</td>
                                        <td style="font-weight: bold;">{{ number_format((array_sum(array_column($taxData, 'realisasi')) / array_sum(array_column($taxData, 'targetAnggaran'))) * 100, 2) }}%</td>
                                        <td style="font-weight: bold;">{{ number_format(array_sum(array_column($taxData, 'realisasi')) - array_sum(array_column($taxData, 'targetAnggaran')), 0, ',', '.') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div id="chartContainer" style="display: none;">
                            <canvas id="combinedChart"></canvas>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    @foreach($taxData as $tax)
                        <div class="col-md-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $tax['jenisPajak'] }}</h5>
                                    <p class="card-text">Realisasi Anggaran 2024: Rp {{ number_format($tax['realisasi'], 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const taxData = @json($taxData); // Pass data using JSON

        const ctxCombined = document.getElementById('combinedChart').getContext('2d');

        const labels = taxData.map(item => item.jenisPajak);
        const realizationData = taxData.map(item => item.realisasi);
        const targetData = taxData.map(item => item.targetAnggaran);

        const dataCombined = {
            labels: labels,
            datasets: [
                {
                    type: 'line',
                    label: 'Target Anggaran',
                    data: targetData,
                    borderColor: 'rgba(255, 99, 132, 1)',
                    fill: false,
                    tension: 0.2,
                    pointRadius: 5,
                    pointStyle: 'circle'
                },
                {
                    type: 'bar',
                    label: 'Realisasi',
                    data: realizationData,
                    backgroundColor: 'rgba(54, 162, 235, 1)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                },
            ]
        };

        const optionsCombined = {
            responsive: true,
            scales: {
                x: {
                    stacked: false,
                    title: {
                        display: true,
                        text: 'Jenis Pajak'
                    }
                },
                y: {
                    stacked: false,
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value.toLocaleString();
                        }
                    },
                    title: {
                        display: true,
                        text: 'Nominal (Rp)'
                    }
                }
            },
            plugins: {
                tooltip: {
                    mode: 'index',
                    intersect: false
                },
                legend: {
                    display: true,
                    position: 'bottom'
                }
            }
        };

        new Chart(ctxCombined, {
            type: 'bar',
            data: dataCombined,
            options: optionsCombined
        });


        document.getElementById('showTableButton').addEventListener('click', () => {
            document.getElementById('tableContainer').style.display = 'block';
            document.getElementById('chartContainer').style.display = 'none';
            document.getElementById('showTableButton').classList.add('active');
            document.getElementById('showChartButton').classList.remove('active');
        });

        document.getElementById('showChartButton').addEventListener('click', () => {
            document.getElementById('chartContainer').style.display = 'block';
            document.getElementById('tableContainer').style.display = 'none';
            document.getElementById('showChartButton').classList.add('active');
            document.getElementById('showTableButton').classList.remove('active');
        });
    </script>
    <style>
        .btn-primary:hover {
            background-color: #28a745;
            color: white;
            border-color: #28a745;
        }

        .btn-success {
            background-color: transparent;
            color: black;
            border: 1px solid #ccc;
        }
        .btn-success:hover {
            background-color: #218838; /* Darker green on hover */
            color: white;
            border-color: #218838;
        }
        .active {
            background-color: #28a745; /* Dark green */
            color: white;
            border-color: #28a745;
        }
    </style>
@endsection