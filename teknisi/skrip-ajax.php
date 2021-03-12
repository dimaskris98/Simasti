<!-- Karyawan-->  
<script type="text/javascript">
$(document).ready(function() {
 $("#Addnewkaryawan").click(function (e) {
	e.preventDefault();
	var nik=document.getElementById('nik').value;
	var nama=document.getElementById('namakaryawan').value; 
	var uker=document.getElementById('departemen').value;
	var bagian=document.getElementById('bagian').value; 
	var tipe=document.querySelector('input[name=tipe]:checked').value	
	 
	 
	if(nik==='')
		{
		alert("Nik Harus Terisi!");
		return false;
		}
	if( nama==='')
		{
		alert("Nama Harus Terisi!");
		return false;
		}
		
		var myData='nik='+nik+'&nama='+nama+'&uker='+uker+'&bagian='+bagian+'&tipe='+tipe; 	//build a post data structure 
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
 
 
<!--Aset Monitor-->  
<script type="text/javascript">
$(document).ready(function() {
 $("#addMonitor").click(function (e) {
	e.preventDefault();
	var aset=document.getElementById('aset').value; 
	var model=document.getElementById('namamodel').value; 
	var sn=document.getElementById('sntag').value; 
	var sewa=document.getElementById('sewa').value; 
	var tahun=document.getElementById('tahun').value; 
	 
	if( aset==='')
	{
		alert("Masukkan Nomor aset!");
		return false;
	}
	if( model==='')
	{
		alert("Masukkan Model Aset!");
		return false;
	}
	 
	if( sn==='')
	{
		alert("Masukkan S/n Aset!");
		return false;
	}
	if( tahun==='')
	{
		alert("Masukkan tahun Aset!");
		return false;
	}
	 
		var myData='konten_aset='+aset;
		myData+='&konten_model='+model; 
		myData+='&konten_sewa='+sewa; 
		myData+='&konten_sn='+sn; 
		myData+='&konten_tahun='+tahun; 	//build a post data structure 
		jQuery.ajax({
		type: "POST", // Post / Get method
		url: "save-proses.php", //Where form data is sent on submission
		dataType:"text", // Data type, HTML, json etc.
		data:myData, //Form variables
			success:function(response){
			$("#id_monitor").append(response);
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
var dataTable = $('#<?php echo $mod;?>').DataTable({
     "processing": true,
    "serverSide": true,
	"searchable":true, 
 "stateSave": true,
 "paging": true,
 "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
 "pagingType": "full_numbers",
 "pageLength": 10,
	"ajax": {
			"url": 'aset/asetview-ajax.php',
			"type": 'POST',
			"data":{
			   kategori: '<?php echo $mod;?>',
			   sewa: '<?php echo $sewa;?>' 
			   // etc..
			},
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
var dataTable = $('#Perbaikantable').DataTable({
     
    "processing": true,
    "serverSide": true,
	"searchable":true, 
 "stateSave": true,
 "paging": true,
 "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
 "pagingType": "full_numbers",
 "pageLength": 10,
    "ajax":{
			"url": 'perbaikan/perbaikan-ajax.php',
			"type": 'POST',
			"data":{ 
			   sewa: '<?php echo $sewa;?>' 
			   // etc..
			}, 
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
 
<script type="text/javascript">
$(function(){
   $('#no_aset_id').change(function(){
	   var id = $(this).find(":selected").val();
		var dataString = 'action='+ id;
		$.ajax({
				url: "save-proses.php",
				type: "POST",
				data:dataString,
				success: function(response){
					$("#show-aset-detil").html(response);
				}        
		   });
   });

});

</script> 
