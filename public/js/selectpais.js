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
                $("#departamento").append('<option>Select</option>');
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
        $("#provincia").empty();
    }      
   });
    $('#departamento').on('change',function(){
    var id_departamento = $(this).val();    
    if(id_departamento){
        $.ajax({
           type:"GET",
           url:"get-Provincia?id_departamento="+id_departamento,
           success:function(res){               
            if(res){
                $("#provincia").empty();
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
   $('#departamento').on('change',function(){
    var id_departamento = $(this).val();    
    if(id_departamento){
        $.ajax({
           type:"GET",
           url:"get-Provincia?id_departamento="+id_departamento,
           success:function(res){               
            if(res){
                $("#provincia").empty();
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