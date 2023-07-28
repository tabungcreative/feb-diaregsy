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
        <th>Alamat</th>
        <th>Email</th>
        <th>Instansi Magang</th>
        <th>Pimpinan Instansi</th>
        <th>Tanggal Mulai</th>
        <th>Tanggal Selesai</th>
        <th>Nomer Telepon</th>
        <th>Bukti Pembayaran</th>
        <th>Lembar Persetujuan</th>
        <th>Keterangan</th>
        <th>Status</th>
    </tr>
    </thead>
    <tbody>
    @php($i = 1);
    @foreach($magang as $value)
        <tr>
            <td>{{ $i }}</td>
            <td>{{ $value->nim }}</td>
            <td>{{ $value->nama }}</td>
            <td>{{ $value->prodi }}</td>
            @if ($value->tanggal_mulai !== null)
                <td>{{  Carbon\Carbon::parse($value['tanggal_mulai'])->translatedFormat('d F Y')  }}</td>
                <td>{{ Carbon\Carbon::parse($value['tanggal_selesai'])->translatedFormat('d F Y') }}</td>
            @else
                <td>
                    <span class="badge badge-warning">Belum Ditetapkan</span>
                </td>
                <td>
                    <span class="badge badge-warning">Belum Ditetapkan</span>
                </td>
            @endif
            <td>{{ $value->alamat }}</td>
            <td>{{ $value->email }}</td>
            <td>{{ $value->instansi_magang }}</td>
            <td>{{ $value->pimpinan_instansi }}</td>
            <td>{{ $value->no_whatsapp }}</td>
            <td>{{ asset('storage/' . $value->bukti_pembayaran) }}</td>
            <td>{{ asset('storage/' . $value->lembar_persetujuan) }}</td>
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
