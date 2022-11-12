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
        <th>Nomer Telp</th>
        <th>Pembimbing 1</th>
        <th>Pembimbing 2</th>
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
        </tr>
        @php($i++)
    @endforeach
    </tbody>
</table>

</html>
