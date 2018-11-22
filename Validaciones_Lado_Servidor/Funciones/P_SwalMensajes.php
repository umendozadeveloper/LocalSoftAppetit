<?php
if (session_id()==""){
     session_start();
}



function AddSwalMessage(&$msg, $msgtoadd, $sep = "<br>") 
{
	if (strval($msgtoadd) <> "") {
		if (strval($msg) <> "")
			$msg .= $sep;
		$msg .= $msgtoadd;
	}
}

// Message
	function getSwalMessage() {
		return @$_SESSION['mensaje_swal'];
	}

	function setSwalMessage($v) {
		AddSwalMessage($_SESSION['mensaje_swal'], $v);
	}

	function getSwalFailureMessage() {
		return @$_SESSION['mensaje_error_swal'];
	}

	function setSwalFailureMessage($v) {
		AddSwalMessage($_SESSION['mensaje_error_swal'], $v);
	}

	function getSwalSuccessMessage() {
		return @$_SESSION['mensaje_exito_swal'];
	}

	function setSwalSuccessMessage($v) {
		AddSwalMessage($_SESSION['mensaje_exito_swal'], $v);
	}

	function getSwalWarningMessage() {
		return @$_SESSION['mensaje_advertencia_swal'];
	}

	function setSwalWarningMessage($v) {
		AddSwalMessage($_SESSION['mensaje_advertencia_swal'], $v);
	}

	// Show message
	function ShowSwalMessage() 
        {
            
            $objEmpresa = new Empresa();
            $objEmpresa->ObtenerPorID(1);
            $html = "";

            // Message
            $sMessage = getSwalMessage();
            if ($sMessage <> "") 
            { // Message in Session, display
                    $html .= "<script>swal('". $sMessage . "');</script>";
                    $_SESSION['mensaje_swal'] = ""; // Clear message in Session
            }

    	    // Warning message
            $sWarningMessage = getSwalWarningMessage();
            if ($sWarningMessage <> "") 
            { // Message in Session, display
		//$html .= "<div class=\"alert alert-warning\">" . $sWarningMessage . "</div>";
                $html .= "<script>swal('Advertencia','". $sWarningMessage . "','warning');</script>";
		$_SESSION['mensaje_advertencia_swal'] = ""; // Clear message in Session
            }

		// Success message
		$sSuccessMessage = getSwalSuccessMessage();
		if ($sSuccessMessage <> "") 
                { // Message in Session, display
			$html .= "<script>swal('Correcto','". $sSuccessMessage . "','success');</script>";
			$_SESSION['mensaje_exito_swal'] = ""; // Clear message in Session
		}

		// Failure message
		$sErrorMessage = getSwalFailureMessage();
		
		if ($sErrorMessage <> "") 
                { // Message in Session, display
                    $html .= "<script>swal({title:'Error',text:'". $sErrorMessage . "',type:'error',confirmButtonColor: '$objEmpresa->ColorFondoBoton'});</script>";
                    $_SESSION['mensaje_error_swal'] = ""; // Clear message in Session
		}
		echo "<div>".$html . "</div>";
	}

?>