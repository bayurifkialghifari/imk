@php
$file = $type . 'laporan' . date('Y-m-d H:i:s') . '.xls';
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=$file");
@endphp
<table id="tahunan" border="1" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Meja</th>
            <th>Atas Nama</th>
            <th>Status</th>
            <th>Waktu Pemesanan</th>
            <th>Total Pembayaran</th>
        </tr>
    </thead>
    <tbody>
        @if ($type == 'daily')
            @foreach ($daily as $d)
                <tr>
                    <td>{{ $d['nomor'] }}</td>
                    <td>{{ $d['atas_nama'] }}</td>
                    <td>{{ $d['status'] }}</td>
                    <td>{{ $d['tanggalpesan'] }}</td>
                    <td>{{ $d['total'] }}</td>
                </tr>
            @endforeach
        @elseif($type == 'weekly')
            @foreach ($weekly as $d)
                <tr>
                    <td>{{ $d['nomor'] }}</td>
                    <td>{{ $d['atas_nama'] }}</td>
                    <td>{{ $d['status'] }}</td>
                    <td>{{ $d['tanggalpesan'] }}</td>
                    <td>{{ $d['total'] }}</td>
                </tr>
            @endforeach
        @elseif($type == 'monthly')
            @foreach ($monthly as $d)
                <tr>
                    <td>{{ $d['nomor'] }}</td>
                    <td>{{ $d['atas_nama'] }}</td>
                    <td>{{ $d['status'] }}</td>
                    <td>{{ $d['tanggalpesan'] }}</td>
                    <td>{{ $d['total'] }}</td>
                </tr>
            @endforeach
        @elseif($type == 'yearly')
            @foreach ($yearly as $d)
                <tr>
                    <td>{{ $d['nomor'] }}</td>
                    <td>{{ $d['atas_nama'] }}</td>
                    <td>{{ $d['status'] }}</td>
                    <td>{{ $d['tanggalpesan'] }}</td>
                    <td>{{ $d['total'] }}</td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
