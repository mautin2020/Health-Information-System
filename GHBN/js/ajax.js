$(document).on('click','#btn-add',function(e) {
    var data = $("#user_form").serialize();
    $.ajax({
        data: data,
        type: "post",
        url: "save.php",
        success: function(dataResult){
                var dataResult = JSON.parse(dataResult);
                if(dataResult.statusCode==200){
                    $('#addEmployeeModal').modal('hide');
                    alert('Data added successfully !'); 
                    location.reload();						
                }
                else if(dataResult.statusCode==201){
                   alert(dataResult);
                }
        }
    });
});

$(document).on('click','.update',function(e) {
    var id=$(this).attr("data-id");
    var sch_date=$(this).attr("data-sch_date");
    var section=$(this).attr("data-section");
    var doctor_name=$(this).attr("data-doctor_name");
    var start_time=$(this).attr("data-start_time");
    var end_time=$(this).attr("data-end_time");
    var D_id=$(this).attr("data-D_id");
    $('#id_u').val(id);
    $('#sch_date_u').val(sch_date);
    $('#section_u').val(section);
    $('#doctor_name_u').val(doctor_name);
    $('#start_time_u').val(start_time);
    $('#end_time_u').val(end_time);
    $('#D_id_u').val(D_id);
});

$(document).on('click','#update',function(e) {
    var data = $("#update_form").serialize();
    $.ajax({
        data: data,
        type: "post",
        url: "save.php",
        success: function(dataResult){
                var dataResult = JSON.parse(dataResult);
                if(dataResult.statusCode==200){
                    $('#editEmployeeModal').modal('hide');
                    alert('Data updated successfully !'); 
                    location.reload();
                }
                else if(dataResult.statusCode==201){
                   alert(dataResult);
                }
        }
    });
});

$(document).on('click','.vitalSign',function(e) {
    var id=$(this).attr("data-id");
    var patient_name=$(this).attr("data-patient_name");
    var status=$(this).attr("data-status");
    var pd_id=$(this).attr("data-pd_id");
    $('#id_v').val(id);
    $('#patient_name_v').val(patient_name);
    $('#status_v').val(status);
    $('#pd_id_v').val(pd_id);
});

$(document).on('click','#btn-createvitals',function(e) {
    var data = $("#vitals_form").serialize();
    $.ajax({
        data: data,
        type: "post",
        url: "save.php",
        success: function(dataResult){
                var dataResult = JSON.parse(dataResult);
                if(dataResult.statusCode==200){
                    $('#VitalsSign').modal('hide');
                    alert('Vitals Sign Added Successfully !'); 
                    location.reload();						
                }
                else if(dataResult.statusCode==201){
                   alert(dataResult);
                }
        }
    });
});

$(document).on('click','.symptoms',function(e) {
    var id=$(this).attr("data-id");
    var patient_name=$(this).attr("data-patient_name");
    var status=$(this).attr("data-status");
    var pd_id=$(this).attr("data-pd_id");
    $('#id_s').val(id);
    $('#patient_name_s').val(patient_name);
    $('#status_s').val(status);
    $('#pd_id_s').val(pd_id);
});

$(document).on('click','#btn-addsymptoms',function(e) {
    var data = $("#symptoms_form").serialize();
    $.ajax({
        data: data,
        type: "post",
        url: "save.php",
        success: function(dataResult){
                var dataResult = JSON.parse(dataResult);
                if(dataResult.statusCode==200){
                    $('#AddSymptoms').modal('hide');
                    alert('Symptoms Added Successfully !'); 
                    location.reload();						
                }
                else if(dataResult.statusCode==201){
                   alert(dataResult);
                }
        }
    });
});

$(document).on('click','.diagnosis',function(e) {
    var id=$(this).attr("data-id");
    var patient_name=$(this).attr("data-patient_name");
    var status=$(this).attr("data-status");
    var pd_id=$(this).attr("data-pd_id");
    $('#id_G').val(id);
    $('#patient_name_G').val(patient_name);
    $('#status_G').val(status);
    $('#pd_id_G').val(pd_id);
});

$(document).on('click','#btn-diagnosis',function(e) {
    var data = $("#diagnosis_form").serialize();
    $.ajax({
        data: data,
        type: "post",
        url: "save.php",
        success: function(dataResult){
                var dataResult = JSON.parse(dataResult);
                if(dataResult.statusCode==200){
                    $('#PatientDiagnosis').modal('hide');
                    alert('Diagnosis Added Successfully !'); 
                    location.reload();						
                }
                else if(dataResult.statusCode==201){
                   alert(dataResult);
                }
        }
    });
});

