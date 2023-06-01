<html>
<style>
    table {
        width: 100%;
        border: 1px solid #000;
    }
    th {
        text-align: center;
        color: #e9aa0b;
    }
</style>
<br>
<br>
<br>
<table>
    <thead>
    <tr>
        <th>No</th>
        <th>Nim</th>
        <th>Nama</th>
        <th>Prodi</th>
        <th>Email</th>
        <th>Nomer Telepon</th>
        <th>Pembimbing 1</th>
        <th>Pembimbing 2</th>
        <th>Verifikasi</th>
        <th>Status</th>
        <th>Tanggal Ujian</th>
        <th>Keterangan</th>
        <th>Bukti Pembayaran</th>
    </tr>
    </thead>
    <tbody>
    @php($i = 1);
    @foreach($kompre as $value)
        <tr>
            <td>{{ $i }}</td>
            <td>{{ $value->nim }}</td>
            <td>{{ $value->nama }}</td>
            <td>{{ $value->prodi }}</td>
            <td>{{ $value->email }}</td>
            <td>{{ $value->no_whatsapp }}</td>
            <td>{{ $value->pembimbing1 }}</td>
            <td>{{ $value->pembimbing2 }}</td>
            <td>
                @if($value->is_verify)
                    Terverifikasi
                @else
                    Belum Terverifikasi
                @endif
            </td>
            <td>{{ $value->status }}</td>
            <td>
                @if ($value->status == 'Lulus' || $value->status == 'Tidak Lulus')
                    Selesai
                @elseif($value->tanggal_ujian == null)
                    Belum Terjadwal
                @else
                    {{ $value->tanggal_ujian }}
                @endif
            </td>
            <td>{{ asset('storage/' . $value->bukti_pembayaran) }}</td>
            <td>{{ $value->keterangan }}</td>
        </tr>
        @php($i++)
    @endforeach
    </tbody>
</table>

</html>
