<!-- Karyawan-->
<script type="text/javascript">
	$(document).ready(function() {
		$("#Addnewkaryawan").click(function(e) {
			e.preventDefault();

			if ($("#tipe").val() === '') {
				alert("Silahkan pilih Tipe Karyawan");
				return false;
			}
			if ($("#nik").val() === '') {
				alert("Silahkan Masukkan NIK Karyawan");
				return false;
			}
			if ($("#namakaryawan").val() === '') {
				alert("Silahkan Masukkan Nama Karyawan");
				return false;
			}

			var nik = document.getElementById('nik').value;
			var nama = document.getElementById('namakaryawan').value;
			var uker = document.getElementById('unitkerja').value;
			var tipe = document.querySelector('input[name=tipe]:checked').value;



			var myData = 'nik=' + nik + '&nama=' + nama + '&uker=' + uker + '&tipe=' + tipe; //build a post data structure 
			jQuery.ajax({
				type: "POST", // Post / Get method
				url: "save-proses.php", //Where form data is sent on submission
				dataType: "text", // Data type, HTML, json etc.
				data: myData, //Form variables
				success: function(response) {
					$("#karyawan").append(response);
				},
				error: function(xhr, ajaxOptions, thrownError) {
					alert(thrownError);
				}
			});
		});
	});
</script>


<!-- Status Labels-->
<script type="text/javascript">
	$(document).ready(function() {
		$("#Addnewstatus").click(function(e) {
			e.preventDefault();
			var nama = document.getElementById('namastatus').value;
			var type = document.getElementById('tipestatus').value;
			if ($("#namastatus").val() === '') {
				alert("Please enter some text!");
				return false;
			}
			var myData = 'isi_status=' + nama;
			myData += '&isi_type=' + type; //build a post data structure 
			jQuery.ajax({
				type: "POST", // Post / Get method
				url: "save-proses.php", //Where form data is sent on submission
				dataType: "text", // Data type, HTML, json etc.
				data: myData, //Form variables
				success: function(response) {
					$("#status").append(response);
				},
				error: function(xhr, ajaxOptions, thrownError) {
					alert(thrownError);
				}
			});
		});
	});
</script>

<!-- SUPPLIER-->
<script type="text/javascript">
	$(document).ready(function() {
		$("#Addnewsupplier").click(function(e) {
			e.preventDefault();
			if ($("#namasupplier").val() === '') {
				alert("Please enter some text!");
				return false;
			}
			var myData = 'content_sup=' + $("#namasupplier").val(); //build a post data structure
			jQuery.ajax({
				type: "POST", // Post / Get method
				url: "save-proses.php", //Where form data is sent on submission
				dataType: "text", // Data type, HTML, json etc.
				data: myData, //Form variables
				success: function(response) {
					$("#pemasok").append(response);
				},
				error: function(xhr, ajaxOptions, thrownError) {
					alert(thrownError);
				}
			});
		});
	});
</script>

<!-- MODEL ASET-->
<script type="text/javascript">
	$(document).ready(function() {
		$("#addModel").click(function(e) {
			e.preventDefault();
			if ($("#namamodelok").val() === '') {
				alert("Please enter some text!");
				return false;
			}
			var myData = 'konten_model=' + $("#namamodelok").val(); //build a post data structure
			jQuery.ajax({
				type: "POST", // Post / Get method
				url: "save-proses.php", //Where form data is sent on submission
				dataType: "text", // Data type, HTML, json etc.
				data: myData, //Form variables
				success: function(response) {
					$("#model").append(response);
				},
				error: function(xhr, ajaxOptions, thrownError) {
					alert(thrownError);
				}
			});
		});
	});
</script>

<!-- KELUHAN-->
<script type="text/javascript">
	$(document).ready(function() {
		$("#addKeluhan").click(function(e) {
			e.preventDefault();
			if ($("#keluhanBaru").val() === '') {
				alert("Please enter some text!");
				return false;
			}
			var myData = 'konten_keluhan=' + $("#keluhanBaru").val(); //build a post data structure
			jQuery.ajax({
				type: "POST", // Post / Get method
				url: "save-proses.php", //Where form data is sent on submission
				dataType: "text", // Data type, HTML, json etc.
				data: myData, //Form variables
				success: function(response) {
					$("#keluhan").append(response);
				},
				error: function(xhr, ajaxOptions, thrownError) {
					alert(thrownError);
				}
			});
		});
	});
