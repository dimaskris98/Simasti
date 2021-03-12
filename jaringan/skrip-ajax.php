
<!-- Karyawan-->  
<script type="text/javascript">
$(document).ready(function() {
 $("#Addnewkaryawan").click(function (e) {
	e.preventDefault();
	var nik=document.getElementById('nik').value;
	var nama=document.getElementById('namakaryawan').value; 
	var uker=document.getElementById('departemen').value;
	var bagian=document.getElementById('bagian').value; 
	if($("#nik").val()==='')
		{
		alert("Nik Harus Terisi!");
		return false;
		}
	if($("#namakaryawan").val()==='')
		{
		alert("Nama Harus Terisi!");
		return false;
		}
	 
		var myData='nik='+nik;
		myData+='&nama='+nama; 
		myData+='&uker='+uker; 
		myData+='&bagian='+bagian; 	//build a post data structure 
		jQuery.ajax({
		type: "POST", // Post / Get method
		url: "save-proses.php", //Where form data is sent on submission
		dataType:"text", // Data type, HTML, json etc.
		data:myData, //Form variables
			success:function(response){
			$("#karyawan").append(response);
			},
		error:function (xhr, ajaxOptions, thrownError){
		alert(thrownError);
		}
		});
	});
});
</script>  

<!-- Status Labels-->  
<script type="text/javascript">
$(document).ready(function() {
 $("#Addnewstatus").click(function (e) {
	e.preventDefault();
	var nama=document.getElementById('namastatus').value;
	var type=document.getElementById('tipestatus').value;
	if($("#namastatus").val()==='')
		{
		alert("Please enter some text!");
		return false;
		}
		var myData='isi_status='+nama;
		myData+='&isi_type='+type; 	//build a post data structure 
		jQuery.ajax({
		type: "POST", // Post / Get method
		url: "save-proses.php", //Where form data is sent on submission
		dataType:"text", // Data type, HTML, json etc.
		data:myData, //Form variables
			success:function(response){
			$("#status").append(response);
			},
		error:function (xhr, ajaxOptions, thrownError){
		alert(thrownError);
		}
		});
	});
});
</script>  

<!-- Status Labels-->  
<script type="text/javascript">
$(document).ready(function() {
 $("#Addnewstatus").click(function (e) {
	e.preventDefault();
	var nama=document.getElementById('namastatus').value;
	var type=document.getElementById('tipestatus').value;
	if($("#namastatus").val()==='')
		{
		alert("Please enter some text!");
		return false;
		}
		var myData='isi_status='+nama;
		myData+='&isi_type='+type; 	//build a post data structure 
		jQuery.ajax({
		type: "POST", // Post / Get method
		url: "save-proses.php", //Where form data is sent on submission
		dataType:"text", // Data type, HTML, json etc.
		data:myData, //Form variables
			success:function(response){
			$("#status").append(response);
			},
		error:function (xhr, ajaxOptions, thrownError){
		alert(thrownError);
		}
		});
	});
});
</script>  

<!-- SUPPLIER-->  
<script type="text/javascript">
$(document).ready(function() {
 $("#Addnewsupplier").click(function (e) {
	e.preventDefault();
	if($("#namasupplier").val()==='')
		{
		alert("Please enter some text!");
		return false;
		}
		var myData ='content_sup='+ $("#namasupplier").val(); //build a post data structure
		jQuery.ajax({
		type: "POST", // Post / Get method
		url: "save-proses.php", //Where form data is sent on submission
		dataType:"text", // Data type, HTML, json etc.
		data:myData, //Form variables
			success:function(response){
			$("#pemasok").append(response);
			},
		error:function (xhr, ajaxOptions, thrownError){
		alert(thrownError);
		}
		});
	});
});
</script>

<!-- KATEGORI consumable-->  
<script type="text/javascript">
$(document).ready(function() {
 $("#newKatConsum").click(function (e) {
	e.preventDefault();
	if($("#namakat_consum").val()==='')
		{
		alert("Please enter some text!");
		return false;
		}
		var myData ='kat_consum='+ $("#namakat_consum").val(); //build a post data structure
		jQuery.ajax({
		type: "POST", // Post / Get method
		url: "save-proses.php", //Where form data is sent on submission
		dataType:"text", // Data type, HTML, json etc.
		data:myData, //Form variables
			success:function(response){
			$("#kategori").append(response);
			},
		error:function (xhr, ajaxOptions, thrownError){
		alert(thrownError);
		}
		});
	});
});
</script>


