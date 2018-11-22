$(document).ready(function(){
    
    
    /**
     * Funciones para platillo agregar y quitar en la cantidad
     */
    $("button[name=btnMenosP]").click(function (){
        var nombretxt ="input[id=txtNumPlatillos"+($(this).val())+"]";
        var numPlatillos = $(nombretxt).val();
        if(numPlatillos!=0)
           numPlatillos -=1;  
           $(nombretxt).val(numPlatillos);
        });
        
            $("button[name=btnMasP]").click(function (){
        var nombretxt ="input[id=txtNumPlatillos"+($(this).val())+"]";
        var numPlatillos = $(nombretxt).val();
        numPlatillos = parseInt(numPlatillos);
           numPlatillos +=1;  
           $(nombretxt).val(numPlatillos);
        });
        
        /**************************************************************************/
        
        
        
        /**
        * Funciones para vino agregar y quitar en la cantidad
        */
       /**************COPAS***********************************/
    $("button[name=btnMenosCopa]").click(function (){
        
        
        var nombretxt ="input[id=txtNumCopas"+($(this).val())+"]";
        var numCopas = $(nombretxt).val();
        if(numCopas!=0)
           numCopas -=1;  
           $(nombretxt).val(numCopas);
        });
        
            $("button[name=btnMasCopa]").click(function (){
                
        var nombretxt ="input[id=txtNumCopas"+($(this).val())+"]";
        var numCopas = $(nombretxt).val();
        numCopas = parseInt(numCopas);
           numCopas +=1;  
           $(nombretxt).val(numCopas);
        });
        
        
        
        /************************BOTELLAS********************************/
        $("button[name=btnMenosBotella]").click(function (){
        
        
        var nombretxt ="input[id=txtNumBotellas"+($(this).val())+"]";
        var numCopas = $(nombretxt).val();
        if(numCopas!=0)
           numCopas -=1;  
           $(nombretxt).val(numCopas);
        });
        
            $("button[name=btnMasBotella]").click(function (){
                
        var nombretxt ="input[id=txtNumBotellas"+($(this).val())+"]";
        var numCopas = $(nombretxt).val();
        numCopas = parseInt(numCopas);
           numCopas +=1;  
           $(nombretxt).val(numCopas);
        });
        
        /**************************************************************************/
     
        /***************************Submit Guardar Platillo*************************/
        
        $("button[name=btnComandaPGuardar]").click(function (){
                    var idComandaP = $(this).val()+"|PlatilloGuardar";
                    $("#txtIDCOMANDA").val(idComandaP);
                        swal({   
		title: '¿Desea guardar la edición del platillo',   
		text: '',   
		type: 'warning',   
		showCancelButton: true,   
		confirmButtonText: 'Si',   
		cancelButtonText: 'No',   
		closeOnConfirm: false,   
		closeOnCancel: false },
            function(isConfirm){   
                    
			if (isConfirm) {   
                                        $("#form").submit();
                                    }
                                    else{
                                        swal('Operación cancelada', 
					'', 
				'error');   
                                    }            
            });
            });
            
            
        
        /********************Submit Guardad Vino*********************************/
        $("button[name=btnComandaVGuardar]").click(function (){
            
                    var idComandaP = $(this).val()+"|VinoGuardar";
                    $("#txtIDCOMANDA").val(idComandaP);
                        swal({   
		title: '¿Desea guardar la edición del vino',   
		text: '',   
		type: 'warning',   
		showCancelButton: true,   
		confirmButtonText: 'Si',   
		cancelButtonText: 'No',   
		closeOnConfirm: false,   
		closeOnCancel: false },
            function(isConfirm){   
                    
			if (isConfirm) {   
                                        $("#form").submit();
                                    }
                                    else{
                                        swal('Operación cancelada', 
					'', 
				'error');   
                                    }            
            });
            });
        
        
        /*****************Submit Borrar Platillo************************************/
            $("button[name=btnComandaP]").click(function (){
                    var idComandaP = $(this).val()+"|Platillo";
                    $("#txtIDCOMANDA").val(idComandaP);
                        swal({   
		title: '¿Desea cancelar el platillo?',   
		text: '',   
		type: 'warning',   
		showCancelButton: true,   
		confirmButtonText: 'Si',   
		cancelButtonText: 'No',   
		closeOnConfirm: false,   
		closeOnCancel: false },
            function(isConfirm){   
                    
			if (isConfirm) {   
                                        $("#form").submit();
                                    }
                                    else{
                                        swal('Operación cancelada', 
					'', 
				'error');   
                                    }            
            });
            });
        /*****************************************************************************/
        /****************Submit Platillo Listo**************************/
        $("button[name=btnComandaPListo]").click(function (){
                    var idComandaP = $(this).val()+"|PlatilloListo";
                    $("#txtIDCOMANDA").val(idComandaP);
                        swal({   
		title: '¿Marcar platillo como servido?',   
		text: '',   
		type: 'warning',   
		showCancelButton: true,   
		confirmButtonText: 'Si',   
		cancelButtonText: 'No',   
		closeOnConfirm: false,   
		closeOnCancel: false },
            function(isConfirm){   
                    
			if (isConfirm) {   
                                        $("#form").submit();
                                    }
                                    else{
                                        swal('Operación cancelada', 
					'', 
				'error');   
                                    }            
            });
            });
        
        /****************Submit Vino Listo**************************/
        $("button[name=btnComandaVListo]").click(function (){
                    var idComandaP = $(this).val()+"|VinoListo";
                    $("#txtIDCOMANDA").val(idComandaP);
                        swal({   
		title: '¿Marcar vino como servido?',   
		text: '',   
		type: 'warning',   
		showCancelButton: true,   
		confirmButtonText: 'Si',   
		cancelButtonText: 'No',   
		closeOnConfirm: false,   
		closeOnCancel: false },
            function(isConfirm){   
                    
			if (isConfirm) {   
                                        $("#form").submit();
                                    }
                                    else{
                                        swal('Operación cancelada', 
					'', 
				'error');   
                                    }            
            });
            });
        
        
        /**********************Submit Borrar Vino************************************/
        $("button[name=btnComandaV]").click(function (){
                    var idComandaP = $(this).val()+"|Vino";
                    $("#txtIDCOMANDA").val(idComandaP);
                        swal({   
		title: '¿Desea cancelar el vino?',   
		text: '',   
		type: 'warning',   
		showCancelButton: true,   
		confirmButtonText: 'Si',   
		cancelButtonText: 'No',   
		closeOnConfirm: false,   
		closeOnCancel: false },
            function(isConfirm){   
                    
			if (isConfirm) {   
                                        $("#form").submit();
                                    }
                                    else{
                                        swal('Operación cancelada', 
					'', 
				'error');   
                                    }            
            });
            });
        
    $("#form").submit(function (e){
       /*e.preventDefault();*/
       
       /*$(document).unbind('submit').submit();*/
    });
    });