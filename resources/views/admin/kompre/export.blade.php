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
        <th>Bukti Pembayaran</th>
        <th>Keterangan</th>
        <th>Status</th>
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
            <td>{{ asset('storage/' . $value->bukti_pembayaran) }}</td>
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
