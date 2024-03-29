<!DOCTYPE html>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Surat tugas bimbingan tugas akhir - {{ $mahasiswa['nama'] }} - {{ $mahasiswa['nim'] }}</title>
    <style>
         /** Define the header rules **/
        header {
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
        body{
            max-height: 100vh
        }
        #halaman{
            margin-left: 1cm;
            margin-right:1cm;
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
        table.mahasiswa tr th{
            border: 1px solid black;
        }
        table.mahasiswa tr td{
            border: 1px solid black;
        }
    </style>
</head>

<body>
    <header>
        <img src="img/kop-feb.png" width="60%"/>
    </header>
    <div id="halaman">
        <br>
        <h3 class="text-center"><u>SURAT TUGAS PEMBIMBINGAN TUGAS AKHIR</u></h3>
        <h3 class="text-center">{{ str_pad($bimbinganSkripsi['id'] , 3, '0', STR_PAD_LEFT)}}/S.TA/FEB-UNSIQ/{{$rbulan}}/{{$tahun}}</h3>
        <br>
        <p class="fw-bold fst-italic">Assalamu’alaikum Wr. Wb.</p>
        <br>
        <p>Dekan Fakultas Ekonomi dan Bisnis (FEB) Universitas Sains Al-Qur’an (UNSIQ) Jawa Tengah di Wonosobo, memberikan tugas kepada:</p>
        {{-- <table class="table">
            <tr>
                <td style="width: 1px">1. Nama:</td>
                <td style="width: 10px">{{$bimbinganSkripsi['pembimbing1']}}</td>
            </tr>
            <tr>
                <td style="width: 1px"></td>
                <td style="width: 10px">( Selaku Pembimbing I )</td>
            </tr>
            <tr>
                <td style="width: 1px">2. Nama :</td>
                <td style="width: 10px">{{$bimbinganSkripsi['pembimbing2']}}</td>
            <tr>
                <td style="width: 1px"></td>
                <td style="width: 10px">( Selaku Pembimbing II )</td>
            </tr>
        </table> --}}
        <table class="table">
            <tr>
                <td style="width: 20%">1. Nama</td>
                <td style="width: 2%">:</td>
                <td style="width: 78%">{{$bimbinganSkripsi['pembimbing1']}}</td>
            </tr>
            <tr>
                <td style="width: 20%"></td>
                <td style="width: 2%"></td>
                <td style="width: 78%">( Selaku Pembimbing I )</td>
            </tr>
            <tr>
                <td style="width: 20%">2. Nama</td>
                <td style="width: 2%">:</td>
                <td style="width: 78%">{{$bimbinganSkripsi['pembimbing2']}}</td>
            </tr>
            <tr>
                <td style="width: 20%"></td>
                <td style="width: 2%"></td>
                <td style="width: 78%">( Selaku Pembimbing II )</td>
            </tr>
        </table>
        <p>Untuk memberikan bimbingan Tugas Akhir (TA) kepada mahasiswa tersebut di bawah ini :</p>
        <table class="table">
            <tr>
                <td style="width: 20%">Nama</td>
                <td style="width: 2%">:</td>
                <td style="width: 78%">{{$bimbinganSkripsi['nama']}}</td>
            </tr>
            <tr>
                <td style="width: 20%">NIM</td>
                <td style="width: 2%">:</td>
                <td style="width: 78%">{{$bimbinganSkripsi['nim']}}</td>
            </tr>
            <tr>
                <td style="width: 20%">Prodi</td>
                <td style="width: 2%">:</td>
                <td style="width: 78%">{{ucwords($bimbinganSkripsi['prodi'])}}</td>
            </tr>
            <tr>
                <td style="width: 20%">Judul TA </td>
                <td style="width: 2%">:</td>
                <td style="width: 78%">{{$bimbinganSkripsi['judul_skripsi']}}</td>
            </tr>
        </table>
        <p align="justify">Selama melakukan pembimbingan, harus dilaksanakan dengan sungguh-sungguh dan tidak menyimpang dari kaidah keilmuannya. Pembimbingan TA / Skripsi maksimal dilakukan selama 12 bulan (2 Semester). Jika sampai batas waktu yang telah ditentukan mahasiswa tersebut belum menyelesaikan TA / Skripsi, maka TA / Skripsi mahasiswa harus melakukan perpanjangan TA /  Skripsi.</p>
        <br>
        <p>Demikian agar dilaksanakan sebagaimana mestinya.</p>
        <br>
        <p class="fw-bold fst-italic">Wassalamu’alaikum Wr.Wb.</p>
            <br>
            <table class="table">
                <tr>
                    <td style="width: 20px"> </td>
                    <td style="width: 20px"></td>
                    <td style="width: 150px"></td>
                    <td style="width: 20px"></td>
                    <td style="width: 20px"></td>
                    <td style="width: 150px">
                        Dekan<br>
                        Wonosobo, {{$tanggal}}
                    </td>
                </tr>
                <br>
                <br>
                <br>
                <tr>
                    <td style="width: 20px"> </td>
                    <td style="width: 20px"></td>
                    <td style="width: 150px"></td>
                    <td style="width: 20px"></td>
                    <td style="width: 20px"></td>
                    <td style="width: 150px">
                        <strong><u>Dr. M. Elfan Kaukab., S.E., M.M., M.H.I.</u></strong>
                        <br>
                        <p>NIDN : 0627088202 </p>
                    </td>
                </tr>
            </table>
        </div>
        <footer>
            <img src="img/footer-kop.png" width="100%"/>
        </footer>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>