<!-- KATEGORI-->  
<script type="text/javascript">
$(document).ready(function() {
 $("#Addnewkategori").click(function (e) {
	e.preventDefault();
	if($("#namakategori").val()==='')
		{
		alert("Please enter some text!");
		return false;
		}
		var myData ='content_kat='+ $("#namakategori").val(); //build a post data structure
		jQuery.ajax({
		type: "POST", // Post / Get method
		url: "save-proses.php", //Where form data is sent on submission
		dataType:"text", // Data type, HTML, json etc.
		data:myData, //Form variables
			success:function(response){
			$("#category").append(response);
			},
		error:function (xhr, ajaxOptions, thrownError){
		alert(thrownError);
		}
		});
	});
});
</script>

<!-- manufaktur-->  
<script type="text/javascript">
$(document).ready(function() {
 $("#Addnewmanufaktur").click(function (e) {
	e.preventDefault();
	if($("#namamanufaktur").val()==='')
		{
		alert("Please enter some text!");
		return false;
		}
		var myData ='content_manufaktur='+ $("#namamanufaktur").val(); //build a post data structure
		jQuery.ajax({
		type: "POST", // Post / Get method
		url: "save-proses.php", //Where form data is sent on submission
		dataType:"text", // Data type, HTML, json etc.
		data:myData, //Form variables
			success:function(response){
			$("#manufaktur").append(response);
			},
		error:function (xhr, ajaxOptions, thrownError){
		alert(thrownError);
		}
		});
	});
});
</script>

<!-- Status Labels-->  
<script type="text/javascript">
$(document).ready(function() {
 $("#Addnewlabel").click(function (e) {
	e.preventDefault();
	var nama=document.getElementById('namalabel').value;
	var type=document.getElementById('type').value;
	if($("#namalabel").val()==='')
		{
		alert("Please enter some text!");
		return false;
		}
		var myData='content_status='+nama;
		myData+='&content_type='+type; 	//build a post data structure 
		jQuery.ajax({
		type: "POST", // Post / Get method
		url: "save-proses.php", //Where form data is sent on submission
		dataType:"text", // Data type, HTML, json etc.
		data:myData, //Form variables
			success:function(response){
			$("#status").append(response);
			},
		error:function (xhr, ajaxOptions, thrownError){
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
        xmlhttp.open("GET","save-proses.php?q="+str,true);
        xmlhttp.send();
    }
}
</script>  

<script>
		function showEdit(editableObj) {
			$(editableObj).css("background","#FFF");
		} 	
		function saveToDatabase(editableObj,column,id) {
			$(editableObj).css("background","#FFF url(images/loaderIcon.gif) no-repeat right");
			$.ajax({
				url: "save-proses.php",
				type: "POST",
				data:'column='+column+'&editval='+editableObj.innerHTML+'&id='+id,
				success: function(data){
					$(editableObj).css("background","#FDFDFD");
				}        
		   });
		}
</script>
<script> 
	$("#kategori").change(function(){
   if($(this).val()=="cp")
   {    
       $("#divos").show();  $("#divmonitor").show(); 
   }else if($(this).val()=="nb")
   {    
        $("#divmonitor").hide();
		$("#divos").show(); 
   }
    else
    {
        $("#divmonitor").hide();
	   $("#divos").hide();
		 
    }
});

</script> 

   
 <script type="text/javascript">    
    <?php echo $jsArrayaset; ?>  
    function changeValue(no_aset){    
    document.getElementById('snaset').value = dataaset[no_aset].sn; 
	 
    };  
    </script> 
	
 <script type="text/javascript">    
    <?php echo $jsArray; ?>  
    function changeValue(status){    
    document.getElementById('jrsn').value = dtstatus[status].deployable; 
	if(dtstatus[status].deployable=="1")
		 {    
       $("#divstatus").show();  
   }else 
    {
        
	   $("#divstatus").hide(); 
    }
    };  
    </script> 
	
<script>
function ShowIfCheckedMonitor() {
    var checkBox = document.getElementById("penggantianmonitor"); 
    if (checkBox.checked == true){
        $("#divCheckedMonitor").show(); 
    } else {
       $("#divCheckedMonitor").hide(); 
    }
}
</script>	
<script>
function ShowIfCheckedMonitoraktif() {
    var checkBox = document.getElementById("chekoutmonitor"); 
    if (checkBox.checked == true){
        $("#divCheckedMonitoraktif").show(); 
    } else {
       $("#divCheckedMonitoraktif").hide(); 
    }
}
</script>
<script>
function ShowIfChecked() {
    var checkBox = document.getElementById("penggantian"); 
    if (checkBox.checked == true){
        $("#divChecked").show(); 
    } else {
       $("#divChecked").hide(); 
    }
}
</script>

 <script>
	$(document).ready(function(){
		$(window).scroll(function(){
			if ($(window).scrollTop() > 100) {
				$('#tombolScrollTop').fadeIn();
			} else {
				$('#tombolScrollTop').fadeOut();
			}
		});
	});

	function scrolltotop()
	{
		$('html, body').animate({scrollTop : 0},500);
	}
 </script>
 

<script>
$(document).ready(function() {
    $('#hardware').DataTable();
} ); 
 </script>
 
<script>
$(document).ready(function() {
var dataTable = $('#<?php echo $mod;?>').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax":{
		url :"aset/asetview-<?php echo $mod;?>-ajax.php", // json datasource
        type: "post",  // method  , by default get 
        error: function(){  // error handling
            $(".<?php echo $mod;?>-error").html("");
            $("#<?php echo $mod;?>").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
            $("#<?php echo $mod;?>_processing").css("display","none");
        }
    },
	dom: 'Blfrtip',
	buttons: [
		{
			extend: 'print',
			text: '<span class="fa fa-print" aria-hidden="true"></span>',
			titleAttr: 'Print',
			columns: ':not(.select-checkbox)',
			orientation: 'landscape'
		},
		'copy', 'csv', 'excel', 'pdf'
	],
} );
} );
 </script> 
<script>
$(document).ready(function() {
var dataTable = $('#karyawantable').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax":{
		url :"karyawan/organik-ajax.php", // json datasource
        type: "post",  // method  , by default get 
        error: function(){  // error handling
            $(".karyawan-error").html("");
            $("#karyawan").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
            $("#karyawan_processing").css("display","none");
        }
    },
	dom: 'Blfrtip',
	buttons: [
		{
			extend: 'print',
			text: '<span class="fa fa-print" aria-hidden="true"></span>',
			titleAttr: 'Print',
			columns: ':not(.select-checkbox)',
			orientation: 'landscape'
		},
		'copy', 'csv', 'excel', 'pdf'
	],
} );
} );
 </script>
 <script type="text/javascript">
