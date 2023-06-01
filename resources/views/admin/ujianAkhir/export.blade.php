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
        <th>NIK</th>
        <th>Tempat Lahir</th>
        <th>Tanggal Lahir</th>
        <th>Judul Tugas Akhir</th>
        <th>Pembimbing 1</th>
        <th>Pembimbing 2</th>
        <th>Verifikasi</th>
        <th>Status</th>
        <th>Tanggal Ujian</th>
        <th>Keterangan</th>
        <th>Bukti Pembayaran</th>
        <th>File Skripsi</th>
        <th>Ijazah Terakhir</th>
        <th>Transkrips Nilai</th>
        <th>Akta Kelahiran</th>
        <th>Kartu Keluarga</th>
        <th>KTP</th>
        <th>Lembar Bimbingan</th>
        <th>Pembayaran Semester Akhir</th>
        <th>Sertifikat</th>
    </tr>
    </thead>
    <tbody>
    @php($i = 1);
    @foreach($ujianAkhir as $value)
        <tr>
            <td>{{ $i }}</td>
            <td>{{ $value->nim }}</td>
            <td>{{ $value->nama }}</td>
            <td>{{ $value->prodi }}</td>
            <td>{{ $value->no_whatsapp }}</td>
            <td>{{ $value->nik }}</td>
            <td>{{ $value->tempat_lahir }}</td>
            <td>{{ $value->tanggal_lahir }}</td>
            <td>{{ $value->judul_skripsi }}</td>
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
            <td>{{ $value->keterangan }}</td>
            <td>{{ asset('storage/' . $value->bukti_pembayaran) }}</td>
            <td>{{ asset('storage/' . $value->berkas_skripsi) }}</td>
            <td>{{ asset('storage/' . $value->ijazah_terakhir) }}</td>
            <td>{{ asset('storage/' . $value->transkrip_nilai) }}</td>
            <td>{{ asset('storage/' . $value->akta_kelahiran) }}</td>
            <td>{{ asset('storage/' . $value->kartu_keluarga) }}</td>
            <td>{{ asset('storage/' . $value->ktp) }}</td>
            <td>{{ asset('storage/' . $value->lembar_bimbingan) }}</td>
            <td>{{ asset('storage/' . $value->slip_pembayaransemesterterakhir) }}</td>
            <td>{{ asset('storage/' . $value->slip_pembayaranSkripsi) }}</td>
            <td>{{ asset('storage/' . $value->sertifikat) }}</td>

        </tr>
        @php($i++)
    @endforeach
    </tbody>
</table>

</html>