</script>

<!-- KATEGORI consumable-->
<script type="text/javascript">
	$(document).ready(function() {
		$("#newKatConsum").click(function(e) {
			e.preventDefault();
			if ($("#namakat_consum").val() === '') {
				alert("Please enter some text!");
				return false;
			}
			var myData = 'kat_consum=' + $("#namakat_consum").val(); //build a post data structure
			jQuery.ajax({
				type: "POST", // Post / Get method
				url: "save-proses.php", //Where form data is sent on submission
				dataType: "text", // Data type, HTML, json etc.
				data: myData, //Form variables
				success: function(response) {
					$("#kategori").append(response);
				},
				error: function(xhr, ajaxOptions, thrownError) {
					alert(thrownError);
				}
			});
		});
	});
</script>

<!-- KATEGORI komponen-->
<script type="text/javascript">
	$(document).ready(function() {
		$("#newKatKomp").click(function(e) {
			e.preventDefault();
			if ($("#namakat_komp").val() === '') {
				alert("Please enter some text!");
				return false;
			}
			var myData = 'kat_komp=' + $("#namakat_komp").val(); //build a post data structure
			jQuery.ajax({
				type: "POST", // Post / Get method
				url: "save-proses.php", //Where form data is sent on submission
				dataType: "text", // Data type, HTML, json etc.
				data: myData, //Form variables
				success: function(response) {
					$("#kategori").append(response);
				},
				error: function(xhr, ajaxOptions, thrownError) {
					alert(thrownError);
				}
			});
		});
	});
</script>


<!-- KATEGORI-->
<script type="text/javascript">
	$(document).ready(function() {
		$("#Addnewkategori").click(function(e) {
			e.preventDefault();
			if ($("#namakategori").val() === '') {
				alert("Please enter some text!");
				return false;
			}
			var myData = 'content_kat=' + $("#namakategori").val(); //build a post data structure
			jQuery.ajax({
				type: "POST", // Post / Get method
				url: "save-proses.php", //Where form data is sent on submission
				dataType: "text", // Data type, HTML, json etc.
				data: myData, //Form variables
				success: function(response) {
					$("#category").append(response);
				},
				error: function(xhr, ajaxOptions, thrownError) {
					alert(thrownError);
				}
			});
		});
	});
</script>

<!-- manufaktur-->
<script type="text/javascript">
	$(document).ready(function() {
		$("#Addnewmanufaktur").click(function(e) {
			e.preventDefault();
			if ($("#namamanufaktur").val() === '') {
				alert("Please enter some text!");
				return false;
			}
			var myData = 'content_manufaktur=' + $("#namamanufaktur").val(); //build a post data structure
			jQuery.ajax({
				type: "POST", // Post / Get method
				url: "save-proses.php", //Where form data is sent on submission
				dataType: "text", // Data type, HTML, json etc.
				data: myData, //Form variables
				success: function(response) {
					$("#manufaktur").append(response);
				},
				error: function(xhr, ajaxOptions, thrownError) {
					alert(thrownError);
				}
			});
		});
	});
</script>

<!-- Status Labels-->
<script type="text/javascript">
	$(document).ready(function() {
		$("#Addnewlabel").click(function(e) {
			e.preventDefault();
			var nama = document.getElementById('namalabel').value;
			var type = document.getElementById('type').value;
			if ($("#namalabel").val() === '') {
				alert("Please enter some text!");
				return false;
			}
			var myData = 'content_status=' + nama;
			myData += '&content_type=' + type; //build a post data structure 
			jQuery.ajax({
				type: "POST", // Post / Get method
				url: "save-proses.php", //Where form data is sent on submission
				dataType: "text", // Data type, HTML, json etc.
				data: myData, //Form variables
				success: function(response) {
					$("#status").append(response);
				},
				error: function(xhr, ajaxOptions, thrownError) {
					alert(thrownError);
				}
			});
		});

		$("#importREG").on('change', function(e) {
			e.preventDefault();
			var myData = new FormData(document.getElementById("importForm"));
			myData.append('importREG', 'excel');
			jQuery.ajax({
				type: "POST",
				url: "save-proses.php",
				data: myData,
				processData: false,
				contentType: false,
				enctype: 'multipart/form-data',
				success: function(data) {
					console.log(data);
					alert(data)
				}
			});
		})

	});
