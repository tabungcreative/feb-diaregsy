<!DOCTYPE html>
<head>
    <title>Surat Penempatan - {{ $mahasiswa['nama'] }} - {{ $mahasiswa['nim'] }}</title>
    <meta charset="utf-8">
    <style>
        /* @page { size: 14cm 21cm portrait; } */
        /* @media print {
            body {transform: rotate(90deg);}
        } */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        #judul{
            text-align:center;
            margin: 10px 0px;
        }
        header {
            padding: 30px 30px 10px;
        }
        #halaman{
            width: 100%;
            height: auto;
            /* position: absolute;  */
            padding-left: 30px;
            padding-right: 30px;
            padding-bottom: 80px;
        }
        .terbilang {
            float: left;
            padding: 40px 20px;
        }
        .ttd {
            float: right;
            align-items: center;
            margin-right: 100px;
            text-align: center;
        }
        table td {
            padding: 10px;
        }
        footer {
            padding: 30px;
            position: relative;
            bottom: 0;
        }
    </style>

</head>

<body>

    <header>
        {{-- <img src="data:image/png;base64, {{ $kop }}" alt="Red dot" width="500px"/> --}}
    </header>

    <div id=halaman>
        <h4>Surat Penempatan Magang</h4>

        asdasdsadasd
    </div>

    <footer>
        {{-- <img src="data:image/png;base64, {{ $footerKop }}" alt="Red dot" width="90%"/> --}}
    </footer>
</body>

</html>
