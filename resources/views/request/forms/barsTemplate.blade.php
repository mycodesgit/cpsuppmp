<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>

	<style>
		#prtemplate {
		  	font-family: Arial;
		  	border-collapse: collapse;
		  	width: 100%;
		  	font-size: 10pt;
		}

		#prtemplate td {
			border: 1px solid #000;
		  	padding: 8px;
		} 
		#prtemplate th {
		  	border: 1px solid #000;
		  	font-weight: normal;
		  	/*padding: 8px;*/
		}

		.cell-normal-top-left {
			border-top: 2px solid #000 !important;
			border-left: 2px solid #000 !important;
		}
		.cell-normal-top-right {
			border-top: 2px solid #000 !important;
			border-right: 2px solid #000 !important;
		}
		.cell-normal-top {
			border-top: 2px solid #000 !important;
		}

		.cell-normal-side-left {
			border-top: 2px solid #000 !important;
			border-bottom: 2px solid #000 !important;
			border-left: 2px solid #000 !important;
		}
		.cell-normal-side-right {
			border-top: 2px solid #000 !important;
			border-bottom: 2px solid #000 !important;
			border-right: 2px solid #000 !important;
		}
		.cell-normal-side-inside {
			border-top: 2px solid #000 !important;
			border-bottom: 2px solid #000 !important;
		}

		.cell-bold-left {
			border-left: 2px solid #000 !important;
		}
		.cell-bold-right {
			border-right: 2px solid #000 !important;
		}
		.cell-bold-total-left {
			border-left: 2px solid #000 !important;
			border-bottom: 2px solid #000 !important;
			border-top: 2px solid #000 !important;
		}
		.cell-bold-total-right {
			border-right: 2px solid #000 !important;
			border-bottom: 2px solid #000 !important;
			border-top: 2px solid #000 !important;
		}
		.cell-bold-purpose {
			border-left: 2px solid #000 !important;
			border-right: 2px solid #000 !important;
			border-bottom: 2px solid #000 !important;
			border-top: 2px solid #000 !important;
			text-align: left !important;
			padding: 8px;
		}
		.cell-requested-empty {
			border-left: 2px solid #000 !important;
		}
		.cell-approved {
			border-right: 2px solid #000 !important;
		}
		.cell-requested-signature-label {
			border-left: 2px solid #000 !important;
			border-bottom: 2px solid #000 !important;
			padding: 8px !important;
		}
		.cell-requested-signature {
			border-bottom: 2px solid #000 !important;
			padding: 8px !important;
		}
		.cell-approved-signature {
			border-right: 2px solid #000 !important;
			border-bottom: 2px solid #000 !important;
			padding: 8px !important;
		}
		.cell-requested-name-label {
			border-left: 2px solid #000 !important;
			border-bottom: 2px solid #000 !important;
			font-size: 8pt;
		}
		.cell-requested-name {
			border-bottom: 2px solid #000 !important;
		}
		.cell-approved-name {
			border-right: 2px solid #000 !important;
			border-bottom: 2px solid #000 !important;
		}
		.cell-requested-designation-label {
			border-left: 2px solid #000 !important;
			border-bottom: 2px solid #000 !important;
			font-size: 8pt;
		}
		.cell-requested-designation {
			border-bottom: 2px solid #000 !important;
		}
		.cell-approved-designation {
			border-right: 2px solid #000 !important;
			border-bottom: 2px solid #000 !important;
		}
		.text-item {
			text-align: left !important;
		}


		.attach-label {
			text-align: right;
		}
		.title-form {
			text-align: center;
			font-size: 12pt;
			font-weight: bold;
		}
	</style>
</head>
<body>

	<div align="center" style="margin-top: -10px">
		<img src="{{ asset('template/img/routeslip.png') }}">
	</div>
	<br>
	<div class="attach-label"><b>Attachment to the Request</b></div>
	<div></div>
	<div class="title-form">Request for Budget Allocation Receipt and Action Slip</div>

	<p style="margin-top:-13px"></p>
	<table id="prtemplate">
		<thead>
			<tr>
				<th style="text-align: center; font-weight: initial;" width="25" class="cell-normal-top-left">Office/<br>Section</th>
				<th colspan="2" class="cell-normal-top">MIS Office</th>
				<th colspan="2" style="text-align: left; font-weight: initial;" class="cell-normal-top">PR  No.:<br>Code:</th>
				<th style="text-align: left; font-weight: initial;" width="100" class="cell-normal-top-right">Date:</th>
			</tr>
			<tr>
				<th class="cell-normal-side-left">Type of Request</th>
				<th class="cell-normal-side-inside">UNIT</th>
				<th class="cell-normal-side-inside">ITEM DESCRIPTION</th>
				<th class="cell-normal-side-inside">QTY.</th>
				<th class="cell-normal-side-inside">UNIT COST</th>
				<th class="cell-normal-side-right">TOTAL COST</th>
			</tr>
		</thead>
	</table>
</body>
</html>