</script>

<!--Aset Monitor-->
<script type="text/javascript">
	$(document).ready(function() {
		$("#addMonitor").click(function(e) {
			e.preventDefault();
			var aset = document.getElementById('aset').value;
			var model = document.getElementById('namamodel').value;
			var sn = document.getElementById('sntag').value;
			var sewa = document.getElementById('sewa').value;
			var tahun = document.getElementById('tahun1').value;

			if (aset === '') {
				alert("Masukkan Nomor aset!");
				return false;
			}
			if (model === '') {
				alert("Masukkan Model Aset!");
				return false;
			}

			if (sn === '') {
				alert("Masukkan S/n Aset!");
				return false;
			}
			if (tahun === '') {
				alert("Masukkan tahun Aset!");
				return false;
			}

			var myData = 'konten_aset=' + aset;
			myData += '&konten_model=' + model;
			myData += '&konten_sewa=' + sewa;
			myData += '&konten_sn=' + sn;
			myData += '&konten_tahun=' + tahun; //build a post data structure 
			jQuery.ajax({
				type: "POST", // Post / Get method
				url: "save-proses.php", //Where form data is sent on submission
				dataType: "text", // Data type, HTML, json etc.
				data: myData, //Form variables
				success: function(response) {
					$("#id_monitor").append(response);
				},
				error: function(xhr, ajaxOptions, thrownError) {
					alert(thrownError);
				}
			});
		});
	});
</script>

<script>
	function TampilNotes(str) {
		if (str == "") {
			document.getElementById("tampilnote").innerHTML = "";
			return;
		} else {
			if (window.XMLHttpRequest) {
				// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp = new XMLHttpRequest();
			} else {
				// code for IE6, IE5
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					document.getElementById("tampilnote").innerHTML = this.responseText;

				}
			};
			xmlhttp.open("GET", "save-proses.php?q=" + str, true);
			xmlhttp.send();
		}
	}
</script>

<script>
	function showEdit(editableObj) {
		$(editableObj).css("background", "#FFF");
	}

	function saveToDatabase(editableObj, column, id) {
		$(editableObj).css("background", "#FFF url(images/loaderIcon.gif) no-repeat right");
		$.ajax({
			url: "save-proses.php",
			type: "POST",
			data: 'column=' + column + '&editval=' + editableObj.innerHTML + '&id=' + id,
			success: function(data) {
				$(editableObj).css("background", "#FDFDFD");
			}
		});
	}
</script>
<script>
	$("#kategori").change(function() {
		if ($(this).val() == "cp") {
			$("#divos").show();
			$("#divmonitor").show();
		} else if ($(this).val() == "nb") {
			$("#divmonitor").hide();
			$("#divos").show();
		} else {
			$("#divmonitor").hide();
			$("#divos").hide();

		}
	});
</script>


<script type="text/javascript">
	<?php echo $jsArrayaset; ?>

	function changeValue(no_aset) {
		document.getElementById('snaset').value = dataaset[no_aset].sn;

	};
</script>

<script type="text/javascript">
	<?php echo $jsArray; ?>

	function changeValue(status) {
		document.getElementById('jrsn').value = dtstatus[status].deployable;
		if (dtstatus[status].deployable == "1") {
			$("#divstatus").show();
		} else {

			$("#divstatus").hide();
		}
	};
</script>

<script>
	function ShowIfCheckedMonitor() {
		var checkBox = document.getElementById("penggantianmonitor");
		if (checkBox.checked == true) {
			$("#divCheckedMonitor").show();
		} else {
			$("#divCheckedMonitor").hide();
		}
	}
</script>
<script>
	function ShowIfCheckedMonitoraktif() {
		var checkBox = document.getElementById("chekoutmonitor");
		if (checkBox.checked == true) {
			$("#divCheckedMonitoraktif").show();
		} else {
			$("#divCheckedMonitoraktif").hide();
		}
	}
