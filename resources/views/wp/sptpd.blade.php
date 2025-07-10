@extends('layouts.app')
@section('content')
<div class="container">
    <h4>Data SPTPD Saya</h4>
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>No SPTPD</th>
                    <th>Tanggal</th>
                    <th>NOPD</th>
                    <th>Masa Pajak</th>
                    <th>Dasar</th>
                    <th>Pajak Terutang</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sptpd as $row)
                <tr>
                    <td>{{ $row->id }}</td>
                    <td>{{ $row->created_at ? $row->created_at->format('d-m-Y') : '' }}</td>
                    <td>{{ $row->objekPajak->nopd ?? '-' }}</td>
                    <td>
                        {{ $row->masa_pajak_awal ? \Carbon\Carbon::parse($row->masa_pajak_awal)->format('d-m-Y') : '' }}
                        s/d
                        {{ $row->masa_pajak_akhir ? \Carbon\Carbon::parse($row->masa_pajak_akhir)->format('d-m-Y') : '' }}
                    </td>
                    <td>{{ number_format($row->dasar, 0, ',', '.') }}</td>
                    <td>{{ number_format($row->pajak_terutang, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
