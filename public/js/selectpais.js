$('#idpais').change(function(){
    var id_pais = $(this).val();    
    if(id_pais){
        $.ajax({
           type:"GET",
           url:"get-Departamento?id_pais="+id_pais,
           success:function(res){ 
           console.log(res);              
            if(res){
                $("#id_departamento").empty();
                $("#id_departamento").append('<option>Seleccione departamento</option>');
                $.each(res,function(key){
                    $("#id_departamento").append('<option value="'+res[key].id_departamento+'">'+res[key].nombre+'</option>');
                });
           
            }else{
               $("#id_departamento").empty();
            }
           }
        });
    }else{
        $("#id_departamento").empty();
    }      
   });

   
    $('#id_departamento').on('change',function(){
    var id_departamento = $(this).val();    
    if(id_departamento){
        $.ajax({
           type:"GET",
           url:"get-Provincia?id_departamento="+id_departamento,
           success:function(res){  
            console.log(res);               
            if(res){
                $("#id_provincia").empty();
                $("#id_provincia").append('<option>Seleccione provincia</option>');
                $.each(res,function(key,value){
                    $("#id_provincia").append('<option value="'+res[key].id_provincia+'">'+res[key].nombre+'</option>');
                });
           
            }else{
               $("#id_provincia").empty();
            }
           }
        });
    }else{
        $("#id_municipio").empty();
    }
        
   });
  
   $('#id_provincia').on('change',function(){
    var id_provincia = $(this).val();    

    if(id_provincia){
        $.ajax({
           type:"GET",
           url:"get-Ciudad?id_provincia="+id_provincia,
           success:function(res){   
            console.log(res);               
            if(res){
                $("#id_municipio").empty();
                $("#id_municipio").append('<option>Seleccione ciudad</option>');
                $.each(res,function(key,value){
                    $("#id_municipio").append('<option value="'+res[key].id_municipio+'">'+res[key].nombre+'</option>');
                });
           
            }else{
               $("#id_municipio").empty();
            }
           }
        });
    }else{
        $("#id_municipio").empty();
    }
        
   });