</script>
<script>
	function ShowIfChecked() {
		var checkBox = document.getElementById("penggantian");
		if (checkBox.checked == true) {
			$("#divChecked").show();
		} else {
			$("#divChecked").hide();
		}
	}
</script>

<script>
	$(document).ready(function() {
		$(window).scroll(function() {
			if ($(window).scrollTop() > 100) {
				$('#tombolScrollTop').fadeIn();
			} else {
				$('#tombolScrollTop').fadeOut();
			}
		});
	});

	function scrolltotop() {
		$('html, body').animate({
			scrollTop: 0
		}, 500);
	}
</script>

<script>
	$(document).ready(function() {
		var table = $('#general').DataTable({
			"searchable": true,
			"stateSave": true,
			"paging": true,
			"lengthMenu": [
				[10, 25, 50, 100, -1],
				[10, 25, 50, 100, "All"]
			],
			"pagingType": "full_numbers",
			"pageLength": 10,
			dom: 'Blfrtip',
			buttons: [{
					extend: 'print',
					text: '<span class="fa fa-print" aria-hidden="true"></span>',
					titleAttr: 'Print',
					columns: ':not(.select-checkbox)',
					orientation: 'landscape'
				},
				'copy', 'csv', 'excel', 'pdf'
			],
		});
	});

	$(document).ready(function() {
		var dataTable = $('#all').DataTable({
			"processing": true,
			"serverSide": true,
			"searchable": true,
			"stateSave": true,
			"paging": true,
			"lengthMenu": [
				[10, 25, 50, 100, -1],
				[10, 25, 50, 100, "All"]
			],
			"pagingType": "full_numbers",
			"pageLength": 10,
			"ajax": {
				"url": 'aset/all-ajax.php',
				"type": 'POST',

			},

			dom: 'Blfrtip',
			buttons: [{
					extend: 'print',
					text: '<span class="fa fa-print" aria-hidden="true"></span>',
					titleAttr: 'Print',
					columns: ':not(.select-checkbox)',
					orientation: 'landscape'
				},
				'copy', 'csv', 'excel', 'pdf'
			],
		});
	});
</script>

<script>
	$(document).ready(function() {
		var dataTable = $('#<?php echo $namastatus; ?>').DataTable({
			"processing": true,
			"serverSide": true,
			"searchable": true,
			"stateSave": true,
			"paging": true,
			"lengthMenu": [
				[10, 25, 50, 100, -1],
				[10, 25, 50, 100, "All"]
			],
			"pagingType": "full_numbers",
			"pageLength": 10,
			"ajax": {
				"url": 'aset/hardware-ajax.php',
				"type": 'POST',
				"data": {
					kategori: '<?php echo $namastatus; ?>'
					// etc..
				},
			},

			dom: 'Blfrtip',
			buttons: [{
					extend: 'print',
					text: '<span class="fa fa-print" aria-hidden="true"></span>',
					titleAttr: 'Print',
					columns: ':not(.select-checkbox)',
					orientation: 'landscape'
				},
				'copy', 'csv', 'excel', 'pdf'
			],
		});
	});
</script>

<script>
	$(document).ready(function() {
		var dataTable = $('#<?php echo $mod; ?>').DataTable({
			"processing": true,
			"serverSide": true,
			"searchable": true,
			"stateSave": true,
			"paging": true,
			"lengthMenu": [
				[10, 25, 50, 100, -1],
				[10, 25, 50, 100, "All"]
			],
			"pagingType": "full_numbers",
			"pageLength": 10,
			"ajax": {
				"url": 'aset/asetview-ajax.php',
				"type": 'POST',
				"data": {
					kategori: '<?php echo $mod; ?>'
					// etc..
				},
			},

			dom: 'Blfrtip',
			buttons: [{
					extend: 'print',
					text: '<span class="fa fa-print" aria-hidden="true"></span>',
					titleAttr: 'Print',
					columns: ':not(.select-checkbox)',
					orientation: 'landscape'
				},
				'copy', 'csv', 'excel', 'pdf'
			],
		});
	});
