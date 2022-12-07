<html>
<head>
    <style>
        /**
            Set the margins of the page to 0, so the footer and the header
            can be of the full height and width !
         **/
        @font-face {
            font-family: 'Garamond';
            src: url({{ storage_path('fonts/garamond.ttf') }}) format('truetype');
        }

        @page {
            margin: 0cm 0cm;
            font-family: 'Garamond', serif;
        }

        /** Define now the real margins of every page in the PDF **/
        body {
            margin-top: 3cm;
            margin-left: 1cm;
            margin-right: 1cm;
            margin-bottom: 2cm;
        }

        /** Define the header rules **/
        header {
            position: fixed;
            top: 0cm;
            left: 0cm;
            right: 0cm;
            padding: 30px;
        }

        /** Define the footer rules **/
        footer {
            padding: 30px;
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
        }

        table {
            width: 100%;
            font-size: 11px;
        }
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        th, td {
            padding: 5px;
        }

        h3 {
            text-align: center;
            margin-bottom: 40px;
        }
    </style>
    @yield('style')
    <title>{{ $title ?? '' }}</title>
</head>
<body>
<!-- Define header and footer blocks before your content -->
<header>
    <img src="data:image/png;base64, {{ $kop }}" width="60%"/>
</header>

<footer>
    <img src="data:image/png;base64, {{ $footerKop }}" width="100%"/>
</footer>

<!-- Wrap the content of your PDF inside a main tag -->
<main>
    @yield('content')
</main>
</body>
</html>
