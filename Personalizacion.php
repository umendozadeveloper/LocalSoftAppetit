<?php
include_once './Clases/Empresa.php';
$objEmpresa = new Empresa();
$objEmpresa->ObtenerPorID(1);
$hoverBtnBixa = $objEmpresa->ColorTextoBoton;
$hoverBtnBixa = str_replace("rgb", "rgba", $hoverBtnBixa);
$hoverBtnBixa = str_replace(")", ",0.9)", $hoverBtnBixa);


$hoverFondoBtn = $objEmpresa->ColorFondoBoton; 
$hoverFondoBtn = str_replace("rgb", "rgba", $hoverFondoBtn);
$hoverFondoBtn = str_replace(")", ",.8)", $hoverFondoBtn);

$hoverBarra = $objEmpresa->ColorTextoBarra;
$hoverBarra = str_replace("rgb", "rgba", $hoverBarra);
$hoverBarra = str_replace(")", ",0.4)", $hoverBarra);

?>

<style>
    .menuSAdminVPM{
    background-color:<?php echo $objEmpresa->ColorFondoBarra;?>;
    border: 1px solid whitesmoke;
    box-shadow: 3px 3px 10px 3px #999;
    border-radius: 8px;
    text-align: center;
    margin-top: 5px;
    margin-bottom: 5px;
    height: 90px;
    color: white;    
}
    
    
    
    .tablaConsulta th{
    text-align: center;
    background-color: red;
}
    
    .BarraBixa{
        
        background-color: <?php echo $objEmpresa->ColorFondoBarra;?>;
        color: <?php echo $objEmpresa->ColorTextoBarra;?>;
    }
    
    
.btn-Bixa{
color: <?php echo $objEmpresa->ColorTextoBoton;?>;
background-color: <?php echo $objEmpresa->ColorFondoBoton;?>;
border-color: <?php echo $objEmpresa->ColorTextoBoton;?>;
font-weight: bold;

}
.EncabezadoTablaPersonalizada
{
    background-color: <?php echo $objEmpresa->ColorFondoBarra;?>;
    color: <?php echo $objEmpresa->ColorTextoBarra;?>;
    
}

.btn-Regresar{
    color: <?php echo $objEmpresa->ColorFondoBoton;?>;
background-color: <?php echo $objEmpresa->ColorTextoBoton;?>;
border-color: <?php echo $objEmpresa->ColorFondoBoton;?>;
font-weight: bold;
}

.btn-Regresar:hover, .btn-Regresar:focus{
    
    background-color: <?php echo $hoverBtnBixa;?>;
    color: <?php echo $hoverFondoBtn;?>;     
    border-color: <?php echo $hoverFondoBtn;?>;    
}


.btn-Bixa:hover,.btn-Bixa:focus{
    color: <?php echo $hoverBtnBixa;?>;
    background-color: <?php echo $hoverFondoBtn;?>;
    border-color: <?php echo $objEmpresa->ColorFondoBoton;?>;
}

                            
.pagination{
    display:inline-block;
    padding-left:0;
    margin:20px 0;
    border-radius:4px;
}

.pagination>li{
    display:inline;
}

.pagination>li>a,
.pagination>li>span{
    position:relative;
    float:left;
    padding:6px 12px;
    margin-left:-1px;
    line-height:1.42857143;
    color:<?php echo $objEmpresa->ColorFondoBoton;?>;
    text-decoration:none;
    background-color:<?php echo $objEmpresa->ColorTextoBoton;?>;
    border:1px solid #ddd;
}

.pagination>li:first-child>a,
.pagination>li:first-child>span{
    margin-left:0;
    border-top-left-radius:4px;
    border-bottom-left-radius:4px;
}

.pagination>li:last-child>a,
.pagination>li:last-child>span{
    border-top-right-radius:4px;
    border-bottom-right-radius:4px;
}

.pagination>li>a:hover,
.pagination>li>span:hover,
.pagination>li>a:focus,
.pagination>li>span:focus{
    color:#23527c;
    background-color:#eee;
    border-color:#ddd;
}


/*-----------UMR(PAGINADO)------------*/
.pagination>.active>a,
.pagination>.active>span,
.pagination>.active>a:hover,
.pagination>.active>span:hover,
.pagination>.active>a:focus,
.pagination>.active>span:focus{
    z-index:2;
    color:<?php echo $objEmpresa->ColorTextoBoton;?>;
    cursor:default;
    background-color:<?php echo $objEmpresa->ColorFondoBoton;?>;/*Color de la columna seleccionada (inferior derecha de la tabla)*/
    border-color: <?php echo $hoverBtnBixa;?>;;
}
/*------------------UMR(PAGINADO)--------------**/
.pagination>.disabled>span,
.pagination>.disabled>span:hover,
.pagination>.disabled>span:focus,
.pagination>.disabled>a,
.pagination>.disabled>a:hover,
.pagination>.disabled>a:focus{
    color: #ddd; /*Colores del texto botones siguiente y anterior del paginado*/
    cursor:not-allowed;
    background-color:#fff;
    border-color:#ddd;
}