$(document).on('click','.medicine',function(e) {
    var id=$(this).attr("data-id");
    var patient_name=$(this).attr("data-patient_name");
    var status=$(this).attr("data-status");
    var pd_id=$(this).attr("data-pd_id");
    var pdiag_id=$(this).attr("data-pdiag_id");
    $('#id_M').val(id);
    $('#patient_name_M').val(patient_name);
    $('#status_M').val(status);
    $('#pd_id_M').val(pd_id);
    $('#pdiag_id_M').val(pdiag_id);
});

$(document).on('click','#btn-medicine',function(e) {
    var data = $("#medicine_form").serialize();
    $.ajax({
        data: data,
        type: "post",
        url: "save.php",
        success: function(dataResult){
                var dataResult = JSON.parse(dataResult);
                if(dataResult.statusCode==200){
                    $('#PatientMedicine').modal('hide');
                    alert('Prescription Added Successfully !'); 
                    location.reload();						
                }
                else if(dataResult.statusCode==201){
                   alert(dataResult);
                }
        }
    });
});

$(document).on('click','.visit',function(e) {
    var id=$(this).attr("data-id");
    var patient_name=$(this).attr("data-patient_name");
    var status=$(this).attr("data-status");
    var pd_id=$(this).attr("data-pd_id");
    $('#id_vi').val(id);
    $('#patient_name_vi').val(patient_name);
    $('#status_vi').val(status);
    $('#pd_id_vi').val(pd_id);
});

$(document).on('click','#btn-visit',function(e) {
    var data = $("#visit_form").serialize();
    $.ajax({
        data: data,
        type: "post",
        url: "save.php",
        success: function(dataResult){
                var dataResult = JSON.parse(dataResult);
                if(dataResult.statusCode==200){
                    $('#ReasonForVisit').modal('hide');
                    alert('Data Added Successfully !'); 
                    location.reload();						
                }
                else if(dataResult.statusCode==201){
                   alert(dataResult);
                }
        }
    });
});

$(document).on('click','.symptomsEdit2',function(e) {
    var pd_id=$(this).attr("data-pd_id");
    var symptoms_title=$(this).attr("data-symptoms_title");
    var symptoms=$(this).attr("data-symptoms");
        
    $('#pd_id_sy').val(pd_id);
    $('#symptoms_title_sy').val(symptoms_title);
    $('#symptoms_sy').val(symptoms);
});

$(document).on('click','#SymptomsEdit',function(e) {
    var data = $("#symptoms_editform").serialize();
    $.ajax({
        data: data,
        type: "post",
        url: "save.php",
        success: function(dataResult){
                var dataResult = JSON.parse(dataResult);
                if(dataResult.statusCode==200){
                    $('#SymptomsEdit').modal('hide');
                    alert('Data updated successfully !'); 
                    location.reload();						
                }
                else if(dataResult.statusCode==201){
                   alert(dataResult);
                }
        }
    });
});



$(document).on("click", ".delete", function() { 
    var id=$(this).attr("data-id");
    $('#id_d').val(id);
    
});
$(document).on("click", "#delete", function() { 
    $.ajax({
        url: "save.php",
        type: "POST",
        cache: false,
        data:{
            type:3,
            id: $("#id_d").val()
        },
        success:              
        
        function(dataResult){
                $('#deleteEmployeeModal').modal('hide');
                $("#"+dataResult).remove();
        
        }
    });
});

$(document).on("click", "#delete_multiple", function() {
    var user = [];
    $(".user_checkbox:checked").each(function() {
        user.push($(this).data('user-id'));
    });
    if(user.length <=0) {
        alert("Please select records."); 
    } 
    else { 
        WRN_PROFILE_DELETE = "Are you sure you want to delete "+(user.length>1?"these":"this")+" row?";
        var checked = confirm(WRN_PROFILE_DELETE);
        if(checked == true) {
            var selected_values = user.join(",");
            console.log(selected_values);
            $.ajax({
                type: "POST",
                url: "save.php",
                cache:false,
                data:{
                    type: 4,						
                    id : selected_values
                },
                success: function(response) {
                    var ids = response.split(",");
                    for (var i=0; i < ids.length; i++ ) {	
                        $("#"+ids[i]).remove(); 
                    }	
                } 
            }); 
        }  
    } 
});

$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
    var checkbox = $('table tbody input[type="checkbox"]');
    $("#selectAll").click(function(){
        if(this.checked){
            checkbox.each(function(){
                this.checked = true;                        
            });
        } else{
            checkbox.each(function(){
                this.checked = false;                        
            });
        } 
    });
    checkbox.click(function(){
        if(!this.checked){
            $("#selectAll").prop("checked", false);
        }
    });
});