$(function(){
   $('#departemen').change(function(){
	    $('#bagian').after('<span class="loading">Tunggu..sedang load data bagian..</span>');
		$('#bagian').load('karyawan/caribagian.php?jk=' + $(this).val(),function(responseTxt,statusTxt,xhr)
		{
		  if(statusTxt=="success")
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
try
{
// Opera 8.0+, Firefox, Safari
ajaxRequest = new XMLHttpRequest();
}
catch (e)
{
// Internet Explorer Browsers
try
{
ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
}
catch (e)
{
try
{
ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
}
catch (e)
{
// Something went wrong
alert("Your browser broke!");
return false;
}
}
}
}

function validasi (keyEvent,pilihan) //fungsi untuk mengambil nilai setiap huruf yang dimasukkan
{
keyEvent = (keyEvent) ? keyEvent: window.event;
input = (keyEvent.target) ? keyEvent.target: keyEvent.srcElement;
if (input.value) //jika input dimasukkan, masuk ke fungsi cekEmail
{
if (pilihan == 1)
{
	pass = document.getElementById("pass").value; //mengambil nilai dari form password yang telah dicek
cekPass("usercekpass.php?password=1&pass=" + pass + "&input=" + input.value,1); //mengirim inputan konfirmasi password
}
else if (pilihan == 2)
{
pass = document.getElementById("pass").value; //mengambil nilai dari form password yang telah dicek
cekPass("usercekpass.php?password=2&pass=" + pass + "&input=" + input.value,2); //mengirim inputan konfirmasi password
}
}
}

function cekPass(fileCek,keterangan) //fungsi untuk menampilkan hasil pengecekan
{
getAjax();
ajaxRequest.open("GET",fileCek);
ajaxRequest.onreadystatechange = function()
{
if (keterangan == 1)
{
document.getElementById("hasil").innerHTML = ajaxRequest.responseText; //hasil cek kekuatan password
}
else if (keterangan == 2)
{

document.getElementById("cocok").innerHTML = ajaxRequest.responseText; //hasil cek konfirmasi password
}
}
ajaxRequest.send(null);
}
</script>