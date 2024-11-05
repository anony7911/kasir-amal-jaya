<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Pembelian</title>


    <style>
        @page {
            margin-top: 30px;
            margin-left: 30px;
            margin-right: 30px;
            margin-bottom: 30px;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif, Helvetica, Arial, sans-serif;
        }

        table.bordered {
            border-collapse: collapse;
        }

        table.bordered thead,
        table.bordered body,
        table.bordered tr,
        table.bordered td,
        table.bordered th {
            /* border: 1px solid black; */
            border-top: solid 1px black;
            border-left: solid 1px black;
            border-right: solid 1px black;
            border-bottom: solid 1px black;
        }

        th,
        td {
            padding: 5px;
        }

        .row {
            --bs-gutter-x: 1.5rem;
            --bs-gutter-y: 0;
            display: flex;
            flex-wrap: wrap;
            margin-top: calc(-1 * var(--bs-gutter-y));
            margin-right: calc(-0.5 * var(--bs-gutter-x));
            margin-left: calc(-0.5 * var(--bs-gutter-x));
        }

        .row>* {
            flex-shrink: 0;
            width: 100%;
            max-width: 100%;
            padding-right: calc(var(--bs-gutter-x) * 0.5);
            padding-left: calc(var(--bs-gutter-x) * 0.5);
            margin-top: var(--bs-gutter-y);
        }

        .col {
            flex: 1 0 0%;
        }

        .text-center {
            text-align: center;
        }

        .check {
            width: 20px;
            height: 20px;
            display: inline-block;
            position: relative;
        }

        .check:before {
            content: "";
            position: absolute;
            top: 4px;
            left: 6px;
            width: 4px;
            height: 10px;
            border-bottom: 2px solid black;
            border-right: 2px solid black;
            transform: rotate(45deg);
        }

    </style>
</head>

<body>
    <div style="margin-left:30px;margin-right:20px">
        <table style="width: 100%;aling:center">
            <th style="vertical-align: middle">
                {{-- <img src="{{ asset('/assets/img/amal_jaya.png') }}" alt="logo-amal-jaya" style="width: 140px"> --}}
            </th>
        </table>
        <table style="width: 100%;text-align:center">
            <h5 style="margin-top:5px;margin-bottom:5px">LAPORAN PEMBELIAN</h5>
            <h5 style="margin-top:5px;margin-bottom:5px;font-weight:normal;">PERIODE: {{ Carbon\Carbon::parse($tanggal_awal_pembelian)->format('d-m-Y') }} s/d {{ Carbon\Carbon::parse($tanggal_akhir_pembelian)->format('d-m-Y') }}
            </h5>
        </table>
        <table style="width: 100%;text-align:end">
            <h5 style="margin-top:5px;margin-bottom:5px;font-weight:normal;">Dicetak Tanggal: {{ Carbon\Carbon::now()->format('d-m-Y') }}
            </h5>
        </table>

        <table class="bordered" style="width: 100%; margin-top:5px;font-size:13px">
            <thead>
                <tr style="text-align: center; font-weight:bold">
                    <th style="text-align: center">No</th>
                    <th>Tanggal</th>
                    <th>Supplier</th>
                    <th>Barang</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Total Harga</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($laporan as $row)
                <tr>
                    <td style="text-align: center">{{ $loop->iteration }}.</td>
                    <td style="text-align: center">{{ Carbon\Carbon::parse($row->created_at)->isoFormat('D MMMM Y') }}</td>
                    <td style="text-align: left">{{ $row->nama_supplier }}</td>
                    <td style="text-align: left">[{{ $row->kode_barang }}]
                        {{ $row->nama_barang }}
                    </td>
                    <td style="text-align: center">
                        {{ $row->jumlah_barang }}
                    </td>
                    <td style="text-align: left">

                        Rp. {{ number_format($row->total_harga / $row->jumlah_barang) }}
                    </td>
                    <td style="text-align: right">
                        Rp. {{ number_format($row->total_harga) }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <br>
        <br>
        <br>
        <br>
        <table style="width: 100%; margin-top:15px;font-size:13px;page-break-inside: avoid;">
            <tr>
                <td style="text-align: left">Kolaka,<span style="margin-right: 50px">
                    </span><span style="margin-right: 50px"> </span> {{date('Y')}} </td>
            </tr>
            <tr>
                <td style="text-align: left">
                    Tanda Tangan,
                    <br><br>

                    <br><br>
                    <br><br>
                    <b>CV. AMAL JAYA</b>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
