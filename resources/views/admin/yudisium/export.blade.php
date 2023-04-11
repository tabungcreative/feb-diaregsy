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
        <th>Judul Skripsi</th>
        <th>Tanggal Mulai</th>
        <th>Tanggal Ujian</th>
        <th>Jenis Kelamin</th>
        <th>Pembimbing 1</th>
        <th>Pembimbing 2</th>
        <th>No Telepon</th>
        <th>Ukuran Toga</th>
        <th>Bukti Pembayaran</th>
        <th>Bebas SPP</th>
        <th>Transkrip Nilai</th>
        <th>Bebas Perpustakaan</th>
        <th>Artikel</th>
        <th>File Tugas Akhir</th>
        <th>Bebas Plagiasi</th>
        <th>Bukti Penjilitan</th>
        <th>Bukti Pengumpulan</th>
        <th>Keterangan</th>
        <th>Status</th>
    </tr>
    </thead>
    <tbody>
    @php($i = 1);
    @foreach($yudisium as $value)
        <tr>
            <td>{{ $i }}</td>
            <td>{{ $value->nim }}</td>
            <td>{{ $value->nama }}</td>
            <td>{{ $value->prodi }}</td>
            <td>{{ $value->judul_skripsi }}</td>
            <td>{{ $value->tanggal_mulai }}</td>
            <td>{{ $value->tanggal_ujian }}</td>
            <td>{{ $value->jenis_kelamin }}</td>
            <td>{{ $value->pembimbing1 }}</td>
            <td>{{ $value->pembimbing2 }}</td>
            <td>{{ $value->no_whatsapp }}</td>
            <td>{{ strtoupper($value->ukuran_toga) }}</td>
            <td>{{ asset('storage/' . $value->bukti_pembayaran) }}</td>
            <td>{{ asset('storage/' . $value->bebas_spp) }}</td>
            <td>{{ asset('storage/' . $value->transkrip_nilai) }}</td>
            <td>{{ asset('storage/' . $value->bebas_perpus) }}</td>
            <td>{{ asset('storage/' . $value->artikel) }}</td>
            <td>{{ asset('storage/' . $value->file_skripsi) }}</td>
            <td>{{ asset('storage/' . $value->bebas_plagiasi) }}</td>
            <td>{{ asset('storage/' . $value->bukti_penjilidan) }}</td>
            <td>{{ asset('storage/' . $value->bukti_pengumpulan) }}</td>

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