</script>


<script>
	$(document).ready(function() {
		var dataTable = $('table.<?php echo $mod; ?>').DataTable({
			"processing": true,
			"serverSide": true,
			"searchable": true,
			"stateSave": true,
			"paging": true,
			"lengthMenu": [
				[10, 25, 50, 100, -1],
				[10, 25, 50, 100, "All"]
			],
			"pagingType": "full_numbers",
			"pageLength": 10,
			"ajax": {
				"url": 'aset-scrab/scrab-ajax.php',
				"type": 'POST',
				"data": {
					kategori: '<?php echo $mod; ?>'
					// etc..
				},
			},

			dom: 'Blfrtip',
			buttons: [{
					extend: 'print',
					text: '<span class="fa fa-print" aria-hidden="true"></span>',
					titleAttr: 'Print',
					columns: ':not(.select-checkbox)',
					orientation: 'landscape'
				},
				'copy', 'csv', 'excel', 'pdf'
			],
		});
	});
</script>

<!-- TABLE LOKASI -->
<script>
	$(document).ready(function() {
		var dataTable = $('table.lokasidata').DataTable({
			"processing": true,
			"serverSide": true,
			"searchable": true,
			"stateSave": true,
			"paging": true,
			"lengthMenu": [
				[10, 25, 50, 100, -1],
				[10, 25, 50, 100, "All"]
			],
			"pagingType": "full_numbers",
			"pageLength": 10,
			"ajax": {
				"url": 'unit-kerja/lokasi-ajax.php',
				"type": 'POST',
			},

			dom: 'Blfrtip',
			buttons: [{
					extend: 'print',
					text: '<span class="fa fa-print" aria-hidden="true"></span>',
					titleAttr: 'Print',
					columns: ':not(.select-checkbox)',
					orientation: 'landscape'
				},
				'copy', 'csv', 'excel', 'pdf'
			],
		});
	});
</script>

<!-- TABEL PERBAIKAN -->
<script>
	$(document).ready(function() {
		var dataTable = $('#Perbaikantable').DataTable({

			"processing": true,
			"serverSide": true,
			"searchable": true,
			"stateSave": true,
			"paging": true,
			"lengthMenu": [
				[10, 25, 50, 100, -1],
				[10, 25, 50, 100, "All"]
			],
			"pagingType": "full_numbers",
			"pageLength": 10,
			"ajax": {
				url: "perbaikan/perbaikan-ajax.php", // json datasource
				type: "post", // method  , by default get 

			},
			dom: 'Blfrtip',
			buttons: [{
					extend: 'print',
					text: '<span class="fa fa-print" aria-hidden="true"></span>',
					titleAttr: 'Print',
					columns: ':not(.select-checkbox)',
					orientation: 'landscape'
				},
				'copy', 'csv', 'excel', 'pdf'
			],
		});
	});
</script>

<!-- TABEL KOMPONEN -->
<script>
	$(document).ready(function() {
		var dataTable = $('#tabelkomponen').DataTable({

			"processing": true,
			"serverSide": true,
			"searchable": true,
			"stateSave": true,
			"paging": true,
			"lengthMenu": [
				[10, 25, 50, 100, -1],
				[10, 25, 50, 100, "All"]
			],
			"pagingType": "full_numbers",
			"pageLength": 10,
			"ajax": {
				url: "componen/komponen-ajax.php", // json datasource
				type: "post", // method  , by default get 

			},
			dom: 'Blfrtip',
			buttons: [{
					extend: 'print',
					text: '<span class="fa fa-print" aria-hidden="true"></span>',
					titleAttr: 'Print',
					columns: ':not(.select-checkbox)',
					orientation: 'landscape'
				},
				'copy', 'csv', 'excel', 'pdf'
			],
		});
	});
</script>

