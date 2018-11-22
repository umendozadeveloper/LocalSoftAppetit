                  function SesionCorrecta(){
                      var $dialog = $("<div></div>").html("Dar clic en continuar para ingresar al menú principal");
			             $dialog.dialog({
                    buttons: {
                        Cancelar: function() {$(this).dialog( "close" );$(this).dialog( "destroy" );},
                        Continuar: function(){window.location='PaginaPrincipal_Admin.php';}
                    },
                    title: "Inicio de Sesión correcto",
                    draggable: true,
                    show: "slide",
                    hide: "scale",
                    stack: false,
                    modal: true,
                    close: function (){window.location='Login.php';},
                    open: function() { $(this).dialog("open");}
                  });
              }
              
              
                                function SesionCorrectaMesero(){
                      var $dialog = $("<div></div>").html("Dar clic en continuar para ingresar al menú principal");
			             $dialog.dialog({
                    buttons: {
                        Cancelar: function() {$(this).dialog( "close" );$(this).dialog( "destroy" );},
                        Continuar: function(){window.location='PaginaPrincipal_Mesero.php';}
                    },
                    title: "Inicio de Sesión correcto",
                    draggable: true,
                    show: "slide",
                    hide: "scale",
                    stack: false,
                    modal: true,
                    close: function (){window.location='Login.php';},
                    open: function() { $(this).dialog("open");}
                  });
              }

                 
                 
                 function SesionIncorrecta(){
                      var $dialog = $("<div></div>").html("Datos incorrectos");
			             $dialog.dialog({
                   
                        buttons: {Cerrar: function() {$(this).dialog( "close" );$(this).dialog( "destroy" );}},
                    
                    title: "Inicio de Sesión incorrecto",
                    draggable: true,
                    show: "slide",
                    hide: "scale",
                    stack: false,
                    modal: true,
                    
                    close: function (){window.location='Login.php';},
                    open: function() { $(this).dialog("open");}
                  });
              }
              
                 
                 
                 function registroIncorrecto(){
                  var $dialog = $("<div></div>").html("Error en el registro, algún dato no tiene el formato correcto");
			             $dialog.dialog({
                    buttons: {Cerrar: function() {$(this).dialog( "close" );$(this).dialog( "destroy" );}},
                    title: "AVISO",
                    draggable: true,
                    show: "slide",
                    hide: "scale",
                    stack: false,
                    modal: true,
                    
                    open: function() { $(this).dialog("open");}
                  });
              }
              
              
              
                  function registroCorrecto(){
                  var $dialog = $("<div></div>").html("Registro Correcto");
			             $dialog.dialog({
                    buttons: {
                        Cerrar: function() {$(this).dialog( "close" );$(this).dialog( "destroy" );}
                    },
                    title: "AVISO",
                    draggable: true,
                    show: "slide",
                    hide: "scale",
                    stack: false,
                    modal: true,
                    
                    open: function() { $(this).dialog("open");}
                  });
              }
              
              
              function usuarioDuplicado(){
                  
                  var $dialog = $("<div></div>").html("El nombre de usuario ya existe favor de agregar otro nombre de usuario");
			             $dialog.dialog({
                    buttons: {Cerrar: function() {$(this).dialog( "close" );$(this).dialog( "destroy" );}},
                    title: "AVISO",
                    draggable: true,
                    show: "slide",
                    hide: "scale",
                    stack: false,
                    modal: true,
                    
                    open: function() { $(this).dialog("open");}
                  });
                  
              }
              
              
              function mesaDuplicada(){
                  
                  var $dialog = $("<div></div>").html("El número de mesa ya está registrado, favor de ingresar otro número");
			             $dialog.dialog({
                    buttons: {Cerrar: function() {$(this).dialog( "close" );$(this).dialog( "destroy" );}},
                    title: "AVISO",
                    draggable: true,
                    show: "slide",
                    hide: "scale",
                    stack: false,
                    modal: true,
                    
                    open: function() { $(this).dialog("open");}
                  });
                  
              }
              
              
              function SubMenuAgregadoCorrectamente(){
                      var $dialog = $("<div></div>").html("El submenú fue agregado correctamente");
			             $dialog.dialog({
                    buttons: {
                        Aceptar: function(){window.location='ConsultarSubMenus.php';}
                    },
                    title: "Inicio de Sesión correcto",
                    draggable: true,
                    show: "slide",
                    hide: "scale",
                    stack: false,
                    modal: true,
                    close: function (){window.location='ConsultarSubMenus.php';},
                    open: function() { $(this).dialog("open");}
                  });
              }
              
              
              
              function usuarioAlerta(){
                      var usuario = document.getElementById("idUsuario").innerHTML;
                  var $dialog = $("<div></div>").html("Usuario registrado con id = "+usuario);
			             $dialog.dialog({
                    buttons: {Cerrar: function() {$(this).dialog( "close" );$(this).dialog( "destroy" );}},
                    title: "AVISO",
                    draggable: true,
                    show: "slide",
                    hide: "scale",
                    stack: false,
                    modal: true,
                    
                    open: function() { $(this).dialog("open");}
                  });
              }
              
              
              function pacienteSinDeparatamento(){
                  var $dialog = $("<div></div>").html("El paciente no se encuentra vigente en ningún departamento");
			             $dialog.dialog({
                    buttons: {Cerrar: function() {$(this).dialog( "close" );$(this).dialog( "destroy" );}},
                    title: "AVISO",
                    draggable: true,
                    show: "slide",
                    hide: "scale",
                    stack: false,
                    modal: true,
                    
                    open: function() { $(this).dialog("open");}
                  });
              }
              
              function pacienteSinDeparatamentoD(){
                  var $dialog = $("<div></div>").html("El paciente no se encuentra vigente en ningún departamento por lo que no es posible registrar diagnóstico");
			             $dialog.dialog({
                    buttons: {Cerrar: function() {$(this).dialog( "close" );$(this).dialog( "destroy" );}},
                    title: "AVISO",
                    draggable: true,
                    show: "slide",
                    hide: "scale",
                    stack: false,
                    modal: true,
                    
                    open: function() { $(this).dialog("open");}
                  });
              }
              
              
              
              
              
              
              
              
              
              
              
              
                  function bajaCorrecta(){
                  var $dialog = $("<div></div>").html("Paciente dado de baja correctamente");
			             $dialog.dialog({
                    buttons: {
                        Cerrar: function() {$(this).dialog( "close" );$(this).dialog( "destroy" );}
                    },
                    title: "AVISO",
                    draggable: true,
                    show: "slide",
                    hide: "scale",
                    stack: false,
                    modal: true,
                    
                    open: function() { $(this).dialog("open");}
                  });
              }
              
              
              
                  function departamentoVigente(){
                      var departamento = document.getElementById("valorDepartamento").innerHTML;
                  var $dialog = $("<div></div>").html("El paciente se encuentra registrado en "+departamento+". Favor de darlo de baja para registrarlo en el departamento deseado");
			             $dialog.dialog({
                    buttons: {
                        Cerrar: function() {$(this).dialog( "close" );$(this).dialog( "destroy" );}
                    },
                    title: "AVISO",
                    draggable: true,
                    show: "slide",
                    hide: "scale",
                    stack: false,
                    modal: true,
                    
                    open: function() { $(this).dialog("open");}
                  });
              }
              
              
              function problemaAlta(){
                      var departamento = document.getElementById("valorDepartamento").innerHTML;
                  var $dialog = $("<div></div>").html("El paciente se encuentra registrado en "+departamento+". Favor de darlo de baja de dicho departamento para continuar y darlo de alta");
			             $dialog.dialog({
                    buttons: {
                        Cerrar: function() {$(this).dialog( "close" );$(this).dialog( "destroy" );}
                    },
                    title: "AVISO",
                    draggable: true,
                    show: "slide",
                    hide: "scale",
                    stack: false,
                    modal: true,
                    
                    open: function() { $(this).dialog("open");}
                  });
              }
              
              
                  function bajaImposible(){
                      
                  var departamento = document.getElementById("valorDepartamento").innerHTML;
                  var $dialog = $("<div></div>").html("No es posible dar de baja al paciente del departamento seleccionado debido a que se encuentra en: "+departamento+"");
			             $dialog.dialog({
                    buttons: {
                        Cerrar: function() {$(this).dialog( "close" );$(this).dialog( "destroy" );}
                    },
                    title: "AVISO",
                    draggable: true,
                    show: "slide",
                    hide: "scale",
                    stack: false,
                    modal: true,
                    
                    open: function() { $(this).dialog("open");}
                  });
              }
              
              
                 
              
              
                  function UsuarioInactivo(){
                      var $dialog = $("<div></div>").html("El usuario se encuentra inactivo");
			             $dialog.dialog({
                   
                        buttons: {Cerrar: function() {$(this).dialog( "close" );$(this).dialog( "destroy" );}},
                    
                    title: "Inicio de Sesión correcto",
                    draggable: true,
                    show: "slide",
                    hide: "scale",
                    stack: false,
                    modal: true,
                    
                    open: function() { $(this).dialog("open");}
                  });
              }
              
              
                 
              
              