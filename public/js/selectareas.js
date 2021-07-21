$('#idarea').change(function(){
    var idArea = $(this).val();    
    if(idArea){
        $.ajax({
           type:"GET",
           url:"get-profesion?idArea="+idArea,
           success:function(res){ 
           console.log(res);              
            if(res){
                $("#idprofesion").empty();
                $("#idprofesion").append('<option>Seleccione profesión</option>');
                $.each(res,function(key){
                    $("#idprofesion").append('<option value="'+res[key].idProfesion+'">'+res[key].nombreProfesion+'</option>');
                });
            }else{
               $("#idprofesion").empty();
            }
           }
        });
    }else{
        $("#idprofesion").empty();
    }      
   });


    $('#idprofesion').on('change',function(){
    var idProfesion = $(this).val();    
    if(idProfesion){
        $.ajax({
           type:"GET",
           url:"get-especialidad?idProfesion="+idProfesion,
           success:function(res){  
            console.log(res);               
            if(res){
                $("#idespecialidad").empty();
                $("#idespecialidad").append('<option>Seleccione especialidad</option>');
                $.each(res,function(key,value){
                    $("#idespecialidad").append('<option value="'+res[key].idEspecialidad+'">'+res[key].nombreEspecialidad+'</option>');
                });
            }else{
               $("#idespecialidad").empty();
            }
           }
        });
    }else{
        $("#idespecialidad").empty();
    }
        
   });
  
