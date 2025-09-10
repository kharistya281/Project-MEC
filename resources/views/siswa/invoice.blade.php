<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    data-client-key="{{ config('midtrans.client_key') }}"></script>
    <title>MEC Ngawi - Invoice</title>
    <style>
        body{
            font-family: Arial, sans-serif;
            padding: 40px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }
        .left{
            text-align: left;
        }
        .right{
            text-align: right;
        }
        .invoice-title{
            font-size: 18px;
            font-weight: bold;
        }
        hr{
            margin-top: 20px;
            margin-bottom: 20px;
            border: 0;
            border-top: 1px solid #999;
        }
        table{
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            font-size: 14px;
        }
        .table, .table th, .table td{
            border: 1px solid black;
        }
        .table th, .table td{
            padding: 10px;
            text-align: left;
        }
        .footer{
            text-align: center;
            margin-top: 60px;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="left">
            <img src="{{ asset('img/logo.png') }}" alt="" width="50" height="50">
            {{-- <h2><strong>MEC Ngawi</strong></h2> --}}
        </div>
        <div class="right">
            <div class="invoice-title">Invoice Pembelian Program Bimbel</div>
        </div>
    </div>
    
    <hr style="margin-bottom: 25px;">

    <table>
        <tr>
            <td><strong>KEPADA:</strong><br>
                {{ $pendaftaran->siswa->nama_siswa }} <br>
                {{ $pendaftaran->siswa->notelp_siswa ?? '-' }}
            </td>
            <td class="right">
                {{ \Carbon\Carbon::parse($pendaftaran->created_at)->translatedFormat('l, d F Y') }} <br>
            </td>
        </tr>
    </table>

    <br><br><br>
    
    <div style="margin-bottom: 40px;">
        <strong>INVOICE: </strong>
        {{ $pendaftaran->id_order }}
    </div>


    <table class="table">
        <thead>
            <tr>
                <th>KETERANGAN</th>
                <th>HARGA</th>
                <th>JUMLAH</th>
                <th>TOTAL</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $pendaftaran->program->nama_program }}</td>
                <td>Rp {{ number_format($pendaftaran->program->biaya_program, 0, ',', '.') }}</td>
                <td>1</td>
                <td>Rp {{ number_format($pendaftaran->program->biaya_program, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        <p><strong>Terima kasih atas pembelian dan kepercayaan Anda kepada kami. </strong></p>
        <br><br>
    </div>

    <div class="right">
        <p>Hormat kami, </p>
        <br><br>
        <p><strong>Admin MEC Ngawi</strong></p>
    </div>
</body>
</html>