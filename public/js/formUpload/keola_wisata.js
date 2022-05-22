var base_url = $("#base_url").val();
var save_method;
var table_dosen = $('#table-dosen').DataTable();
var table = $('#table-data').DataTable();
var controller = base_url + "dosen_jabfung/";

$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});
      
$(".btn-submit").click(function(e){

    e.preventDefault();
 
    var title = $("#titleID").val();
    var body = $("#bodyID").val();
 
    $.ajax({
       type:'POST',
       url:"{{ route('posts.store') }}",
       data:{title:title, body:body},
       success:function(data){
            if($.isEmptyObject(data.error)){
                alert(data.success);
                location.reload();
            }else{
                printErrorMsg(data.error);
            }
       }
    });

});

function printErrorMsg (msg) {
    $(".print-error-msg").find("ul").html('');
    $(".print-error-msg").css('display','block');
    $.each( msg, function( key, value ) {
        $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
    });
}

function add() {
    $('#CompanyForm').trigger("reset");
    $('#CompanyModal').html("Add Company");
    $('#company-modal').modal('show');
    $('#id').val('');
}
function editFunc(id) {
    $.ajax({
        type: "POST",
        url: "setupFasilitas",
        data: { id: id },
        dataType: 'json',
        success: function (res) {
            // $('#CompanyModal').html("Edit Company");
            // $('#company-modal').modal('show');
            // $('#id').val(res.id);
            // $('#name').val(res.name);
            // $('#address').val(res.address);
            // $('#email').val(res.email);
            alert(id);
        }
    });
}
function deleteFunc(id) {
    if (confirm("Delete Record?") == true) {
        var id = id;
        // ajax
        $.ajax({
            type: "POST",
            url: "{{ url('delete-company') }}",
            data: { id: id },
            dataType: 'json',
            success: function (res) {
                var oTable = $('#ajax-crud-datatable').dataTable();
                oTable.fnDraw(false);
            }
        });
    }
}
$('#CompanyForm').submit(function (e) {
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        type: 'POST',
        url: "{{ url('store-company')}}",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: (data) => {
            $("#company-modal").modal('hide');
            var oTable = $('#ajax-crud-datatable').dataTable();
            oTable.fnDraw(false);
            $("#btn-save").html('Submit');
            $("#btn-save").attr("disabled", false);
        },
        error: function (data) {
            console.log(data);
        }
    });
});

function c() {
    $('#exampleModal').modal('show');
}

function getMessage(id) {
    // alert(id);
    $.ajax({
        url: "setupFasilitas",
        type: "POST",
        dataType: "JSON",
        data: '_token = <?php echo csrf_token() ?>',
        success: function (data) {
            alert(id);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            notif_error("Error Prosess data..!!");
        },
    }); //end ajax

}

function getMsg() {
    $.ajax({
        type: 'POST',
        url: '/getmsg',
        data: '_token = <?php echo csrf_token() ?>',
        success: function (data) {
            alert(data.msg);
        }
    });
}

function open_fasilitas(id) {
    $('#exampleModal').modal('show');
}

function modal_image(tag) {
    var src = document.getElementById(tag).src;
    var modal = document.getElementById("myModal");
    var modalImg = document.getElementById("img01");
    modal.style.display = "block";
    modalImg.src = src;
    document.body.style.overflow = "hidden";
}

function modal_image_close() {
    var modal = document.getElementById("myModal");
    modal.style.display = "none";
    document.body.style.overflow = "auto";
}

function aler() {
    alert('Anjer');
}

$('.generate-qr-code').on('click', function(){

    // Clear Previous QR Code
    $('#qrcode').empty();
    
    // Set Size to Match User Input
    $('#qrcode').css({
    'width' : $('.qr-size').val(),
    'height' : $('.qr-size').val()
    })
    
    // Generate and Output QR Code
    $('#qrcode').qrcode({width: $('.qr-size').val(),height: $('.qr-size').val(),text: $('.qr-url').val()});
    
    });