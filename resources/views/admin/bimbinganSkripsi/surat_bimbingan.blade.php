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
            margin-left: 2cm;
            margin-right:2cm;
            margin-bottom: 3cm; 
            margin-top: 0cm; 
            font-size: 12px;
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
        <br>
        <h1 class="text-center">KARTU PEMBIMBING SKRIPSI</h1>
        <br>
        <table class="table">
            <tr>
                <td style="width: 20px">Nama Mahasiswa</td>
                <td style="width: 1px">:</td>
                <td style="width: 50px">{{$bimbinganSkripsi['nama']}}</td>
            </tr>
            <tr>
                <td style="width: 20px">NIM</td>
                <td style="width: 1px">:</td>
                <td style="width: 50px">{{$bimbinganSkripsi['nim']}}</td>
            </tr>
            <tr>
                <td style="width: 20px">Program Studi</td>
                <td style="width: 1px">:</td>
                <td style="width: 50px">{{$bimbinganSkripsi['prodi']}}</td>
            </tr>
            <tr>
                <td style="width: 20px">Pembimbing Utama</td>
                <td style="width: 1px">:</td>
                <td style="width: 50px">{{$bimbinganSkripsi['pembimbing1']}}</td>
            </tr>
            <tr>
                <td style="width: 20px">Judul Skripsi</td>
                <td style="width: 1px">:</td>
                <td style="width: 50px">{{$bimbinganSkripsi['judul_skripsi']}}</td>
            </tr>
            <br>
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
        {{-- <footer>
            <img src="img/footer-kop.png" width="100%"/>
        </footer> --}}
    </div>



    <header>
        <img src="img/kop-feb.png" width="60%"/>
    </header>
    <div id="halaman">
        <br>
        <h1 class="text-center">KARTU PEMBIMBING SKRIPSI</h1>
        <br>
        <table class="table">
            <tr>
                <td style="width: 20px">Nama Mahasiswa</td>
                <td style="width: 1px">:</td>
                <td style="width: 50px">{{$bimbinganSkripsi['nama']}}</td>
            </tr>
            <tr>
                <td style="width: 20px">NIM</td>
                <td style="width: 1px">:</td>
                <td style="width: 50px">{{$bimbinganSkripsi['nim']}}</td>
            </tr>
            <tr>
                <td style="width: 20px">Program Studi</td>
                <td style="width: 1px">:</td>
                <td style="width: 50px">{{$bimbinganSkripsi['prodi']}}</td>
            </tr>
            <tr>
                <td style="width: 20px">Pembimbing Pendamping</td>
                <td style="width: 1px">:</td>
                <td style="width: 50px">{{$bimbinganSkripsi['pembimbing2']}}</td>
            </tr>
            <tr>
                <td style="width: 20px">Judul Skripsi</td>
                <td style="width: 1px">:</td>
                <td style="width: 50px">{{$bimbinganSkripsi['judul_skripsi']}}</td>
            </tr>
            <br>
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
        {{-- <footer>
            <img src="img/footer-kop.png" width="100%"/>
        </footer> --}}
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>
