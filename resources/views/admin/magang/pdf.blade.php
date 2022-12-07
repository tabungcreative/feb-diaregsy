<!DOCTYPE html>
<head>
    <title>Surat Penempatan - {{ $mahasiswa['nama'] }} - {{ $mahasiswa['nim'] }}</title>
    <meta charset="utf-8">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {font-family:'Times New Roman', Times, serif;font-size:12pt;padding:0;margin:0;}
        header {
            padding: 30px 30px 10px;
        }
        footer {
            padding: 30px;
            position: relative;
            bottom: 0;
        }
        table{
            margin-left: auto;
            margin-right: auto;
        }
        table tr td{
            padding: 4px;
        }
        .halaman{
            margin-top:50px; 
            margin-left: 200px;
        }
    </style>

</head>

<body>

    <header>
        {{-- <img src="data:image/png;base64, {{ $kop }}" alt="Red dot" width="500px"/> --}}
    </header>

    <table>
        <tr style='height:18px'>
            <td>Nomor</td>
            <td>:</td>
            <td>54 / FEB-UNSIQ / VII / 2022</td>
            <td></td>
            <td></td>
            <td></td>
            <td>Wonosobo, 18 Juli 2022  </td>
        </tr>
        <tr>
            <td>Lamp</td>
            <td>:</td>
            <td>-</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Perihal</td>
            <td>:</td>
            <td><b><u> Surat Penempatan Magang</u></b></td>
            <td></td>
            <td></td>
            <td></td>
            <td>Kepada Yth. </td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>Pimpinan Kant</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td ></td>
            <td style="width: 10px"></td>
            <td style="width: 10px"></td>
            <td style="width: 10px"></td>
            <td>Di-
                <div style="text-align: center"><u>Tempat</u></div>
            </td>
        </tr>
    </table>
    <div class="halaman">
        <p>Assalamu’alaikumWr. Wb.</p>
        <p style="text-align: justify; text-indent: 0.5in;">Puji syukur kehadirat Allah SWT yang telah memberikan segala yang <br> terbaik bagi kita semua, Amin... Sholawat serta salam kita haturkan kepada <br> Nabi Besar Muhammad SAW.</p>
        <p style="text-align: justify; text-indent: 0.5in;">Dengan hormat, bersama surat ini kami sampaikan bahwa mahasiswa/i kami <br> dibawah ini :</p>
        <table>
            <tr>
                <th>NO</th>
                <th>NAMA</th>
                <th>NIM</th>
                <th>Program Studi</th>
            </tr>
            <tr>
                <td>1</td>
                <td>{{ $mahasiswa['nama'] }}</td>
                <td>{{ $mahasiswa['nim'] }}</td>
                <td>{{ $mahasiswa['prodi'] }}</td>
            </tr>
        </table>
        <p style="text-align: justify;text-indent:0.5in;">Akan melakukan kegiatan magang yang dilaksanakan dalam kurun <br> waktu 2 (Dua) bulan pertanggal 1 Agustus s.d 1 Oktober 2022  di Instansi / <br> Perusahaan yang Bapak/Ibu pimpin. Kami mohon agar mahasiswa tersebut <br> untuk dapat dibimbing dan diberi pengarahan pada saat kegiatan magang.</p>
        <p style="text-align: justify;text-indent:0.5in;">Demikian surat penempatan ini, atas perhatiannya kami sampaikan <br> terima kasih.</p>
        <p>Wassalamu’alaikum Wr.Wb.</p>
    </div>

    <footer>
        {{-- <img src="data:image/png;base64, {{ $footerKop }}" alt="Red dot" width="90%"/> --}}
    </footer>
</body>

</html>
