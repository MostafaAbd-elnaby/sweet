
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thank you for using our kushkatna site</title>

    <link rel="icon" href="/images/favicon.png" type="image/x-icon">

    <style>
        body{
            font-family:'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            text-align:center;
            color:#777;
        }

        body h1{
            font-weight:300;
            margin-bottom:0px;
            padding-bottom:0px;
            color:#000;
        }

        body h3{
            font-weight:300;
            margin-top:10px;
            margin-bottom:20px;
            font-style:italic;
            color:#555;
        }

        body a{
            color:#06F;
        }

        .invoice-box{
            max-width:800px;
            margin:auto;
            padding:30px;
            border:1px solid #eee;
            box-shadow:0 0 10px rgba(0, 0, 0, .15);
            font-size:16px;
            line-height:24px;
            font-family:'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color:#555;
        }

        .invoice-box table{
            width:100%;
            line-height:inherit;
            text-align:left;
        }

        .invoice-box table td{
            padding:5px;
            vertical-align:top;
        }

        .invoice-box table tr td:nth-child(2){
            text-align:right;
        }

        .invoice-box table tr.top table td{
            padding-bottom:20px;
        }

        .invoice-box table tr.top table td.title{
            font-size:45px;
            line-height:45px;
            color:#f02323;
        }

        .invoice-box table tr.information table td{
            padding-bottom:40px;
        }

        .invoice-box table tr.heading td{
            background:#eee;
            border-bottom:1px solid #ddd;
            font-weight:bold;
        }

        .invoice-box table tr.details td{
            padding-bottom:20px;
        }

        .invoice-box table tr.item td{
            border-bottom:1px solid #eee;
        }

        .invoice-box table tr.item.last td{
            border-bottom:none;
        }

        .invoice-box table tr.total td:nth-child(2){
            border-top:2px solid #eee;
            font-weight:bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td{
                width:100%;
                display:block;
                text-align:center;
            }

            .invoice-box table tr.information table td{
                width:100%;
                display:block;
                text-align:center;
            }
        }
    </style>
</head>
<body>
<h1 style="margin-bottom: 30px">Thank you for using our kushkatna site.</h1>
<div class="invoice-box">
    <table cellpadding="0" cellspacing="0">
        <tr class="top">
            <td colspan="2">
                <table>
                    <tr>
                        <td>
                            رقم الفاتوره #: {{ $orders->order_no }}<br>
                            تاريخ: {{ $orders->created_at }}<br>
                        </td>
                        <td class="title">
                            Kushkatna
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr class="information">
            <td colspan="2">
                <table>
                    <tr>
                        <td>
                            رقم الهاتف:
                            {{ $orders->clients['phone'] }}
                        </td>
                        <td>
                            {{ $orders->clients['name'] }}<br>
                            {{ $orders->clients['email'] }}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr class="heading">
            <td>
                Item
            </td>
            <td>
                Quantity
            </td>
            <td>
                Price
            </td>
            <td>
                Total
            </td>
        </tr>
        @foreach($orders->product_info as $order)
            <tr class="item">
                <td>
                    {{ $order['name_en'] }}
                </td>
                <td>
                    {{ $order['quantity'] }}
                </td>
                <td>
                    {{ $order['price'] }}
                </td>
                <td>
                    {{ $order['price'] * $order['quantity']  }}
                </td>
            </tr>
        @endforeach
        <tr class="total">
            <td></td>
            <td></td>
            <td></td>
            <td>
                Total: {{ $orders->sub_total }}
            </td>
        </tr>
    </table>
</div>
<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script></body>
</html>
