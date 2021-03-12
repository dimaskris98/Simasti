<a id="tombolScrollTop" onclick="scrolltotop()"><i class="fa fa-arrow-circle-o-up"></i></a>
</div>

<!--footer-->
<div class="footer">
  <div class="col-md-12 panel-grids">
    <p>&copy; 2018 Tekinfo | Design by <a href="https://w3layouts.com/" target="_blank">w3layouts</a></p>
  </div>
</div>
<!--//footer-->
</div>
<!-- Classie -->



<script src="js/bootstrap.js"> </script>
<script src="js/classie.js"></script>
<script>
  var menuLeft = document.getElementById('cbp-spmenu-s1'),
    showLeftPush = document.getElementById('showLeftPush'),
    body = document.body;

  showLeftPush.onclick = function() {
    classie.toggle(this, 'active');
    classie.toggle(body, 'cbp-spmenu-push-toright');
    classie.toggle(menuLeft, 'cbp-spmenu-open');
    disableOther('showLeftPush');
  };


  function disableOther(button) {
    if (button !== 'showLeftPush') {
      classie.toggle(showLeftPush, 'disabled');
    }
  }
</script>

<script type="text/javascript">
  $("#tahun").datepicker({
    autoclose: true,
    format: " yyyy",
    viewMode: "years",
    minViewMode: "years",
  });

  $("#tahun1").datepicker({
    autoclose: true,
    format: " yyyy",
    viewMode: "years",
    minViewMode: "years",
  });
  $(".datepicker").datepicker({
    format: " yyyy",
    viewMode: "years",
    minViewMode: "years"
  });
  $(".tglpicker").datepicker({
    format: "yyyy-mm-dd",
    viewMode: "date",
    autoclose: true,
    todayHighlight: true,
    minViewMode: "date"
  });
</script>


<script src="js/bootstrap-select.min.js"></script>
<script src="js/bootstrap-select.js"></script>
<link rel="stylesheet" href="css/bootstrap-select.min.css" type="text/css">

<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/js.js"></script>



<script src="asset/jquery-1.7.2.min.js"></script>
<script src="asset/bootstrap.min.js"></script>

<script src="asset/datatables/dataTables.bootstrap.min.js"></script>
<link rel="stylesheet" href="asset/datatables/dataTables.bootstrap.css">
<script src="asset/datatables/jquery-3.3.1.js"></script>
<script src="asset/datatables/jquery.dataTables.min.js"></script>
<script src="asset/datatables/buttons.print.min.js"></script>
<script src="asset/datatables/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">

<script src="asset/js/jquery.bootstrap-duallistbox.min.js"></script>

<!--Select2-->
<script src="asset/plugin/select2-4.0.3/dist/js/select2.min.js"></script>

<script type="text/javascript">
  $(document).ready(function() {
    $("table.tableaudit").DataTable({
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
      buttons: [
        'copy', 'csv', 'excel', 'pdf',
        {
          "extend": "print",
          "text": "<i class='fa fa-print bigger-110 grey'></i> <span class='hidden'>Print</span>",
          "className": "btn btn-white btn-primary btn-bold",
          "title": " <?= $title ?> ",
          "message": '<?= $message ?>',
          autoPrint: true,
          customize: function(win) {
            $(win.document.body)
              .css('font-size', '10pt');

            $(win.document.body).find('table')
              .addClass('compact')
              .css('font-size', 'inherit');
          }

        }
      ]
    });
  });
</script>
<script type="text/javascript">
  $(document).ready(function() {
    $("table.tabledisplay").DataTable({

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
</script>

<script>
  (function() {
    var bar = $('.bar');
    var percent = $('.percent');
    var status = $('#status');

    $('form').ajaxForm({
      beforeSend: function() {
        status.empty();
        var percentVal = '0%';
        bar.width(percentVal)
        percent.html(percentVal);
      },
      uploadProgress: function(event, position, total, percentComplete) {
        var percentVal = percentComplete + '%';
        bar.width(percentVal)
        percent.html(percentVal);
        //console.log(percentVal, position, total);
      },
      complete: function(xhr) {
        status.html(xhr.responseText);
      }
    });
  })();
</script>

<script type="text/javascript">
  function tampilkanPreview(userfile, idpreview) {
    var gb = userfile.files;
    for (var i = 0; i < gb.length; i++) {
      var gbPreview = gb[i];
      var imageType = /image.*/;
      var preview = document.getElementById(idpreview);
      var reader = new FileReader();
      if (gbPreview.type.match(imageType)) {
        //jika tipe data sesuai
        preview.file = gbPreview;
        reader.onload = (function(element) {
          return function(e) {
            element.src = e.target.result;
          };
        })(preview);
        //membaca data URL gambar
        reader.readAsDataURL(gbPreview);
      } else {
        //jika tipe data tidak sesuai
        alert("Tipe file tidak sesuai. Gambar harus bertipe .png, .gif atau .jpg.");
      }
    }
  }
</script>

<script type="text/javascript">
  $("select.select2").select2({
    placeholder: "Silahkan Pilih....",
    allowClear: true
  });

  $("select.select3").select2({
    placeholder : "Silahkan Pilih....",
    allowClear : true,
    tags:true
  });
</script>
<script type="text/javascript">
  // Specify the normal table row background color
  //   and the background color for when the mouse 
  //   hovers over the table row.

  var TableBackgroundNormalColor = "#ffffff";
  var TableBackgroundMouseoverColor = "#9999ff";

  // These two functions need no customization.
  function ChangeBackgroundColor(row) {
    row.style.backgroundColor = TableBackgroundMouseoverColor;
  }

  function RestoreBackgroundColor(row) {
    row.style.backgroundColor = TableBackgroundNormalColor;
  }
</script>

<script type="text/javascript">
  jQuery(function($) {
    var demo1 = $('select[name="duallistbox_demo1[]"]').bootstrapDualListbox({
      infoTextFiltered: '<span class="label  purple label-lg">Filtered</span>'
    });
    var container1 = demo1.bootstrapDualListbox('getContainer');
    container1.find('.btn').addClass(' ');
  });
</script>


</body>

</html>