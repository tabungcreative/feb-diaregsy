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
        <th>Nomer Telepon</th>
        <th>Jenis Pendaftaran</th>
        <th>Bukti Pembayaran</th>
        <th>Keterangan</th>
        <th>Status</th>
    </tr>
    </thead>
    <tbody>
    @php($i = 1);
    @foreach($spl as $value)
        <tr>
            <td>{{ $i }}</td>
            <td>{{ $value->nim }}</td>
            <td>{{ $value->nama }}</td>
            <td>{{ $value->prodi }}</td>
            <td>{{ $value->no_whatsapp }}</td>
            <td>{{ $value->jenis_pendaftaran }}</td>
            <td>{{asset('storage/' . $value->bukti_pembayaran)}}</td>
            <td>{{ $value->keterangan }}</td>
            <td>
                @if($value->is_verify)
                    Terverifikasi
                @else
                    Belum Terverifikasi
                @endif
            </td>
        </tr>
        @php($i++)
    @endforeach
    </tbody>
</table>

</html>
