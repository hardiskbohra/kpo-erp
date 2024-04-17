<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
        }
        .invoice-container {
            max-width: 800px;
            margin: 20px 20px;
            padding: 10px;
            /* border: 1px solid #ddd; */
            /* box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); */
            background-color: #fff;

            /* transform: scale(0.7); */
            /* transform-origin: top left; */
            /* transform: scale(0.95);*/
        }
        .shop-details {
            float: left;
            width: 40%;
        }
        .shop-logo {
            height: 130px;
            width: 130px;
            /* max-width: 150px; */
            margin-bottom: 5px;
        }
        .invoice-details {
            float: right;
            /* width: 45%;      */
            text-align: right;
            line-height: 0.8;
        }
        hr {
            border: 0;
            border-top: 1px solid #ddd;
            margin: 15px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        .item-list thead {
            background-color: #f1f1f1;
        }
        .item-list tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .item-list td {
            padding: 8px;
        }
        .total-section {
            margin-top: 20px;
        }
    </style>
</head>
<body style="font-size: 12px; line-height: 9px">

<div class="invoice-container">
    <div class="shop-details" >
        <img src="/app-assets/images/mascot/logo-without-background.png" alt="Shop Logo"  class="shop-logo">
    </div>
    <div class="invoice-details">
        <h2>Raymond Mascot</h2>
        <h4>Suiting | Shirting | Show Room</h4>
        <p>177, Nirnay Nagar Sector-4,</p>
        <p>Opp. Vimalnath Bus Stand, Nirnay Nagar, Ahmedabad</p>
        <p>+91 86906 97978, +91 95580 71708</p>
    </div>
    <div style="clear:both;"></div> <!-- Clear the float -->
    <hr>
    {{-- <h2 style="text-align: center">Inovice</h2> --}}
    <div class="shop-details" style="width: 60%">
        <p><b>Bill No:</b> {{$invoice->invoice_number}}</p>
        <p><b>Date: </b>{{$invoice->date}}&nbsp;&nbsp;&nbsp;<b>Delivery Date:</b> {{$invoice->delivery_date}}</p>
    </div>
    <div class="invoice-details" style="margin-bottom: 5px">
        <p><b>Customer Name: </b>{{Str::title($invoice->customer->name)}}</p>
        <p><b>Phone Number:</b> +91 {{$invoice->customer->phone_number}}</p>
    </div>
    {{-- <hr> --}}
    <div class="item-list">
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Particulars</th>
                    <th>Rate</th>
                    <th>Qty/Mtr</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $count = 1;
                @endphp
                @foreach ($invoice->incoiceItems as $item)
                <tr>
                    <td>{{$count}}</td>
                    <td>{{Str::title($item->type)}}</td>
                    <td>{{$item->cost}}</td>
                    <td>{{$item->quantity}}</td>
                    <td>₹ {{$item->price}}</td>
                </tr>
                @php
                    $count++;
                @endphp
                @endforeach
                @if ($count < 10)
                    @for ($i = $count; $i <= 10; $i++)
                    <tr>
                        <td>&nbsp;</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    @endfor
                @endif
                <tr>
                    <td colspan="2" class="">
                    </td>
                    <td colspan="2" class="text-end px-4 ">
                        <p class="mb-2"><strong>Subtotal:</strong></p>
                        <p class="mb-2">Discount:</p>
                        <p class="mb-2">Tax:</p>
                        <p class="mb-2"><strong>Total:</strong></p>
                        <p class="mb-2">Paid Amount:</p>
                        <p class="mb-2">Remaining Amount:</p>
                    </td>
                    <td class="px-4 ">
                        <p class="fw-semibold mb-2"><strong>₹ {{$invoice->sub_total}}</strong></p>
                        <p class="fw-semibold mb-2">₹ {{$invoice->total_discount}}</p>
                        <p class="fw-semibold mb-2">₹ 00.00</p>
                        <p class="fw-semibold mb-0"><strong>₹ {{$invoice->total}}</strong></p>
                        <p class="fw-semibold mb-0">₹ {{$invoice->paid_ammount}}</p>
                        <p class="fw-semibold mb-0">₹ {{$invoice->remaining_ammount}}</p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
        {{-- <hr> --}}
        {{-- <div class="total-section">
        </div> --}}
    <h4 style="margin-bottom:-5px;">Terms & Conditions:</h4>
    <h6 style="color: rgb(157, 156, 156);font-weight:400;text-align:justify;font-size:10px;line-height:2.5ch">
        Laundered goods are not eligible for exchange. Additionally, for the exchange of goods, it is imperative to present the original bill within the designated exchange hours, which are from 01:00 PM to 05:00 PM. Please note that once goods are sold, they cannot be returned, and there is no guarantee provided for Cotton items. The jurisdiction for any matters related to this transaction falls under Ahmedabad. (Errors and Omissions Excepted).
    </h6>
</div>

 <script>
        // Automatically trigger print when the page loads
        window.onload = function () {
            window.print();
        };
    </script>
</body>


</html>
