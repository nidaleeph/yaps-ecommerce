
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>&nbsp;</title>
    
</head>

<body onload="window.print()">
    <div class="report-header">
    <h5 class="text-bold text-uppercase heading-2" style="vertical-align:middle;text-align:center">Metro North Day by Day Jesus Ministries Inc.</h5>
        <h1 class="text-bold text-uppercase heading-1"  style="vertical-align:middle;text-align:center"> Young Professional Ministries<br>Fund Raising Event</h1>
            <!-- <h2>Philippine Ports Authority</h2> -->
    </div>
    <!-- <div class="report-info">
        <div>
            <label for="">Run Date: Nov, 4 2021 16:10:29</label>
            <br>
            <label for="">Run By: Mariano</label>
        </div>
    </div> -->
    <table class="table-heading-2">
        <tr>
            <td>Entity Name: Order Invoice </td>
        </tr>
    </table>
    
    <table class="table-heading-2">
        <tr>
            <td colspan='2'>Full name: {{$order->user->name}}</td>
            <!-- <td class="bl-1 w-30"></td> -->
            <td class="bl-2 w-30">Order Status: {{$order->status}}</td>
        </tr>
        <tr>
            <td colspan='2'>Payment Method: Over the Counter</td>
            <!-- <td class="bl-1 w-30"></td> -->
            <td class="bl-2">Order No: {{$order->id}}</td>
        </tr>
        <tr>
            <td>Desigination: MNDBD Church </td>
            <td class="bl-1 w-30"></td>
            <td class="bl-2">Order Date: {{ \Carbon\Carbon::parse($order->updated_at)->format('F d, Y') }}</td>
        </tr>
    
    </table>
    <table class="table-details">
        <tr>
            <th class="th-2" >Product Code</th>
            <th class="th-2" >Product Name</th>
            <th class="th-2" >Description</th>
            <th class="th-2" >Qty</th>
            <th class="th-2">Price</th>

        </tr>
        @if (count($order->items))
			@foreach ($order->items as $item)
        <tr>
            <td class="td-2" style="vertical-align:middle;text-align:center">{{$item->product->product_code}}</td>
            <td class="td-2" style="vertical-align:middle;text-align:center">{{$item->product->title}}</td>
            <td class="td-2" style="vertical-align:middle;text-align:center">{{ html_entity_decode(strip_tags($item->product->description)) }}</td>
            <td class="td-2" style="vertical-align:middle;text-align:center">{{$item->quantity}}</td>
            <td class="td-2" style="vertical-align:middle;text-align:right">{{$item->product->price}}</td>

        </tr>
            @endforeach
            <?php
                if(count($order->items)<15){
                    for($itemCount = 15 - count($order->items);$itemCount>0;$itemCount--){
                        echo 
                        '<tr>
                            <td class="td-2">&nbsp;</td>
                            <td class="td-2">&nbsp;</td>
                            <td class="td-2">&nbsp;</td>
                            <td class="td-2">&nbsp;</td>
                            <td class="td-2">&nbsp;</td>
                        </tr>';
                    }
                }
            ?>
        @else   
            @for($itemCount = 0;$itemCount < 15;$itemCount++)
                <tr>
                    <td class="td-2">&nbsp;</td>
                    <td class="td-2">&nbsp;</td>
                    <td class="td-2">&nbsp;</td>
                    <td class="td-2">&nbsp;</td>
                    <td class="td-2">&nbsp;</td>
                </tr>
            @endfor
        @endif
    </table>
    <table class="table-footer">
        <tr>
            <td height="100" ><h3>Total Price: ₱{{ number_format($order->total_price, 2) }}</h3 ></td>
        </tr>

    </table>
    <table class="table-footer">
        <tr>
            <td class="text-center">I hereby certify that the item/s and circumstances stated above are true and correct</td>

        </tr>
        <tr>
            <td>&nbsp;</td>

        </tr>
        <tr>
            <td  class="text-center">{{$user->name}} </td>

        </tr>
        <tr>
            <td class="text-center"><span id="span2">Signature over Printed Name of the Accountable Officer</span> </td>
        </tr>
        <tr>
            <td class="text-center">{{ \Carbon\Carbon::now()->format('F d, Y') }}</td>
        </tr>
        <tr>
        <td class="text-center"><span id="span2">&emsp;&emsp;&emsp;Date&emsp;&emsp;&emsp;</span> </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
    </table>
    
</body>

</html>



<style scoped>
.table-heading-2,.table-footer{
            border: 1px solid black;
        }
    
        .table-heading-2 td {
            border: 0 solid white;
        }

        table .w-21 {
            width: 21.25%;
        }

        .table-details,.th-2,.td-2 {
            border: 1px solid black;
        }


        #span2 {
            display: inline-block;
            border-top: 1px solid black;
        }

        #span3 {
            display: inline-block;
            border-bottom: 1px solid black;
        }

        .heading-2 {
            font-size: 1.2rem;
        }

        *,
*::after,
*::before {
	margin: 0;
	padding: 0;
	box-sizing: inherit;
}

html {
	font-size: 62.5%;
}

body {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 1.4rem;
	box-sizing: border-box;
}

table td {
	padding: 4px 8px;
}

table {
	width: 100%;
	border-collapse: collapse;
}
table .w-2 {
	width: 2%;
}
table .w-4 {
	width: 4%;
}
table .w-5 {
	width: 5%;
}

table .w-8 {
	width: 8%;
}
table .w-10 {
	width: 10%;
}

table .w-12 {
	width: 12%;
}

table .w-15 {
	width: 15%;
}

table .w-20 {
	width: 20%;
}

table .w-25 {
	width: 25%;
}

table .w-30 {
	width: 30%;
}

table .w-33 {
	width: 33.3%;
}

table .w-40 {
	width: 40%;
}

table .w-50 {
	width: 50%;
}

table .w-60 {
	width: 60%;
}

table .w-70 {
	width: 70%;
}

table .w-80 {
	width: 80%;
}

table .w-90 {
	width: 90%;
}

table .w-100 {
	width: 100%;
}

.text-bold {
	font-weight: bold;
}
.text-uppercase {
	text-transform: uppercase;
}

.heading-1 {
	font-size: 1.6rem;
}

.text-center {
	text-align: center;
}

.qr {
	position: absolute;
	top: 0;
	right: 0;
	height: 6rem;
	width: 6rem;
}

.qr img {
	width: 100%;
}

.report-header {
	padding-bottom: 2.2rem;
}

table .bl-2 {
    border-left: 1px solid black;
}

  </style>