.pagination-lg>li>a,
.pagination-lg>li>span{
    padding:10px 16px;
    font-size:18px;
}

.pagination-lg>li:first-child>a,
.pagination-lg>li:first-child>span{
    border-top-left-radius:6px;
    border-bottom-left-radius:6px;
}

.pagination-lg>li:last-child>a,
.pagination-lg>li:last-child>span{
    border-top-right-radius:6px;
    border-bottom-right-radius:6px;
}

.pagination-sm>li>a,
.pagination-sm>li>span{
    padding:5px 10px;
    font-size:12px;
}

.pagination-sm>li:first-child>a,
.pagination-sm>li:first-child>span{
    border-top-left-radius:3px;
    border-bottom-left-radius:3px;
}

.pagination-sm>li:last-child>a,
.pagination-sm>li:last-child>span{
    border-top-right-radius:3px;
    border-bottom-right-radius:3px;
}
                            


/*********************NAV INVERSE******************************/
/*COLOR DE FONDO DE TODO EL NAV INVERSE UMR*/
.navbar-inverse{
    background-color:<?php echo $objEmpresa->ColorFondoBarra; ?>;
    border-color:#080808;
}

    .dropdown-menu>li>a{
    display:block;
    padding:3px 20px;
    clear:both;
    font-weight:400;
    line-height:1.42857143;
    color:black;
    white-space:nowrap;
}


/*Cambia el color de letra seleccionada en un menú dropdown en pantalla completa----UMR*/
.dropdown-menu>li>a:hover,
.dropdown-menu>li>a:focus{
    color:#004A81;
    text-decoration:none;
    background-color:#f5f5f5;
}


/*titulo nav inverse UMR*/
.navbar-inverse .navbar-brand{
    color:<?php echo $objEmpresa->ColorTextoBarra; ?>;
}

/*UMR color de la letra del nav pantalla completa y corta */
.navbar-inverse .navbar-nav>li>a{
    color:<?php echo $objEmpresa->ColorTextoBarra;?>;
}

/*UMR color de la letra del nav pantalla completa y corta (hover y focus*/

.navbar-inverse .navbar-nav>li>a:hover,
.navbar-inverse .navbar-nav>li>a:focus{
    color: <?php echo $hoverBarra;?>;
    background-color:transparent;
}

/**UMR borde del nav inverse*/
.navbar-inverse .navbar-toggle{
    border-color:#333;
}

.navbar-inverse .navbar-toggle{
 background-color: <?php echo $hoverBarra;?>;   
}

/**----------UMR Hover en del nav inverse***/
.navbar-inverse .navbar-toggle:hover,
.navbar-inverse .navbar-toggle:focus{
    background-color:<?php echo $hoverBarra;?>;
}

/**UMR líneas del nav inverse***/
.navbar-inverse .navbar-toggle .icon-bar{
    background-color:white;
}


/**UMR Línea del nav al desglosarse*/
.navbar-inverse .navbar-collapse,.navbar-inverse .navbar-form{
    border-color:#333;
}


/**UMR Opciones del nav inverse a pantalla completa(hover) */
.navbar-inverse .navbar-nav>.open>a,
.navbar-inverse .navbar-nav>.open>a:hover,
.navbar-inverse .navbar-nav>.open>a:focus{
    color:<?php echo $objEmpresa->ColorTextoBarra;?>;
    background-color:<?php echo $hoverBarra;?>;
}



@media (max-width:767px){
    .navbar-inverse .navbar-nav .open .dropdown-menu>.dropdown-header{
        border-color:#080808;
    }
    
    .navbar-inverse .navbar-nav .open .dropdown-menu .divider{
        background-color:red;
    }
    
    /*inverse Color de las subopciones una opción en pantalla corta UMR*/
    .navbar-inverse .navbar-nav .open .dropdown-menu>li>a{
        color:<?php echo $objEmpresa->ColorTextoBarra;?>;
    }
    
    
    /*inverse Color de las subopciones una opción en pantalla corta UMR hover*/
    .navbar-inverse .navbar-nav .open .dropdown-menu>li>a:hover,
    .navbar-inverse .navbar-nav .open .dropdown-menu>li>a:focus{
        color:<?php echo $hoverBarra;?>;
        background-color:transparent;
    }
    
    .navbar-inverse .navbar-nav .open .dropdown-menu>.active>a,
    .navbar-inverse .navbar-nav .open .dropdown-menu>.active>a:hover,
    .navbar-inverse .navbar-nav .open .dropdown-menu>.active>a:focus{
        color:#fff;
        background-color:#080808;
    }
    
    .navbar-inverse .navbar-nav .open .dropdown-menu>.disabled>a,
    .navbar-inverse .navbar-nav .open .dropdown-menu>.disabled>a:hover,
    .navbar-inverse .navbar-nav .open .dropdown-menu>.disabled>a:focus{
        color:#444;
        background-color:transparent;
    }
}

