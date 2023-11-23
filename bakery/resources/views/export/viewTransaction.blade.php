<!DOCTYPE html>
<html>
<head>
	<title>Export Laporan Transaksi Penjualan</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>
 

		<center>
			<h4>Laporan Transaksi Penjualan</h4>
		</center>
		
		
		<table class='table table-bordered'>
			<thead>
				<tr>
					<th>No</th>
					<th>Invoice Number</th>
					<th>ID Kasir</th>
					<th>Nama Kasir</th>
                    <th>Total Harga</th>
                    <th>Tanggal</th>
				</tr>
			</thead>
			<tbody>
				@php $i=1 @endphp
				@foreach($transactions as $t)
				<tr>
					<td>{{ $i++ }}</td>
					<td>{{$t->invoice_number}}</td>
					@if(isset($t->user->id))
					<td>{{$t->user_id}}</td>
					<td>{{$t->user->name}}</td>
					@else
					<td>-</td>
					<td>-</td>
					@endif
					<td>@currency($t->total)</td>
					<td>{{$t->created_at}}</td>
				</tr>
				@endforeach
			</tbody>
		</table>

 
</body>
</html>