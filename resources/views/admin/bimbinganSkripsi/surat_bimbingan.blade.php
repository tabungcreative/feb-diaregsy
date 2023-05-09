<!DOCTYPE html>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Surat Penempatan - {{ $mahasiswa['nama'] }} - {{ $mahasiswa['nim'] }}</title>
    <style>
        header {
            /* position: fixed; */
            top: 0cm;
            left: 0cm;
            right: 0cm;
            padding: 30px;
        }
        /** Define the footer rules **/
        footer {
            padding: 30px;
            /* position: fixed; */
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
        }
        * {
            font-family: 'Times New Roman', Times, serif;
        }
        #halaman{
            margin-left:0.5cm;
            margin-right:0.5cm;
            margin-bottom: 3cm;
            margin-top: 0cm;
            font-size: 12px;
            max-height: 60vh;
        }
        .kop{
            float: left;
        }
        .kop-alamat{
            clear: left;
            border: 2px solid purple;
            width: 100%;
            font-size: 8px;
        }
        .head{
            color: purple;
            line-height: 0.7cm;
        }
        .isi{
            margin-left:1cm;
        }
        .isi p{
            margin: 0;
        }
        table.bimbingan thead tr th{
            border: 1px solid black;
            text-align: center
        }
        table.bimbingan tbody tr td{
            border: 1px solid black;
            height:65%;
        }
    </style>
</head>

<body>
    <header>
        <img src="img/kop-feb.png" width="60%"/>
    </header>
    <div id="halaman">
        <h3 class="text-center">KARTU PEMBIMBING TUGAS AKHIR</h3>
        <br>
        <table class="table" width="100">
            <tr>
                <td style="padding-right: 20px">Nama Mahasiswa</td>
                <td> : </td>
                <td style="padding-left: 20px">{{$bimbinganSkripsi['nama']}}</td>
            </tr>
            <tr>
                <td style="padding-right: 20px">NIM</td>
                <td> : </td>
                <td style="padding-left: 20px">{{$bimbinganSkripsi['nim']}}</td>
            </tr>
            <tr>
                <td style="padding-right: 20px">Program Studi</td>
                <td> : </td>
                <td style="padding-left: 20px">{{$bimbinganSkripsi['prodi']}}</td>
            </tr>
            <tr>
                <td style="padding-right: 20px; white-space: nowrap;">Pembimbing Utama</td>
                <td> : </td>
                <td style="padding-left: 20px">{{$bimbinganSkripsi['pembimbing1']}}</td>
            </tr>
            <tr>
                <td style="padding-right: 20px">Judul Skripsi</td>
                <td> : </td>
                <td style="padding-left: 20px">{{$bimbinganSkripsi['judul_skripsi']}}</td>
            </tr>
        </table>
        <table class="table bimbingan">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal Pembimbingan</th>
                    <th>Tanda Tangan Pembimbing Utama</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
        <br>
        <img src="img/footer-kop.png" width="100%"/>
    </div>



    <header>
        <img src="img/kop-feb.png" width="60%"/>
    </header>
    <div id="halaman">
        <h3 class="text-center">KARTU PEMBIMBING TUGAS AKHIR</h3>
        <table class="table" width="100">
            <tr>
                <td style="padding-right: 20px">Nama Mahasiswa</td>
                <td> : </td>
                <td style="padding-left: 20px">{{$bimbinganSkripsi['nama']}}</td>
            </tr>
            <tr>
                <td style="padding-right: 20px">NIM</td>
                <td> : </td>
                <td style="padding-left: 20px">{{$bimbinganSkripsi['nim']}}</td>
            </tr>
            <tr>
                <td style="padding-right: 20px">Program Studi</td>
                <td> : </td>
                <td style="padding-left: 20px">{{$bimbinganSkripsi['prodi']}}</td>
            </tr>
            <tr>
                <td style="padding-right: 20px; white-space: nowrap;">Pembimbing Pendamping</td>
                <td> : </td>
                <td style="padding-left: 20px">{{$bimbinganSkripsi['pembimbing2']}}</td>
            </tr>
            <tr>
                <td style="padding-right: 20px">Judul Skripsi</td>
                <td> : </td>
                <td style="padding-left: 20px">{{$bimbinganSkripsi['judul_skripsi']}}</td>
            </tr>
        </table>
        <table class="table bimbingan">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal Pembimbingan</th>
                    <th>Tanda Tangan Pembimbing Pendamping</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
        <br>
        <img src="img/footer-kop.png" width="100%"/>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>