<!-- TABEL PEMASOK -->
<script>
	$(document).ready(function() {
		var dataTable = $('#tabelpemasok').DataTable({

			"processing": true,
			"serverSide": true,
			"searchable": true,
			"stateSave": true,
			"paging": true,
			"lengthMenu": [
				[10, 25, 50, 100, -1],
				[10, 25, 50, 100, "All"]
			],
			"pagingType": "full_numbers",
			"pageLength": 10,
			"ajax": {
				url: "pemasok/pemasok-ajax.php", // json datasource
				type: "post", // method  , by default get 

			},
			dom: 'Blfrtip',
			buttons: [{
					extend: 'print',
					text: '<span class="fa fa-print" aria-hidden="true"></span>',
					titleAttr: 'Print',
					columns: ':not(.select-checkbox)',
					orientation: 'landscape'
				},
				'copy', 'csv', 'excel', 'pdf'
			],
		});
	});
</script>

<!-- TABEL EMPLOYEE -->
<script>
	$(document).ready(function() {
		var dataTable = $('#employtb').DataTable({

			"processing": true,
			"serverSide": true,
			"searchable": true,
			"stateSave": true,
			"paging": true,
			"lengthMenu": [
				[10, 25, 50, 100, -1],
				[10, 25, 50, 100, "All"]
			],
			"pagingType": "full_numbers",
			"pageLength": 10,
			"ajax": {
				url: "employ/organik-ajax.php", // json datasource
				type: "post", // method  , by default get 

			},
			dom: 'Blfrtip',
			buttons: [{
					extend: 'print',
					text: '<span class="fa fa-print" aria-hidden="true"></span>',
					titleAttr: 'Print',
					columns: ':not(.select-checkbox)',
					orientation: 'landscape'
				},
				'copy', 'csv', 'excel', 'pdf'
			],
		});
	});
</script>

<!-- TABEL ORGANIK -->
<script>
	$(document).ready(function() {
		var dataTable = $('#organiktabel').DataTable({
			"processing": true,
			"serverSide": true,
			"searchable": true,
			"stateSave": true,
			"paging": true,
			"lengthMenu": [
				[10, 25, 50, 100, -1],
				[10, 25, 50, 100, "All"]
			],
			"pagingType": "full_numbers",
			"pageLength": 10,
			"ajax": {
				"url": 'karyawan/organik-ajax.php',
				"type": 'POST',
				"data": {
					kategori: '<?php echo $mod; ?>'

				},
			},

			dom: 'Blfrtip',
			buttons: [{
					extend: 'print',
					text: '<span class="fa fa-print" aria-hidden="true"></span>',
					titleAttr: 'Print',
					columns: ':not(.select-checkbox)',
					orientation: 'landscape'
				},
				'copy', 'csv', 'excel', 'pdf'
			],
		});
	});
</script>

<!-- LAPORAN DISTRIBUS DEPARTEMEN -->
<script type="text/javascript">
	$(document).ready(function() {
		$('.lapDetail').DataTable({
			"ordering": false,
			dom: '<"kanan"B>t',
			buttons: [{
				extend: 'print',
				text: '<span class="fa fa-print" aria-hidden="true"></span>',
				titleAttr: 'Print',
				columns: ':not(.select-checkbox)',
				orientation: 'landscape'
			}, {
				extend: 'excel',
				action: function(e, dt, node, config) {
					let span = this.childNodes;
					console.log(this);
					$.fn.dataTable.ext.buttons.excelHtml5.action.call(this, e, dt, node, config);
				}
			}, 'copy', 'csv', 'pdf']
		});

		$('.laporan').DataTable({
			"ordering": true,
			"searchable": true,
			dom: 'Blftr',
			"lengthMenu": [
				[10, 25, 50, 100, -1],
				[10, 25, 50, 100, "All"]
			],
			buttons: [{
				extend: 'print',
				text: '<span class="fa fa-print" aria-hidden="true"></span>',
				titleAttr: 'Print',
				columns: ':not(.select-checkbox)',
				orientation: 'landscape'
			}, 'excel', 'copy', 'csv', 'pdf']
		});

		var dataTable = $('#lapDisDep').DataTable({
			"processing": true,
			"searchable": true,
			"stateSave": true,
			"paging": true,
			"lengthMenu": [
				[10, 25, 50, 100, -1],
				[10, 25, 50, 100, "All"]
			],
			"pagingType": "full_numbers",
			"pageLength": 10,
			dom: 'Blfrtip',
			buttons: [{
					extend: 'print',
					text: '<span class="fa fa-print" aria-hidden="true"></span>',
					titleAttr: 'Print',
					columns: ':not(.select-checkbox)',
					orientation: 'landscape'
				}, {
					extend: 'excel',
					title: 'LAPORAN DISTRIBUSI DEPARTEMEN <?= $bulanFull[date('n')] . " " . date('Y') ?>'.toUpperCase()

				},
				'copy', 'csv', 'pdf'
			],
		});
	});
