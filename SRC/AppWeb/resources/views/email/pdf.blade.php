<head>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

		<header>
			<h1>Invoice</h1>
			<address>
				<p> dmendiguric@ulasalle.edu.pe </p>
				<p> 04011, Arequipa, Av. Alfonso Ugarte 517 </p>
				<p> Business Number Phone: 012 44 5698 7456 896 </p>
			</address>
			<span><img alt="it" src="https://media.discordapp.net/attachments/880608338348482631/918651882094878730/header_logo.png?width=1086&height=380"></span>
            <style type="text/css">
            /* heading */

            h1 { font: bold 100% sans-serif; letter-spacing: 0.5em; text-align: center; text-transform: uppercase; }

            /* table */

            table { font-size: 75%; table-layout: fixed; width: 100%; }
            table { border-collapse: separate; border-spacing: 2px; }
            th, td { border-width: 1px; padding: 0.5em; position: relative; text-align: left; }
            th, td { border-radius: 0.25em; border-style: solid; }
            th { background: #EEE; border-color: #BBB; }
            td { border-color: #DDD; }

            body { box-sizing: border-box; height: 11in; margin: 0 auto; overflow: hidden; padding: 0.5in; width: 7.5in; }
            body { background: #FFF; border-radius: 1px; box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5); }

            /* header */

            header { margin: 0 0 3em; }
            header:after { clear: both; content: ""; display: table; }

            header h1 { background: #0d1075; border-radius: 0.25em; color: #FFF; margin: 0 0 1em; padding: 0.5em 0; }
            header address { float: left; font-size: 95%; font-style: normal; line-height: 1.25; margin: 0 1em 1em 0; }
            article address.norm h4 {
                font-size: 125%;
                font-weight: bold;
            }
            article address.norm { float: left; font-size: 95%; font-style: normal; font-weight: normal; line-height: 1.25; margin: 0 1em 1em 0; }
            header address p { margin: 0 0 0.25em; }
            header span { display: block; float: right; }
            header span { margin: 0 0 1em 1em; max-height: 25%; max-width: 60%; position: relative; }
            header img { max-height: 80%; max-width: 80%; left: 40px;}
            header input { cursor: pointer; -ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)"; height: 100%; left: 0; opacity: 0; position: absolute; top: 0; width: 100%; }

            /* article */

            article, article address, table.meta, table.inventory { margin: 0 0 3em; }
            article:after { clear: both; content: ""; display: table; }
            article h1 { clip: rect(0 0 0 0); position: absolute; }

            article address { float: left; font-size: 125%; font-weight: bold; }

            /* table meta & balance */

            table.meta, table.balance { float: right; width: 36%; }
            table.meta:after, table.balance:after { clear: both; content: ""; display: table; }

            /* table meta */

            table.meta th { width: 40%; }
            table.meta td { width: 60%; }

            /* table items */

            table.inventory { clear: both; width: 100%; }
            table.inventory th:first-child {
                width:50px;
            }
            table.inventory th:nth-child(2) {
                width:300px;
            }
            table.inventory th { font-weight: bold; text-align: center; }

            table.inventory td:nth-child(1) { width: 26%; }
            table.inventory td:nth-child(2) { width: 38%; }
            table.inventory td:nth-child(3) { text-align: right; width: 12%; }
            table.inventory td:nth-child(4) { text-align: right; width: 12%; }
            table.inventory td:nth-child(5) { text-align: right; width: 12%; }

            /* Discounts table */

            table.discount { clear: both; width: 100%; }
            table.discount th:first-child {
                width:50px;
            }
            table.discount th:nth-child(2) {
                width:300px;
            }
            table.discount th { font-weight: bold; text-align: center; }

            table.discount td:nth-child(1) { width: 26%; }
            table.discount td:nth-child(2) { width: 38%; }
            table.discount td:nth-child(3) { text-align: right; width: 23%; }

            /* table balance */

            table.balance th, table.balance td { width: 50%; }
            table.balance td { text-align: right; }

            /* aside */

            aside h1 { border: none; border-width: 0 0 1px; margin: 0 0 1em; }
            aside h1 { border-color: #999; border-bottom-style: solid; }

            table.sign {
                float: left;
                width: 220px;
            }
            table.sign img {
                width: 100%;
            }
            table.sign tr td {
                border-color: transparent;
            }
            @media print {
                * { -webkit-print-color-adjust: exact; }
                html { background: none; padding: 0; }
                body { box-shadow: none; margin: 0; }
                span:empty { display: none; }
                .add, .cut { display: none; }
            }

            @page { margin: 0; }
            </style>
		</header>
		<article>
			<h1>Recipient</h1>
			<address class="norm">
				<h4>{{$customer->name}}</h4>
				<p> {{$customer->email}} <br>
				<p> {{$customer->district->city->province->name . " " . $customer->address}} <br>
				<p> Phone number: {{$customer->phone_number}} </p>
			</address>
			
			<table class="meta">
				<tr>
					<th><span >Invoice #</span></th>
					<td><span >{{ $order->invoice }}</span></td>
				</tr>
				<tr>
					<th><span >Date</span></th>
                    @php
                    date_default_timezone_set('America/Lima');
                    @endphp
					<td><span >{{date("F j, Y",strtotime(date("F j, Y")."+ 1 days"))}}</span></td>
				</tr>
				<tr>
					<th><span >Amount Due</span></th>
					<td><span id="prefix" >$</span><span>{{$order->subtotal}}</span></td>
				</tr>
			</table>
			<table class="inventory">
				<thead>
					<tr>
						<th><span >S. No</span></th>
						<th><span >Description</span></th>
						<th><span >Qty</span></th>
						<th><span >Rate Per Qty</span></th>
						<th><span >Amount</span></th>
					</tr>
				</thead>
				<tbody>
                    @foreach ($carts as $cart)
					<tr>
						<td><span >{{$loop->iteration}} .</span></td>
						<td><span >{{$cart['product_name']}}</span></td>
						<td><span data-prefix>$</span><span >{{$cart['product_price']}}</span></td>
						<td><span >{{$cart['qty']}}</span></td>
						<td><span data-prefix>$</span><span>{{$cart['product_price']*$cart['qty']}}</span></td>
					</tr>
                    @endforeach
				</tbody>
			</table>

			<table class="balance">
				<tr>
					<th><span>Total</span></th>
					<td><span data-prefix>$</span><span>{{$order->subtotal}}</span></td>
				</tr>
			</table>
		</article>
		<aside>
			<h1><span>Additional Notes</span></h1>
			<div>
				<p>We offer limited 10 days refund policy and 30 days workmanship warranty on all of our services. For more details, please read our refund policy below.</p>
			</div>
		</aside>