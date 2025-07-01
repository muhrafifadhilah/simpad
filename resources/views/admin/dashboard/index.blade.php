@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="d-flex justify-content-between p-3 align-items-center mb-5" style="background-color: #D5ED9F; margin-top: -70px; border-radius: 25px;">
                    <h4>Executive Summary</h4>
                        @if (Auth::user())
                            <div class="dropdown ms-3">
                                <span class="dropdown-toggle text-black" href="#" data-bs-toggle="dropdown">Hi, {{ Auth::user()->userid }}</span>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="{{ url('/profile') }}" style="color: black;">Profil</a></li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="dropdown-item" style="color: black;">Logout</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        @endif
                </div>

                {{-- TABULASI --}}
                <div class="card mb-4">
                    <div class="card-body d-flex gap-5" style="background-color: #FFFBE6">
                        <div class="d-flex flex-column" style="background-color: white; padding: 20px; border-radius: 20px; border-top: 5px solid #00712D; border-right: 5px solid #00712D; width: 802.3px;">
                            <div class="d-flex justify-content-between mb-3">
                                <div class="d-flex flex-column gap-1">
                                    <span style="color: #00712D; font-size: 20px; font-weight: bold;">Tabulasi penerimaan pajak daerah</span>
                                    <span style="color: #857E7E">Tahun 2025</span>
                                </div>
                                <div>
                                    <button id="showTableButton" class="btn btn-success me-2 active">Tabel</button>
                                    <button id="showChartButton" class="btn btn-success">Grafik</button>
                                </div>
                            </div>
    
                            <div id="tableContainer" class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th style="color: #FF6600">Jenis Pajak</th>
                                            <th style="color: #FF6600">Target (RP.)</th>
                                            <th style="color: #FF6600">Realisasi (RP.)</th>
                                            <th style="color: #FF6600">Progres (%)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($taxData as $tax)
                                        @php
                                            $persen = ($tax['targetAnggaran'] > 0) ? ($tax['realisasi'] / $tax['targetAnggaran']) * 100 : 0;
                                            $style = $persen > 100 ? 'style=background-color:#00712D!important;color:white!important;' : '';
                                        @endphp
                                        <tr>
                                            <td {!! $style !!}>{{ $tax['jenisPajak'] }}</td>
                                            <td {!! $style !!}>{{ number_format($tax['targetAnggaran'], 0, ',', '.') }}</td>
                                            <td {!! $style !!}>{{ number_format($tax['realisasi'], 0, ',', '.') }}</td>
                                            <td {!! $style !!}>{{ number_format($persen, 2) }}%</td>
                                        </tr>
                                    @endforeach
                                        <tr>
                                            <td style="font-weight: bold; color: #00712D">Total</td>
                                            <td style="font-weight: bold; color: #00712D">{{ number_format(array_sum(array_column($taxData, 'targetAnggaran')), 0, ',', '.') }}</td>
                                            <td style="font-weight: bold; color: #00712D">{{ number_format(array_sum(array_column($taxData, 'realisasi')), 0, ',', '.') }}</td>
                                            {{-- <td style="font-weight: bold;">0</td>
                                            <td style="font-weight: bold;">{{ number_format(array_sum(array_column($taxData, 'realisasi')), 0, ',', '.') }}</td> --}}
                                            <td style="font-weight: bold; color: #00712D">{{ number_format((array_sum(array_column($taxData, 'realisasi')) / array_sum(array_column($taxData, 'targetAnggaran'))) * 100, 2) }}%</td>
                                            {{-- <td style="font-weight: bold;">{{ number_format(array_sum(array_column($taxData, 'realisasi')) - array_sum(array_column($taxData, 'targetAnggaran')), 0, ',', '.') }}</td> --}}
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div id="chartContainer" style="display: none; width: 757.51px;">
                                <canvas id="combinedChart"></canvas>
                            </div>
                        </div>

                        <div class="d-flex flex-column" style="background-color: white; padding: 20px; border-radius: 20px; border-top: 5px solid #FF6600; border-right: 5px solid #FF6600">
                            <div class="d-flex gap-3 mb-3 flex-column">
                                <div class="d-flex flex-column">
                                    <span style="color: #00712D; font-size: 20px; font-weight: bold;">Total Penerimaan</span>
                                    <span style="color: #857E7E">Tahun 2025</span>
                                </div>
                                <img src="/assets/img/semut.svg" alt="" style="width: 300px; align-self: center;">
                                <div class="d-flex flex-column gap-2 justify-content-center align-items-center p-2" style="background-color: #EEEDF0; border-radius: 30px; border-top: 3px solid #00712D; border-right: 3px solid #00712D">
                                    <span style="color: #00712D; font-size: 20px; font-weight: bold;">Rp.{{ number_format(array_sum(array_column($taxData, 'realisasi')), 0, ',', '.') }}</span>
                                    <span style="color: #857E7E;">Proges: <span style="color: #FF6600; font-weight: bold">{{ number_format((array_sum(array_column($taxData, 'realisasi')) / array_sum(array_column($taxData, 'targetAnggaran'))) * 100, 2) }}%</span></span>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
                {{-- TABULASI --}}

                {{-- TABULASI --}}
                <div class="card" >
                    <div class="card-body d-flex gap-5 flex-column" style="background-color: #FFFBE6">
                    <div class="d-flex flex-column gap-1">
                        <span style="color: #00712D; font-size: 20px; font-weight: bold;">Perbandingan Realisasi Tahun Pajak Dan Tahun Sebelumnya</span>
                        <span style="color: #857E7E">Tahun 2025 & 2024</span>
                    </div>
                    <div class="row justify-content-center g-3">
                        @foreach($taxData as $tax)
                            <div class="col-3 d-flex flex-column align-items-center p-3" style="margin-left: 20px; border-top: 2px solid #FF6600; border-right: 2px solid #FF6600; border-radius:25px;">
                                <div class="text-center" style="border-radius: 10px; background-color: #D5ED9F; padding-top: 10px; padding-bottom: 10px; width: 100%;">
                                    <img src="{{ $tax['img'] }}" alt="" style="width: 50px">
                                </div>
                                <span style="color: #00712D; text-align:center; margin-top: 5px; line-height: 20px; height: 40px">{{ $tax['jenisPajak'] }}</span>
                                <div style="background-color: black; height: 1px; width: 100%; margin-top: 5px"></div>
                                <span style="color: #00712D; text-align:center; margin-top: 5px;">2025 : <span style="color: black">Rp.{{ $tax['realisasi'] }}</span></span>
                                <span style="color: #FF6600; text-align:center; margin-top: 5px;">2024 : <span style="color: black">Rp.{{ $tax['tahunLalu'] }}</span></span>
                                <div class="w-100 text-end">
                                    <a href="" style="color: #606060; margin-top: 5px; text-decoration: none; text-align: end;">Lihat detail</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                {{-- TABULASI --}}

                {{-- TABULASI --}}
                <div class="card mt-4">
                        <div class="d-flex flex-column" style="background-color: white; padding: 20px; border-radius: 20px; border-top: 5px solid #00712D; border-right: 5px solid #00712D;">
                            <div class="d-flex justify-content-between mb-3">
                                <div class="d-flex flex-column gap-1">
                                    <span style="color: #00712D; font-size: 20px; font-weight: bold;">Tabulasi Penerimaan Pajak Daerah Per Bulan</span>
                                    <span style="color: #857E7E">Tahun 2025</span>
                                </div>
                                <div>
                                    <button id="showTableButton2" class="btn btn-success me-2 active">Tabel</button>
                                    <button id="showChartButton2" class="btn btn-success">Grafik</button>
                                </div>
                            </div> 
    
                            <div id="tableContainer2" class="table-responsive" style="overflow-x: auto; white-space: nowrap;">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th style="color: #FF6600">Jenis Pajak</th>
                                            <th style="color: #FF6600">Target TW 1 (Rp.)</th>
                                            <th style="color: #FF6600">Januari (Rp.)</th>
                                            <th style="color: #FF6600">Februari (Rp.)</th>
                                            <th style="color: #FF6600">Maret (Rp.)</th>
                                            <th style="color: #FF6600">Real TW 1 (%)</th>
                                            <th style="color: #FF6600">Target TW 2 (Rp.)</th>
                                            <th style="color: #FF6600">April (Rp.)</th>
                                            <th style="color: #FF6600">Mei (Rp.)</th>
                                            <th style="color: #FF6600">Juni (Rp.)</th>
                                            <th style="color: #FF6600">Real TW 2 (%)</th>
                                            <th style="color: #FF6600">Target TW 3 (Rp.)</th>
                                            <th style="color: #FF6600">Juli (Rp.)</th>
                                            <th style="color: #FF6600">Agustus (Rp.)</th>
                                            <th style="color: #FF6600">September (Rp.)</th>
                                            <th style="color: #FF6600">Real TW 3 (%)</th>
                                            <th style="color: #FF6600">Target TW 4 (Rp.)</th>
                                            <th style="color: #FF6600">Oktober (Rp.)</th>
                                            <th style="color: #FF6600">November (Rp.)</th>
                                            <th style="color: #FF6600">Desember (Rp.)</th>
                                            <th style="color: #FF6600">Real TW4 (%)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($taxData2 as $tax)
                                            <tr>
                                                <td>{{ $tax['jenisPajak'] }}</td>
                                                <td>{{ number_format($tax['targetTW1'], 0, ',', '.') }}</td>
                                                <td>{{ number_format($tax['januari'], 0, ',', '.') }}</td>
                                                <td>{{ number_format($tax['februari'], 0, ',', '.') }}</td>
                                                <td>{{ number_format($tax['maret'], 0, ',', '.') }}</td>
                                                <td>{{ number_format((($tax['januari'] + $tax['februari'] + $tax['maret']) / $tax['targetTW1']) * 100, 2) }}%</td>
                                                <td>{{ number_format($tax['targetTW2'], 0, ',', '.') }}</td>
                                                <td>{{ number_format($tax['april'], 0, ',', '.') }}</td>
                                                <td>{{ number_format($tax['mei'], 0, ',', '.') }}</td>
                                                <td>{{ number_format($tax['juni'], 0, ',', '.') }}</td>
                                                <td>{{ number_format((($tax['april'] + $tax['mei'] + $tax['juni']) / $tax['targetTW2']) * 100, 2) }}%</td>
                                                <td>{{ number_format($tax['targetTW3'], 0, ',', '.') }}</td>
                                                <td>{{ number_format($tax['juli'], 0, ',', '.') }}</td>
                                                <td>{{ number_format($tax['agustus'], 0, ',', '.') }}</td>
                                                <td>{{ number_format($tax['september'], 0, ',', '.') }}</td>
                                                <td>{{ number_format((($tax['juli'] + $tax['agustus'] + $tax['september']) / $tax['targetTW3']) * 100, 2) }}%</td>
                                                <td>{{ number_format($tax['targetTW4'], 0, ',', '.') }}</td>
                                                <td>{{ number_format($tax['oktober'], 0, ',', '.') }}</td>
                                                <td>{{ number_format($tax['november'], 0, ',', '.') }}</td>
                                                <td>{{ number_format($tax['desember'], 0, ',', '.') }}</td>
                                                <td>{{ number_format((($tax['oktober'] + $tax['november'] + $tax['desember']) / $tax['targetTW4']) * 100, 2) }}%</td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td style="font-weight: bold; color: #00712D">Total</td>
                                            <td style="font-weight: bold; color: #00712D">{{ number_format(array_sum(array_column($taxData2, 'targetTW1')), 0, ',', '.') }}</td>
                                            <td style="font-weight: bold; color: #00712D">{{ number_format(array_sum(array_column($taxData2, 'januari')), 0, ',', '.') }}</td>
                                            <td style="font-weight: bold; color: #00712D">{{ number_format(array_sum(array_column($taxData2, 'februari')), 0, ',', '.') }}</td>
                                            <td style="font-weight: bold; color: #00712D">{{ number_format(array_sum(array_column($taxData2, 'maret')), 0, ',', '.') }}</td>
                                            <td style="font-weight: bold; color: #00712D">
                                                @php
                                                    $totalTargetTW1 = array_sum(array_column($taxData2, 'targetTW1'));
                                                    $totalRealisasiTW1 = array_sum(array_column($taxData2, 'januari')) + array_sum(array_column($taxData2, 'februari')) + array_sum(array_column($taxData2, 'maret'));
                                                @endphp
                                                {{ $totalTargetTW1 > 0 ? number_format(($totalRealisasiTW1 / $totalTargetTW1) * 100, 2) . '%' : '0%' }}
                                            </td>
                                            <td style="font-weight: bold; color: #00712D">{{ number_format(array_sum(array_column($taxData2, 'targetTW2')), 0, ',', '.') }}</td>
                                            <td style="font-weight: bold; color: #00712D">{{ number_format(array_sum(array_column($taxData2, 'april')), 0, ',', '.') }}</td>
                                            <td style="font-weight: bold; color: #00712D">{{ number_format(array_sum(array_column($taxData2, 'mei')), 0, ',', '.') }}</td>
                                            <td style="font-weight: bold; color: #00712D">{{ number_format(array_sum(array_column($taxData2, 'juni')), 0, ',', '.') }}</td>
                                            <td style="font-weight: bold; color: #00712D">
                                                @php
                                                    $totalTargetTW1 = array_sum(array_column($taxData2, 'targetTW2'));
                                                    $totalRealisasiTW1 = array_sum(array_column($taxData2, 'april')) + array_sum(array_column($taxData2, 'mei')) + array_sum(array_column($taxData2, 'juni'));
                                                @endphp
                                                {{ $totalTargetTW1 > 0 ? number_format(($totalRealisasiTW1 / $totalTargetTW1) * 100, 2) . '%' : '0%' }}
                                            </td>
                                            <td style="font-weight: bold; color: #00712D">{{ number_format(array_sum(array_column($taxData2, 'targetTW3')), 0, ',', '.') }}</td>
                                            <td style="font-weight: bold; color: #00712D">{{ number_format(array_sum(array_column($taxData2, 'juli')), 0, ',', '.') }}</td>
                                            <td style="font-weight: bold; color: #00712D">{{ number_format(array_sum(array_column($taxData2, 'agustus')), 0, ',', '.') }}</td>
                                            <td style="font-weight: bold; color: #00712D">{{ number_format(array_sum(array_column($taxData2, 'september')), 0, ',', '.') }}</td>
                                            <td style="font-weight: bold; color: #00712D">
                                                @php
                                                    $totalTargetTW1 = array_sum(array_column($taxData2, 'targetTW3'));
                                                    $totalRealisasiTW1 = array_sum(array_column($taxData2, 'juli')) + array_sum(array_column($taxData2, 'agustus')) + array_sum(array_column($taxData2, 'september'));
                                                @endphp
                                                {{ $totalTargetTW1 > 0 ? number_format(($totalRealisasiTW1 / $totalTargetTW1) * 100, 2) . '%' : '0%' }}
                                            </td>
                                            <td style="font-weight: bold; color: #00712D">{{ number_format(array_sum(array_column($taxData2, 'targetTW4')), 0, ',', '.') }}</td>
                                            <td style="font-weight: bold; color: #00712D">{{ number_format(array_sum(array_column($taxData2, 'oktober')), 0, ',', '.') }}</td>
                                            <td style="font-weight: bold; color: #00712D">{{ number_format(array_sum(array_column($taxData2, 'november')), 0, ',', '.') }}</td>
                                            <td style="font-weight: bold; color: #00712D">{{ number_format(array_sum(array_column($taxData2, 'desember')), 0, ',', '.') }}</td>
                                            <td style="font-weight: bold; color: #00712D">
                                                @php
                                                    $totalTargetTW1 = array_sum(array_column($taxData2, 'targetTW4'));
                                                    $totalRealisasiTW1 = array_sum(array_column($taxData2, 'oktober')) + array_sum(array_column($taxData2, 'november')) + array_sum(array_column($taxData2, 'desember'));
                                                @endphp
                                                {{ $totalTargetTW1 > 0 ? number_format(($totalRealisasiTW1 / $totalTargetTW1) * 100, 2) . '%' : '0%' }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div id="chartContainer2" style="display: none;">
                                <canvas id="combinedChart2"></canvas>
                            </div>
                        </div>
                    
                </div>
                {{-- TABULASI --}}
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const taxData = @json($taxData); // Pass data using JSON
        const taxData2 = @json($taxData2); // Pass data using JSON

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

        const ctxTaxPerMonth = document.getElementById('combinedChart2').getContext('2d');
        const monthLabels = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        
        const datasetsPerMonth = taxData2.map((item, index) => ({
            label: item.jenisPajak,
            data: [
                item.januari,
                item.februari,
                item.maret,
                item.april,
                item.mei,
                item.juni,
                item.juli,
                item.agustus,
                item.september,
                item.oktober,
                item.november,
                item.desember
            ],
            backgroundColor: `hsl(${index * 35}, 70%, 60%)`
        }));

        const chartPerMonth = new Chart(ctxTaxPerMonth, {
            type: 'bar',
            data: {
                labels: monthLabels,
                datasets: datasetsPerMonth
            },
            options: {
                responsive: true,
                interaction: {
                    mode: 'index',
                    intersect: false
                },
                scales: {
                    y: {
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
                    legend: {
                        position: 'bottom'
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                let value = context.parsed.y;
                                return `${label}: Rp${value.toLocaleString()}`;
                            }
                        }
                    }
                }
            }
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

        document.getElementById('showTableButton2').addEventListener('click', () => {
            document.getElementById('tableContainer2').style.display = 'block';
            document.getElementById('chartContainer2').style.display = 'none';
            document.getElementById('showTableButton2').classList.add('active');
            document.getElementById('showChartButton2').classList.remove('active');
        });

        document.getElementById('showChartButton2').addEventListener('click', () => {
            document.getElementById('chartContainer2').style.display = 'block';
            document.getElementById('tableContainer2').style.display = 'none';
            document.getElementById('showChartButton2').classList.add('active');
            document.getElementById('showTableButton2').classList.remove('active');
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