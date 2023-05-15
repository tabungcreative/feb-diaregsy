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
            padding: 0px;
            position: relative;
        }
        /** Define the footer rules **/
        footer {
            padding: 0px;
            position: absolute;
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
            margin-bottom: 0cm;
            margin-top: 0cm;
            font-size: 12px;
            max-height: 100vh;
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
        <table class="table" width="100%">
            <tr>
                <td style="width: 20%">Nama Mahasiswa</td>
                <td style="width: 2%"> : </td>
                <td style="width: 78%">{{$bimbinganSkripsi['nama']}}</td>
            </tr>
            <tr>
                <td style="width: 20%">NIM</td>
                <td style="width: 2%"> : </td>
                <td style="width: 78%">{{$bimbinganSkripsi['nim']}}</td>
            </tr>
            <tr>
                <td style="width: 20%">Program Studi</td>
                <td style="width: 2%"> : </td>
                <td style="width: 78%">{{ ucwords($bimbinganSkripsi['prodi'])}}</td>
            </tr>
            <tr>
                <td style="width: 20%">Pembimbing Utama</td>
                <td style="width: 2%"> : </td>
                <td style="width: 78%">{{$bimbinganSkripsi['pembimbing1']}}</td>
            </tr>
            <tr>
                <td style="width: 20%">Judul Tugas Akhir</td>
                <td style="width: 2%"> : </td>
                <td style="width: 78%">{{$bimbinganSkripsi['judul_skripsi']}}</td>
            </tr>
        </table>
        <table class="table bimbingan" width="100%">
            <thead>
                <tr>
                    <th style="width: 5%; vertical-align: middle">No</th>
                    <th style="width: 20%; vertical-align: middle">Tanggal Pembimbingan</th>
                    <th style="width: 20%; vertical-align: middle">Tanda Tangan Pembimbing Utama</th>
                    <th style="width: 55%; vertical-align: middle">Keterangan</th>
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
        <p>* Masa berlaku kartu bimbingan sampai {{ $masaBerlaku }}</p>
    </div>
    <footer>
        <img src="img/footer-kop.png" width="100%"/>
    </footer>



    <header style="margin-top: 30px;">
        <img src="img/kop-feb.png" width="60%"/>
    </header>
    <div id="halaman">
        <h3 class="text-center">KARTU PEMBIMBING TUGAS AKHIR</h3>
        <br>
        <table class="table" width="100%">
            <tr>
                <td style="width: 20%">Nama Mahasiswa</td>
                <td style="width: 2%"> : </td>
                <td style="width: 78%">{{$bimbinganSkripsi['nama']}}</td>
            </tr>
            <tr>
                <td style="width: 20%">NIM</td>
                <td style="width: 2%"> : </td>
                <td style="width: 78%">{{$bimbinganSkripsi['nim']}}</td>
            </tr>
            <tr>
                <td style="width: 20%">Program Studi</td>
                <td style="width: 2%"> : </td>
                <td style="width: 78%">{{ucwords($bimbinganSkripsi['prodi'])}}</td>
            </tr>
            <tr>
                <td style="width: 20%">Pembimbing Pendamping</td>
                <td style="width: 2%"> : </td>
                <td style="width: 78%">{{$bimbinganSkripsi['pembimbing2']}}</td>
            </tr>
            <tr>
                <td style="width: 20%">Judul Tugas Akhir</td>
                <td style="width: 2%"> : </td>
                <td style="width: 78%">{{$bimbinganSkripsi['judul_skripsi']}}</td>
            </tr>
        </table>
        <table class="table bimbingan">
            <thead>
                <tr>
                    <th style="width: 5%; vertical-align: middle">No</th>
                    <th style="width: 20%; vertical-align: middle">Tanggal Pembimbingan</th>
                    <th style="width: 20%; vertical-align: middle">Tanda Tangan Pembimbing Utama</th>
                    <th style="width: 55%; vertical-align: middle">Keterangan</th>
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
        <p>* Masa berlaku kartu bimbingan sampai {{ $masaBerlaku }}</p>
    </div>
    <footer>
        <img src="img/footer-kop.png" width="100%"/>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>
