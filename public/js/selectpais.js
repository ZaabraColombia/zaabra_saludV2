$('#pais').change(function(){
    var id_pais = $(this).val();    
    if(id_pais){
        $.ajax({
           type:"GET",
           url:"get-Departamento?id_pais="+id_pais,
           success:function(res){ 
           console.log(res);              
            if(res){
                $("#departamento").empty();
                $("#departamento").append('<option>Seleccione departamento</option>');
                $.each(res,function(key){
                    $("#departamento").append('<option value="'+res[key].id_departamento+'">'+res[key].nombre+'</option>');
                });
           
            }else{
               $("#departamento").empty();
            }
           }
        });
    }else{
        $("#departamento").empty();
    }      
   });

    $('#departamento').on('change',function(){
    var id_departamento = $(this).val();    
    if(id_departamento){
        $.ajax({
           type:"GET",
           url:"get-Provincia?id_departamento="+id_departamento,
           success:function(res){  
            console.log(res);               
            if(res){
                $("#provincia").empty();
                $("#provincia").append('<option>Seleccione provincia</option>');
                $.each(res,function(key,value){
                    $("#provincia").append('<option value="'+res[key].id_provincia+'">'+res[key].nombre+'</option>');
                });
           
            }else{
               $("#provincia").empty();
            }
           }
        });
    }else{
        $("#ciudad").empty();
    }
        
   });
  
   $('#provincia').on('change',function(){
    var id_provincia = $(this).val();    

    if(id_provincia){
        $.ajax({
           type:"GET",
           url:"get-Ciudad?id_provincia="+id_provincia,
           success:function(res){   
            console.log(res);               
            if(res){
                $("#ciudad").empty();
                $("#ciudad").append('<option>Seleccione ciudad</option>');
                $.each(res,function(key,value){
                    $("#ciudad").append('<option value="'+res[key].id_municipio+'">'+res[key].nombre+'</option>');
                });
           
            }else{
               $("#ciudad").empty();
            }
           }
        });
    }else{
        $("#ciudad").empty();
    }
        
   });