.bootstrap-switch 
.bootstrap-switch-handle-off.bootstrap-switch-Bixa,
.bootstrap-switch .bootstrap-switch-handle-on.bootstrap-switch-Bixa
{color:#fff;background:<?php echo $objEmpresa->ColorFondoBoton;?>}




.sweet-alert button.confirm {
    color: <?php echo $objEmpresa->ColorTextoBoton;?>;
    background: <?php echo $objEmpresa->ColorFondoBoton;?>; /* Old browsers */
    background: -moz-linear-gradient(top,   <?php echo $objEmpresa->ColorFondoBoton;?> 0%,<?php echo $objEmpresa->ColorFondoBoton;?> 0%, <?php echo $objEmpresa->ColorFondoBoton;?> 0%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
    background: -webkit-linear-gradient(top,  <?php echo $objEmpresa->ColorFondoBoton;?> 0%,<?php echo $objEmpresa->ColorFondoBoton;?> 0%, <?php echo $objEmpresa->ColorFondoBoton;?> 0%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
    background: linear-gradient(to bottom,  <?php echo $objEmpresa->ColorFondoBoton;?> 0%,<?php echo $objEmpresa->ColorFondoBoton;?> 0%, <?php echo $objEmpresa->ColorFondoBoton;?> 0%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
    
}


   .sweet-alert button:focus {
      outline: none;
      box-shadow: 0 0 2px rgba(128, 179, 235, 0.5), inset 0 0 0 1px rgba(0, 0, 0, 0.05); }
    .sweet-alert button:hover {
      /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#a90329+0,8f0222+44,6d0019+100;Brown+Red+3D */
    background: <?php echo $hoverFondoBtn;?>; /* Old browsers */
    background: -moz-linear-gradient(top,  <?php echo $hoverFondoBtn;?> 0%, <?php echo $hoverFondoBtn;?> 44%, #6d0019 100%); /* FF3.6-15 */
    background: -webkit-linear-gradient(top,  <?php echo $hoverFondoBtn;?> 0%,<?php echo $hoverFondoBtn;?> 44%,#6d0019 100%); /* Chrome10-25,Safari5.1-6 */
    background: linear-gradient(to bottom,  <?php echo $hoverFondoBtn;?> 0%,<?php echo $hoverFondoBtn;?> 44%,#000 150%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
 }
    .sweet-alert button:active {
      background: <?php echo $hoverFondoBtn;?>; /* Old browsers */
    background: <?php echo $hoverFondoBtn;?>; /* Old browsers */
    background: -moz-linear-gradient(top,  <?php echo $hoverFondoBtn;?> 0%, <?php echo $hoverFondoBtn;?> 44%, #6d0019 300%); /* FF3.6-15 */
    background: -webkit-linear-gradient(top,  <?php echo $hoverFondoBtn;?> 0%,<?php echo $hoverFondoBtn;?> 44%,#6d0019 300%); /* Chrome10-25,Safari5.1-6 */
    background: linear-gradient(to bottom,  <?php echo $hoverFondoBtn;?> 0%,<?php echo $hoverFondoBtn;?> 44%,#000 300%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
    }
    
    
    .sweet-alert button.cancel {
      background-color: <?php echo $objEmpresa->ColorTextoBoton; ?>;
      color: <?php echo $objEmpresa->ColorFondoBoton; ?>;
    }
    .sweet-alert button.cancel:hover {
      
      color: <?php echo $objEmpresa->ColorFondoBoton; ?>;
      background: <?php echo $hoverBtnBixa;?>; /* Old browsers */
        background: -moz-linear-gradient(top,  <?php echo $hoverBtnBixa;?> 0%, <?php echo $hoverBtnBixa;?> 44%, #6d0019 300%); /* FF3.6-15 */
        background: -webkit-linear-gradient(top,  <?php echo $hoverBtnBixa;?> 0%,<?php echo $hoverBtnBixa;?> 44%,#6d0019 300%); /* Chrome10-25,Safari5.1-6 */
        background: linear-gradient(to bottom,  <?php echo $hoverBtnBixa;?> 0%,<?php echo $hoverBtnBixa;?> 44%,#000 300%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
    }
      
                            
</style>


