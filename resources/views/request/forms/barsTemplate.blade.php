<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>

	<style>
		#prtemplate {
		  	font-family: sans-serif;
		  	border-collapse: collapse;
		  	width: 100%;
		  	/*font-size: 10pt;*/
		}

		#prtemplate td {
			border: 1px solid #000;
		  	padding: 8px;
		} 
		#prtemplate th {
		  	border: 1px solid #000;
		  	font-weight: normal;
		  	padding: 5px;
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
			font-size: 10pt;
			text-align: right;
			font-family: sans-serif;
		}
		.typerequest { 
			font-weight: ; 
		}
		.title-form {
			font-family: sans-serif;
			text-align: center;
			font-size: 12pt;
			font-weight: bold;
		}
		.square {
	        width: 15px; 
	        height: 15px; 
	        border: 1px solid #000;
	        background-color: #fff; 
	    }
	</style>
</head>
<body>

	<div align="center" style="margin-top: -10px">
		<img src="{{ asset('template/img/routeslip.png') }}">
	</div>
	<br>
	<div class="attach-label text-muted"><b>Attachment to the Request</b></div>
	<div></div>
	<div class="title-form">Request for Budget Allocation Receipt and Action Slip</div>

	<p style="margin-top:-13px"></p>
	<table id="prtemplate">
		<thead>
			<tr>
				<th width="60%" rowspan="2" style="font-size: 9pt;" class="typerequest"><u>Type of Request</u><br>
					<span style="font-size: 8pt;">(Please check appropriate box/es)</span><br><br>
					{{-- <div class="square"><label style="margin-left: 65px; font-size: 8pt;">PR/PO</label></div>
					<div class="square" style="margin-left: 75px; margin-top: -28px"><label style="margin-left: 55px; font-size: 8pt;">POW</label></div>
					<div class="square" style="margin-left: 140px; margin-top: -28px"><label style="margin-left: 95px; font-size: 8pt;">Letter&nbsp;Request</label></div>
					<div class="square" style="margin-left: 240px; margin-top: -28px"><label style="margin-left: 180px; font-size: 8pt;">Others&nsp;(Pls.&nbsp;specify&nbsp;below)</label></div> --}}
					<div style="margin-top: -4px; margin-left: 0px; text-align: left;">
					    <input type="checkbox" name="" class="">
					</div>
					<div style="margin-top: -20px; margin-left: 18px; text-align: left;">
					    PR /PO
					</div>
					<div style="margin-top: -189px !important; margin-left: 75px; text-align: ;">
					    <input type="checkbox" name="" class="" style="margin-top: -4px !important;">
					</div>
					<div style="margin-top: -60px; margin-left: 92px; text-align: ;">
					    POW
					</div>
					<div style="margin-top: -189px !important; margin-left: 135px; text-align: ;">
					    <input type="checkbox" name="" class="" style="margin-top: -4px !important;">
					</div>
					<div style="margin-top: -60px; margin-left: 152px; text-align: ;">
					    Letter Request
					</div>
					<div style="margin-top: -189px !important; margin-left: 250px; text-align: ;">
					    <input type="checkbox" name="" class="" style="margin-top: -4px !important;">
					</div>
					<div style="margin-top: -60px; margin-left: 268px; text-align: ;">
					    Others (Pls.specify below)
					</div>
				</th>
				<th colspan="2" style="text-align: left; font-size: 9pt;" class="">Budget Office<br>Receipt Control<br>Number & Date</th>
				<th width="25%" style="font-size: 9pt;">Auto</th>
			</tr>
			<tr>
				<th width="50" style="text-align: left; font-size: 9pt;">Amount of <br>Request</th>
				<th colspan="2" style="text-align: left; font-size: 9pt;">
					PR &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- P<br>
					POW &nbsp;&nbsp;&nbsp;&nbsp;- P<br>
					LR, etc. - P<br>
				</th>
			</tr>
		</thead>
	</table>
	<table id="prtemplate">
		<thead>
			<tr>
				<th style="text-align: left;font-size: 8pt; border-top: none;" width="11%">Purpose /<br>Project Title/<br>Subject</th>
				<th style="text-align: left;font-size: 8pt; border-top: none;" width="34%"></th>
				<th style="text-align: center;font-size: 8pt; border-top: none;" width="15%">Content of PR<br><span style="font-size: 6pt">(Pls. enumerate<br>at least first 3<br>items of PR)</span></th>
				<th style="text-align: left;font-size: 8pt; border-top: none;"></th>
			</tr>
		</thead>
	</table>
	<table id="prtemplate">
		<thead>
			<tr>
				<th style="text-align: left;font-size: 8pt; border-top: none;" width="11%">Requesting<br>Personnel</th>
				<th style="text-align: left;font-size: 8pt; border-top: none;" width="49%"></th>
				<th style="text-align: center;font-size: 8pt; border-top: none;" width="10%">Contact No.</th>
				<th style="text-align: left;font-size: 8pt; border-top: none;"></th>
			</tr>
		</thead>
	</table>
	<table id="prtemplate">
		<thead>
			<tr>
				<th style="text-align: left;font-size: 8pt; border-top: none;" width="11%" height="20">Campus</th>
				<th style="text-align: left;font-size: 8pt; border-top: none;" width="24%" height="20"></th>
				<th style="text-align: center;font-size: 8pt; border-top: none;" width="10%" height="20">Office</th>
				<th style="text-align: left;font-size: 8pt; border-top: none;"></th>
			</tr>
		</thead>
	</table>
	<table id="prtemplate">
		<thead>
			<tr>
				<th style="text-align: left;font-size: 8pt; border-top: none;" width="11%" height="20">Submitted by</th>
				<th style="text-align: left;font-size: 8pt; border-top: none;" width="24%" height="20"></th>
				<th style="text-align: center;font-size: 8pt; border-top: none;" width="10%" height="20">Date & Time</th>
				<th style="text-align: left;font-size: 8pt; border-top: none;" width="15%"></th>
				<th style="text-align: center;font-size: 8pt; border-top: none;" width="10%" height="20">Received by</th>
				<th style="text-align: left;font-size: 8pt; border-top: none;"></th>
			</tr>
		</thead>
	</table>
	<table id="prtemplate">
		<thead>
			<tr>
				<th style="text-align: left;font-size: 8pt; border-top: none;" width="11%" height="20">Released by</th>
				<th style="text-align: left;font-size: 8pt; border-top: none;" width="24%" height="20"></th>
				<th style="text-align: center;font-size: 8pt; border-top: none;" width="10%" height="20">Date & Time</th>
				<th style="text-align: left;font-size: 8pt; border-top: none;" width="15%"></th>
				<th style="text-align: center;font-size: 8pt; border-top: none;" width="10%" height="20">Received by</th>
				<th style="text-align: left;font-size: 8pt; border-top: none;"></th>
			</tr>
		</thead>
	</table>

	<div></div>
	<div class="title-form">Action Taken</div>
	<center><span>(For use by the Budget Office)</span></center>

	<table id="prtemplate">
		<thead>
			<tr>
				<th style="text-align: left;font-size: 8pt;" width="18%" height="20">
					<div style="margin-top: 5px;">
					    Recommend 
					</div>
					<div style="margin-top: -90px; margin-left: 100px;">
					    <input type="checkbox" name="" class="">
					</div>
				</th>
				<th style="text-align: center;font-size: 8pt;" width="11%" height="20">Comment(s) /<br>Suggestion(s)</th>
				<th style="text-align: left;font-size: 8pt;"></th>
			</tr>
			<tr>
				<th style="text-align: left;font-size: 8pt;" width="18%" height="20">
					<div style="margin-top: 5px;">
					    Not Recommend 
					</div>
					<div style="margin-top: -90px; margin-left: 100px;">
					    <input type="checkbox" name="" class="">
					</div>
				</th>
				<th style="text-align: center;font-size: 8pt;" width="11%" height="20">Reason(s)</th>
				<th style="text-align: left;font-size: 8pt;"></th>
			</tr>
			<tr>
				<th style="text-align: left;font-size: 8pt;" width="18%" height="20">
					<div style="margin-top: 5px;">
					    Return to Client 
					</div>
					<div style="margin-top: -90px; margin-left: 100px;">
					    <input type="checkbox" name="" class="">
					</div>
				</th>
				<th style="text-align: center;font-size: 8pt;" width="11%" height="20">With further /<br>Instuction(s)</th>
				<th style="text-align: left;font-size: 8pt;"></th>
			</tr>
		</thead>
	</table>
	<table id="prtemplate">
		<thead>
			<tr>
				<th colspan="4" style="border-top: none; text-align: left;">Recommended Funding Source(s):</th>
			</tr>
		</thead>
	</table>
	<table id="prtemplate">
		<thead>
			<tr>
				<th style="border-top: none; text-align: left; font-size: 8pt;" width="8%">Financing<br>Source</th>
				<th style="text-align: left;font-size: 8pt; border-top: none;" width="18%" height="20">
					<div style="margin-top: -5px; margin-left: 0px;">
					    <input type="checkbox" name="" class="">
					</div>
					<div style="margin-top: -18px; margin-left: 18px;">
					    General Fund (MDS Fund)
					</div>
					<div style="margin-top: -3px; margin-left: 0px;">
					    <input type="checkbox" name="" class="">
					</div>
					<div style="margin-top: -18px; margin-left: 18px;">
					    Off-Budget Fund
					</div>
					<div style="margin-top: -3px; margin-left: 0px;">
					    <input type="checkbox" name="" class="">
					</div>
					<div style="margin-top: -18px; margin-left: 18px;">
					    Custodial Fund
					</div>
				</th>
				<th style="border-top: none; text-align: left; font-size: 8pt;" width="8%">Fund<br>Cluster</th>
				<th style="text-align: left;font-size: 8pt; border-top: none;" width="18%" height="20">
					<div style="margin-top: -5px; margin-left: 0px;">
					    <input type="checkbox" name="" class="">
					</div>
					<div style="margin-top: -18px; margin-left: 18px;">
					    Regular Fund Agency
					</div>
					<div style="margin-top: -3px; margin-left: 0px;">
					    <input type="checkbox" name="" class="">
					</div>
					<div style="margin-top: -18px; margin-left: 18px;">
					    Internally-Generated Income
					</div>
					<div style="margin-top: -3px; margin-left: 0px;">
					    <input type="checkbox" name="" class="">
					</div>
					<div style="margin-top: -18px; margin-left: 18px;">
					    Business Type Income
					</div>
					<div style="margin-top: -3px; margin-left: 0px;">
					    <input type="checkbox" name="" class="">
					</div>
					<div style="margin-top: -18px; margin-left: 18px;">
					    Trust Fund
					</div>
				</th>
				<th style="border-top: none; text-align: left; font-size: 8pt;" width="8%">Fund<br>Category</th>
				<th style="text-align: left;font-size: 8pt; border-top: none;" width="18%" height="20">
					<div style="margin-top: -5px; margin-left: 0px;">
					    <input type="checkbox" name="" class="">
					</div>
					<div style="margin-top: -18px; margin-left: 18px;">
					    Specific Budget of NGAs
					</div>
					<div style="margin-top: -4px; margin-left: 0px;">
					    <input type="checkbox" name="" class="">
					</div>
					<div style="margin-top: -18px; margin-left: 18px;">
					    Special Purpose Fuunds
					</div>
					<div style="margin-top: -3px; margin-left: 0px;">
					    <input type="checkbox" name="" class="">
					</div>
					<div style="margin-top: -18px; margin-left: 18px;">
					    Retained Income / Funds
					</div>
					<div style="margin-top: -3px; margin-left: 0px;">
					    <input type="checkbox" name="" class="">
					</div>
					<div style="margin-top: -18px; margin-left: 18px;">
					    Revolving Funds
					</div>
					<div style="margin-top: -3px; margin-left: 0px;">
					    <input type="checkbox" name="" class="">
					</div>
					<div style="margin-top: -18px; margin-left: 18px;">
					    Trust Receipts
					</div>
				</th>
			</tr>
		</thead>
	</table>
	<table id="prtemplate">
		<thead>
			<tr>
				<th style="border-top: none; border-bottom: none; padding-top: 40px; font-size: 8pt;" width="15%"  height="20">Authorization</th>
				<th rowspan="2" style="text-align: left; font-size: 8pt; border-top: none;" width="45%" height="20">
					<div style="margin-top: -5px; margin-left: 0px;">
					    <input type="checkbox" name="" class="">
					</div>
					<div style="margin-top: -18px; margin-left: 18px;">
					    New gen. Appropriations (Current Year Budget)
					</div>
					<div style="margin-top: -3px; margin-left: 0px;">
					    <input type="checkbox" name="" class="">
					</div>
					<div style="margin-top: -18px; margin-left: 18px;">
					    Continuing Appropriations (Prior Year's Budget)
					</div>
					<div style="margin-top: -3px; margin-left: 0px;">
					    <input type="checkbox" name="" class="">
					</div>
					<div style="margin-top: -18px; margin-left: 18px;">
					    Special Purpose Fuunds
					</div>
					<div style="margin-top: -3px; margin-left: 0px;">
					    <input type="checkbox" name="" class="">
					</div>
					<div style="margin-top: -18px; margin-left: 18px;">
					    Retained Income / Funds 
					</div>
					<div style="margin-top: -3px; margin-left: 0px;">
					    <input type="checkbox" name="" class="" checked="">
					</div>
					<div style="margin-top: -18px; margin-left: 18px;">
					    Revolving Funds
					</div>
					<div style="margin-top: -3px; margin-left: 0px;">
					    <input type="checkbox" name="" class="" checked="">
					</div>
					<div style="margin-top: -18px; margin-left: 18px;">
					    Trust Receipts
					</div>
				</th>
				<th style="border-top: none; text-align: left; font-size: 8pt;" width="22%">Specific Fund /<br>Income Source &nbsp;</th>
				<th style="border-top: none; text-align: left; font-size: 8pt;" width=""></th>
			</tr>
			<tr>
				<th style="border-top: none; text-align: left; font-size: 8pt;" width="" height="20"></th>
				<th style="border-top: none; text-align: left; font-size: 8pt;" width="" height="20">Purpose / Project</th>
				<th style="border-top: none; text-align: left; font-size: 8pt;" width="41%" height="20"></th>
			</tr>
		</thead>
	</table>
	<table id="prtemplate">
		<thead>
			<tr>
				<th style="border-top: none; font-size: 8pt;" width="6%"  height="20">Campus</th>
				<th style="border-top: none; font-size: 8pt;" width="22%"  height="20"></th>
				<th style="border-top: none; font-size: 8pt;" width="13%"  height="20">Program / Activity /<br>Project</th>
				<th style="border-top: none; font-size: 8pt;" width="45%"  height="20"></th>
			</tr>
		</thead>
	</table>
	<table id="prtemplate">
		<thead>
			<tr>
				<th rowspan="2" style="border-top: none; border-bottom: none; font-size: 8pt; text-align: left;" width="20%"  height="20">
					Allotment / Budget Avable: P _____________________<br>
					maximum only.
				</th>
				<th rowspan="2" style="border-top: none; font-size: 8pt; text-align: left;" width="4%"  height="20">Budget Office<br>Assigned<br>Number</th>
				<th style="border-top: none; font-size: 8pt; text-align: left;" width="18%"  height="20">PR #</th>
			</tr>
			<tr>
				<th style="border-top: none; font-size: 8pt; text-align: left;" width="18%"  height="20">POW #</th>
			</tr>
			<tr>
				<th style="border-top: none; font-size: 10pt; text-align: center;" width="20%"  height="20">
					<u><b>VICENTE M. TRIO, JR.</b></u><br><span>Budget Officer</span>
				</th>
				<th style="border-top: none; font-size: 8pt; text-align: left;" width="4%"  height="20">Date</th>
				<th style="border-top: none; font-size: 8pt; text-align: left;" width="18%"  height="20"></th>
			</tr>
		</thead>
	</table>
</body>
</html>