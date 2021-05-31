$('#area').change(function(){
    var idArea = $(this).val();    
    if(idArea){
        $.ajax({
           type:"GET",
           url:"get-profesion?idArea="+idArea,
           success:function(res){ 
           console.log(res);              
            if(res){
                $("#profesion").empty();
                $("#profesion").append('<option>Seleccione profesion</option>');
                $.each(res,function(key){
                    $("#profesion").append('<option value="'+res[key].idProfesion+'">'+res[key].nombreProfesion+'</option>');
                });
           
            }else{
               $("#profesion").empty();
            }
           }
        });
    }else{
        $("#profesion").empty();
    }      
   });

    $('#profesion').on('change',function(){
    var idProfesion = $(this).val();    
    if(idProfesion){
        $.ajax({
           type:"GET",
           url:"get-especialidad?idProfesion="+idProfesion,
           success:function(res){  
            console.log(res);               
            if(res){
                $("#especialidad").empty();
                $("#especialidad").append('<option>Seleccione especialidad</option>');
                $.each(res,function(key,value){
                    $("#especialidad").append('<option value="'+res[key].idEspecialidad+'">'+res[key].nombreEspecialidad+'</option>');
                });
           
            }else{
               $("#especialidad").empty();
            }
           }
        });
    }else{
        $("#especialidad").empty();
    }
        
   });
  
