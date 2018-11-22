<?php

include_once '../Clases/Cliente.php';
include_once '../Clases/EstadoClientes.php';
include_once '../Clases/CorreoMarketing.php';
class N_OpcionesCliente {
    public $objCliente;
    public $errores;
    public $Proceso;




    public function __construct() {
        $this->objCliente = new Cliente();
        $this->errores = array();
    }
    
    public function Actualizar(){
        if(isset($_POST['Proceso'])){
            $this->Proceso = $_POST['Proceso'];
        }
        else{
            array_push($this->errores, "No se elegió acción");
        }
        
        if(isset($_POST['ID'])){
            $this->objCliente->ID = $_POST['ID'];
        }
        else{
            array_push($this->errores, "No se seleccionó cliente");
        }
        
        if($this->errores){
            foreach($this->errores as $e){
                echo $e."<br>";
            }
        }
        else{
            
            
            
            
            
            
            if($this->Proceso==1){
                $objCorreo = new CorreoMarketing();
                $this->objCliente->ConsultarPorID($this->objCliente->ID);
                if(!$objCorreo->EnviarCorreoBienvenidaVIP($this->objCliente->FolioRegistro, $this->objCliente->Correo)){
                    echo "0";
                    $this->Proceso = 0;
                }
                else{
                    echo "1";
                }
                echo "|*";
            }
            
            if($this->objCliente->ActualizarStatus($this->objCliente->ID, $this->Proceso)){
                
                $this->PintarTabla();
            }
        }
    }
    
    public function PintarTabla(){
        $objCliente = new Cliente();
        $clientes = $objCliente->ConsultarTodos();
        $objEstadoClientes = new EstadoClientes();
        
        ?>
            <table class="encabezadoTabla">
            <td class="tdEncabezadoTabla">
                <div><h4><center><label class="textoEncabezadoTabla">Listado de clientes</label></center></h4></div>
            </td>
        </table>
    
    <table   class="tablesorter table-bordered table-responsive tablaPaginadoCliente tablaConsulta" cellspacing="0" width="100%" >
        <thead>
            <tr>
                <th><div class="centrar"><label>Nombre</label></div></th>
                <th><div class="centrar"><label>Apellidos</label></div></th>
                <th><div class="centrar"><label>Teléfono</label></div></th>
                <th><div class="centrar"><label>E-mail</label></div></th>
                <th><div class="centrar"><label>Folio registro</label></div></th>
                <th><div class="centrar"><label>Status</label></div></th>
                <th><div class="centrar"><label>Interés por vinos</label></div></th>
                <th><div class="centrar"><label>Interés por alimentos</label></div></th>   
                <th><div class="centrar"><label>Interés por eventos</label></div></th>
                <th><div class="centrar "><label>Interés por cursos</label></div></th>   
                <th><div class="centrar "><label>Opciones</label></div></th>   
            </tr>
        </thead>
        
        <tbody>
            <?php 
            foreach($clientes as $c){
                $objEstadoClientes->ConsultarPorID($c->Status);
                echo "<tr>";
                echo "<td>$c->Nombre</td>";
                echo "<td>$c->Apellidos</td>";
                echo "<td>$c->Telefono</td>";
                echo "<td>$c->Correo</td>";
                echo "<td>$c->FolioRegistro</td>";
                echo "<td>";
                if($c->Status == 3 || $c->Status==2)
                {
                    if($c->Status == 2){
                        echo "<center><span style='color:green;' data-toggle='tooltip' data-placement='left' title='Usuario activo' class='glyphicon glyphicon-ok'></span><span data-toggle='tooltip' data-placement='left' title='Usuario activo' class='glyphicon glyphicon-user'></span></center>";
                    }
                    else{
                        echo "<center><span style='color:red;' data-toggle='tooltip' data-placement='left' title='Usuario inactivo' class='glyphicon glyphicon-remove'></span><span data-toggle='tooltip' data-placement='left' title='Usuario inactivo' class='glyphicon glyphicon-user'></span></center>";
                    }
                }
                else{
                    echo $objEstadoClientes->Estado;
                }
                echo "</td>";
                
                echo "<td>";
                if($c->PVino){
                    echo "<center><span class='glyphicon glyphicon-ok'></span></center>";
                }
                echo "</td>";
                
                echo "<td>";
                if($c->PAlimentos)
                {
                    echo "<center><span class='glyphicon glyphicon-ok'></span></center>";
                }
                echo "</td>";
                echo "<td>";
                if($c->PEventos){
                    echo "<center><span class='glyphicon glyphicon-ok'></span></center>";
                }
                echo "</td>";
                echo "<td>";
                if($c->PCursos)
                {
                    echo "<center><span class='glyphicon glyphicon-ok'></span></center>";
                }
                echo "</td>";
                
                echo "<td>";
                switch ($c->Status){
                    
                    case 0:
                        echo "<button onclick='ActualizarRegistro($c->ID,1);' name='btnRechazar'><span class='glyphicon glyphicon-message'></span> Enviar Correo</button>";
                        break;
                    
                    case 1:
                    case 2:
                    case 3:
                    if($c->Status == 2)
                    {
                        echo "<button class='btn btn-Bixa' disabled onclick='ActualizarRegistro($c->ID,2);'><span class='glyphicon glyphicon-ok'></span></button>";
                        echo "<button class='btn btn-Bixa' onclick='ActualizarRegistro($c->ID,3);' name='btnRechazar'><span class='glyphicon glyphicon-remove'></span></button>";
                    }
                    else if($c->Status==3){
                        echo "<button class='btn btn-Bixa' onclick='ActualizarRegistro($c->ID,2);'><span class='glyphicon glyphicon-ok'></span></button>";
                        echo "<button class='btn btn-Bixa' disabled onclick='ActualizarRegistro($c->ID,3);' name='btnRechazar'><span class='glyphicon glyphicon-remove'></span></button>";
                    }
                    else{
                        echo "<button class='btn btn-Bixa'  onclick='ActualizarRegistro($c->ID,2);'><span class='glyphicon glyphicon-ok'></span></button>";
                        echo "<button class='btn btn-Bixa'  onclick='ActualizarRegistro($c->ID,3);' name='btnRechazar'><span class='glyphicon glyphicon-remove'></span></button>";
                    }
                    
                    break;
                    
                }
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>  

<script>
        $('.tablaPaginadoCliente').DataTable( {
        "sScrollX": "100%",
        "sScrollXInner": "100%",
        "bScrollCollapse": true
        
    });

$('[data-toggle="tooltip"]').tooltip(); 

</script>

<?php
    }


    public function main(){
        $this->Actualizar();
    }
}

$objN_OpcionesCliente = new N_OpcionesCliente();
$objN_OpcionesCliente->main();

