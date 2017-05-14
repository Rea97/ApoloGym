<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Factura #{{ $invoice->id }}</title>
    <link rel="stylesheet" href="{{ mix('/css/pdf/invoice.css') }}" media="all" />
    <style>
        html {
            margin-left: 10px;
        }
        .clearfix:after {
            content: "";
            display: table;
            clear: both;
        }

        a {
            color: #5D6975;
            text-decoration: underline;
        }

        body {
            position: relative;
            width: 21cm;
            height: 29.7cm;
            margin: 0 auto;
            color: #001028;
            background: #FFFFFF;
            font-family: Arial, sans-serif;
            font-size: 12px;
            font-family: Arial;
        }

        header {
            padding: 10px 0;
            margin-bottom: 30px;
        }

        #logo {
            text-align: center;
            margin-bottom: 10px;
        }

        #logo img {
            width: 90px;
        }

        h1 {
            border-top: 1px solid  #5D6975;
            border-bottom: 1px solid  #5D6975;
            color: #5D6975;
            font-size: 2.4em;
            line-height: 1.4em;
            font-weight: normal;
            text-align: center;
            margin: 0 0 20px 0;
            background: url(/imgs/pdf/invoice/dimension.png);
        }

        #project {
            float: left;
        }

        #project span {
            color: #5D6975;
            text-align: right;
            width: 52px;
            margin-right: 10px;
            display: inline-block;
            font-size: 0.8em;
            margin-left: 12px;
        }

        #company {
            float: right;
            text-align: right;
        }

        #project div,
        #company div {
            white-space: nowrap;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px;
        }

        table tr:nth-child(2n-1) td {
            background: #F5F5F5;
        }

        table th,
        table td {
            text-align: center;
        }

        table th {
            padding: 5px 20px;
            color: #5D6975;
            border-bottom: 1px solid #C1CED9;
            white-space: nowrap;
            font-weight: normal;
        }

        table .service,
        table .desc {
            text-align: left;
        }

        table td {
            padding: 20px;
            text-align: right;
        }

        table td.service,
        table td.desc {
            vertical-align: top;
        }

        table td.unit,
        table td.qty,
        table td.total {
            font-size: 1.2em;
        }

        table td.grand {
            border-top: 1px solid #5D6975;;
        }

        #notices .notice {
            color: #5D6975;
            font-size: 1.2em;
        }

        footer {
            color: #5D6975;
            width: 100%;
            height: 30px;
            position: absolute;
            bottom: 0;
            border-top: 1px solid #C1CED9;
            padding: 8px 0;
            text-align: center;
        }
    </style>
</head>
<body>
<header class="clearfix">
    <div id="logo">
        <img src="{{ asset('/imgs/logo.png') }}">
    </div>
    <h1>{{ config('app.name') }}</h1>
    <!--<div id="company" class="clearfix">-->
    <div style="margin-right: 10px; float: right;">
        <div>ApoloGym</div>
        <div>Av. Pablo Livas #1251,<br /> 67190, MX</div>
        <div>044-811-345-01-14</div>
        <div><a href="mailto:{{ config('app.email') }}">{{ config('app.email') }}</a></div>
    </div>
    <div id="project">
        <!--<div><span>PROJECT</span> Website development</div>-->
        <div><span>CLIENTE</span> {{ $client->name }} {{ $client->first_surname }} {{ $client->second_surname ?? '' }}</div>
        @if(! is_null($client->rfc))
            <div><span>RFC</span> {{ $client->rfc }}</div>
        @endif
        <div><span>DIRECCIÓN</span> {{ $client->address }}</div>
        <div><span>EMAIL</span> <a href="mailto:{{ $client->email }}">{{ $client->email }}</a></div>
        <div><span>FECHA</span> {{ $invoice->created_at }}</div>
        <div><span>VENCIMIENTO</span> {{ $invoice->due_date }}</div>
        <br>
        <div><span>ESTADO</span> <strong>{{ ucfirst($invoice->status) }}</strong></div>
    </div>
</header>
<main>
    <table>
        <thead>
        <tr>
            <th class="service">SERVICIO</th>
            <th class="desc">DESCRIPCIÓN</th>
            <th>PRECIO</th>
            <!--<th>QTY</th>-->
            <!--<th>TOTAL</th>-->
        </tr>
        </thead>
        <tbody>
        @foreach($services as $service)
            <tr>
                <td class="service">{{ $service->name }}</td>
                <td class="desc">{{ $service->description }}</td>
                <td class="unit">$ {{ $service->price }}</td>
                <!--<td class="qty">26</td>-->
                <!--<td class="total">$1,040.00</td>-->
            </tr>
        @endforeach


        <tr>
            <td colspan="2">SUBTOTAL</td>
            <td class="total">$ {{ $price['subtotal'] }}</td>
        </tr>
        <tr>
            <td colspan="2">IVA 16%</td>
            <td class="total">$ {{ $price['iva'] }}</td>
        </tr>


        <tr>
            <td colspan="2" class="grand total">TOTAL</td>
            <td class="grand total">$ {{ $invoice->total }}</td>
        </tr>

        </tbody>
    </table>
    <div id="notices">
        <div>TÉRMINOS:</div>
        <div class="notice">{{ $invoice->terms ?? 'No hay términos para esta factura.' }}</div>
    </div>
</main>
<footer>
    {{ config('app.name') }} {{ date('Y') }}
    <!--Invoice was created on a computer and is valid without the signature and seal.-->
</footer>
</body>
</html>