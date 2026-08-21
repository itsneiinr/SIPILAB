@extends('layouts.app')
@section('content')
@php
\Carbon\Carbon::setLocale('id');
@endphp

<style>
.title {
    font-size: 22px;
    font-weight: 600;
    margin-bottom: 15px;
}

.filter-box {
    margin-bottom: 20px;
}

.filter-box input {
    padding: 10px;
    border-radius: 8px;
    border: 1px solid #ddd;
    outline: none;
}

.filter-box input:focus {
    border-color: #5b86e5;
}

.jadwal-container {
    background: white;
    padding: 20px;
    border-radius: 15px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
}

table {
    width: 100%;
    border-collapse: collapse;
}

table th {
    background: #f4f7fe;
    padding: 12px;
    text-align: left;
    font-size: 14px;
}

table td {
    padding: 12px;
    border-bottom: 1px solid #eee;
    font-size: 14px;
}

table tr:hover {
    background: #f9f9f9;
}

.status {
    padding: 5px 10px;
    border-radius: 8px;
    font-size: 12px;
    color: white;
}

.selesai { background: #4CAF50; }
.belum { background: #f44336; }
</style>

<div class="title">Daftar Jadwal Piket</div>
<div class="filter-box">
    <input type="date" id="filterTanggal">
</div>

<div class="jadwal-container">
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Hari</th>
                <th>Lab</th>
                <th>Jam</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody id="jadwalTable">
        @forelse($jadwal as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td data-date="{{ $item->tanggal }}">
                {{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}
            </td>

            <td>
                {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('l') }}
            </td>

            <td>
                {{ $item->laboratorium->nama_lab }}
            </td>

            <td>
                {{ date('H:i', strtotime($item->jam_mulai)) }}
                -
                {{ date('H:i', strtotime($item->jam_selesai)) }}
            </td>

            <td>
                @if($item->status == 'Selesai')
                    <span class="status selesai">
                        Selesai
                    </span>
                @else
                    <span class="status belum">
                        Belum
                    </span>
                @endif
            </td>
        </tr>

        @empty

        <tr>
            <td colspan="6" style="text-align:center;">
                Belum ada jadwal piket
            </td>
        </tr>

        @endforelse
        </tbody>
    </table>
</div>

<script>
document.getElementById("filterTanggal").addEventListener("change", function() {
    let selectedDate = this.value;
    let rows = document.querySelectorAll("#jadwalTable tr");

    rows.forEach(row => {
        let tanggal = row.children[1].getAttribute("data-date");

        if (tanggal === selectedDate || selectedDate === "") {
            row.style.display = "";
        } else {
            row.style.display = "none";
        }
    });
});
</script>

@endsection