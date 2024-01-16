<html>
<table>
    <tr>
        <td>No</td>
        <td>Nim</td>
        <td>Nama</td>
        <td>Prodi</td>
        <td>Nomer Telepon</td>
        <td>NIK</td>
        <td>Tempat Lahir</td>
        <td>Tanggal Lahir</td>
        <td>Judul Tugas Akhir</td>
        <td>Pembimbing 1</td>
        <td>Pembimbing 2</td>
        <td>Verifikasi</td>
        <td>Status</td>
        <td>Tanggal Ujian</td>
        <td>Keterangan</td>
        <td>Bukti Pembayaran</td>
        <td>File Skripsi</td>
        <td>Ijazah Terakhir</td>
        <td>Transkrips Nilai</td>
        <td>Akta Kelahiran</td>
        <td>Kartu Keluarga</td>
        <td>KTP</td>
        <td>Lembar Bimbingan</td>
        <td>Pembayaran Semester Akhir</td>
        <td>Sertifikat</td>
    </tr>
    @php($i = 1);
    @foreach($ujianAkhir as $value)
        <tr>
            <td>{{ $i }}</td>
            <td>{{ $value->nim }}</td>
            <td>{{ $value->nama }}</td>
            <td>{{ $value->prodi }}</td>
            <td>{{ $value->no_whatsapp }}</td>
            <td>{{ "'".$value->nik }}</td>
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
</table>

</html>