</script>
<script type="text/javascript">
	$(function() {
		$('#departemen').change(function() {
			$('#bagian').after('<span class="loading">Tunggu..sedang load data bagian..</span>');
			$('#bagian').load('karyawan/caribagian.php?jk=' + $(this).val(), function(responseTxt, statusTxt, xhr) {
				if (statusTxt == "success")
					$('.loading').remove();

			});
			return false;
		});

	});
</script>

<script language='JavaScript'>
	var ajaxRequest;

	function getAjax() //mengecek apakah web browser support AJAX atau tidak
	{
		try {
			// Opera 8.0+, Firefox, Safari
			ajaxRequest = new XMLHttpRequest();
		} catch (e) {
			// Internet Explorer Browsers
			try {
				ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
			} catch (e) {
				try {
					ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
				} catch (e) {
					// Something went wrong
					alert("Your browser broke!");
					return false;
				}
			}
		}
	}

	function validasi(keyEvent, pilihan) //fungsi untuk mengambil nilai setiap huruf yang dimasukkan
	{
		keyEvent = (keyEvent) ? keyEvent : window.event;
		input = (keyEvent.target) ? keyEvent.target : keyEvent.srcElement;
		if (input.value) //jika input dimasukkan, masuk ke fungsi cekEmail
		{
			if (pilihan == 1) {
				pass = document.getElementById("pass").value; //mengambil nilai dari form password yang telah dicek
				cekPass("usercekpass.php?password=1&pass=" + pass + "&input=" + input.value, 1); //mengirim inputan konfirmasi password
			} else if (pilihan == 2) {
				pass = document.getElementById("pass").value; //mengambil nilai dari form password yang telah dicek
				cekPass("usercekpass.php?password=2&pass=" + pass + "&input=" + input.value, 2); //mengirim inputan konfirmasi password
			}
		}
	}

	function cekPass(fileCek, keterangan) //fungsi untuk menampilkan hasil pengecekan
	{
		getAjax();
		ajaxRequest.open("GET", fileCek);
		ajaxRequest.onreadystatechange = function() {
			if (keterangan == 1) {
				document.getElementById("hasil").innerHTML = ajaxRequest.responseText; //hasil cek kekuatan password
			} else if (keterangan == 2) {

				document.getElementById("cocok").innerHTML = ajaxRequest.responseText; //hasil cek konfirmasi password
			}
		}
		ajaxRequest.send(null);
	}
</script>


<script type="text/javascript">
	$(function() {
		$('#no_aset_id').change(function() {
			var id = $(this).find(":selected").val();
			var dataString = 'action=' + id;
			$.ajax({
				url: "save-proses.php",
				type: "POST",
				data: dataString,
				success: function(response) {
					$("#show-aset-detil").html(response);
				}
			});
		});

	});
</script>

