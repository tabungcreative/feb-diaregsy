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
        <th>Nomer Telp</th>
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
            <td>{{ $value->alamat }}</td>
            <td>{{ $value->email }}</td>
            <td>{{ $value->instansi_magang }}</td>
            <td>{{ $value->pimpinan_instansi }}</td>
            <td>{{ $value->no_whatsapp }}</td>
        </tr>
        @php($i++)
    @endforeach
    </tbody>
</table>

</html>