<script type="text/javascript">
	$(function() {
		var id = 1;
		$(document).on("click", ".hapusbag", function() {
			var parentCol = $(this).parent();
			var parentRow = parentCol.parent()
			parentRow.remove();
		});
		$('#tambahbag').click(function() {
			var form = $('#bagian-form');
			var row = document.createElement('div');
			row.setAttribute('id', 'b' + id);

			var group1 = document.createElement('div');
			var group2 = document.createElement('div');
			var group3 = document.createElement('div');

			group1.setAttribute('class', 'form-group col-md-5')
			group2.setAttribute('class', 'form-group col-md-6')
			group3.setAttribute('class', 'col-md-1')

			var label1 = document.createElement("label");
			var label2 = document.createElement("label");

			label1.setAttribute('class', 'col-md-5 control-label');
			label2.setAttribute('class', 'col-md-4 control-label');

			label1.innerHTML = "Kode Bagian";
			label2.innerHTML = "Nama Bagian";

			var inputDiv1 = document.createElement("div");
			var inputDiv2 = document.createElement("div");

			inputDiv1.setAttribute('class', "col-md-7 col-sm-12 required");
			inputDiv2.setAttribute('class', "col-md-8 col-sm-12 required");

			var input1 = document.createElement("input")
			var input2 = document.createElement("input")

			input1.setAttribute("class", "form-control");
			input2.setAttribute("class", "form-control");
			input1.setAttribute("type", "text");
			input2.setAttribute("type", "text");
			input1.setAttribute("name", "kd_bag[]");
			input2.setAttribute("name", "nm_bag[]");

			var btn = document.createElement("button");
			btn.setAttribute("class", "btn btn-danger hapusbag");
			btn.setAttribute("type", "button");
			btn.setAttribute("target", "b" + id);

			var icon = document.createElement("span");
			icon.setAttribute("class", "glyphicon glyphicon-trash");

			//Append Kode Bagian
			$(inputDiv1).append(input1);
			$(group1).append(label1);
			$(group1).append(inputDiv1);
			$(row).append(group1);

			//Append Nama Bagian
			$(inputDiv2).append(input2);
			$(group2).append(label2);
			$(group2).append(inputDiv2);
			$(row).append(group2);

			//Append Btn Hapus
			$(btn).append(icon);
			$(group3).append(btn)
			$(row).append(group3);
			//Append to Form
			$(form).append(row);

			id++;
			console.log(id);
		});
	})
</script>
<!-- CHART -->
<script type="text/javascript">
	$(document).ready(function() {
		google.charts.load('current', {
			'packages': ['corechart', 'bar']
		});
		google.charts.setOnLoadCallback(function() {
			drawKomponen();
		});

		//DATA Aset
		function drawChart() {

			var data = google.visualization.arrayToDataTable([
				['Merk', 'sdsdsdsdsds'],
				<?php
				$result = $conn->query("SELECT * FROM  data_kategori");
				while ($row = $result->fetch_assoc()) {
					$kategori = $row['kd_kategori'];
					$total = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM data_aset WHERE kd_kategori = '$kategori'"));
				?>['<?= $row['nama_kategori']; ?> <?= "(" . $total . ")"; ?>', <?= $total; ?>],
				<?php
				}
				?>
			]);

			var options = {
				animation: {
					startup: true,
					duration: 1000,
					easing: 'out',
				},
				width: 700,
				height: 300,
				is3D: true,
			};

			var piechart = new google.visualization.PieChart(document.getElementById('piechart1'));
			piechart.draw(data, options);


		}
		// DATA PERBAIKAN
		
		// DATA KOMPONEN
		function drawKomponen() {
			<?php
			$data = [];
			$sql = "SELECT nama_kategori, SUM(a.sisa) as total FROM komponen as a          
					LEFT JOIN kategori as b ON a.id_kategori = b.id_kategori Group By a.id_kategori";
			$q = mysqli_query($conn, $sql);
			while ($v = mysqli_fetch_assoc($q)) {
				array_push($data, $v);
			}

			//echo mysqli_error($conn);
			//var_dump($data);
			?>

			var data = google.visualization.arrayToDataTable([
				['Kategori', 'Total'],
				<?php
				foreach ($data as $key => $value) { ?>['<?= $value['nama_kategori'] . ' (' . $value['total'] . ')' ?>', <?= $value['total'] ?>],
				<?php }
				?>
			]);

			var options = {
				animation: {
					startup: true,
					duration: 1000,
					easing: 'out',
				},
				width: 700,
				height: 300,
				is3D: true,
			};

			var chart = new google.visualization.PieChart(document.getElementById('komponenChart'));
			chart.draw(data, options);
		}
	})

	function base64ToArrayBuffer(_base64Str) {
		var binaryString = window.atob(_base64Str);
		var binaryLen = binaryString.length;
		var bytes = new Uint8Array(binaryLen);
		for (var i = 0; i < binaryLen; i++) {
			var ascii = binaryString.charCodeAt(i);
			bytes[i] = ascii;
		}
		return bytes;
	}
</script>