<?php

if (session_id()==""){
     session_start();
 }

function AddMessage(&$msg, $msgtoadd, $sep = "<br>") 
{
	if (strval($msgtoadd) <> "") {
		if (strval($msg) <> "")
			$msg .= $sep;
		$msg .= $msgtoadd;
	}
}

// Message
	function getMessage() {
		return @$_SESSION['mensaje'];
	}

	function setMessage($v) {
		AddMessage($_SESSION['mensaje'], $v);
	}

	function getFailureMessage() {
		return @$_SESSION['mensaje_error'];
	}

	function setFailureMessage($v) {
		AddMessage($_SESSION['mensaje_error'], $v);
	}

	function getSuccessMessage() {
		return @$_SESSION['mensaje_exito'];
	}

	function setSuccessMessage($v) {
		AddMessage($_SESSION['mensaje_exito'], $v);
	}

	function getWarningMessage() {
		return @$_SESSION['mensaje_advertencia'];
	}

	function setWarningMessage($v) {
		AddMessage($_SESSION['mensaje_advertencia'], $v);
	}

	// Show message
	function ShowMessage() 
        {
            $html = "";

            // Message
            $sMessage = getMessage();
            if ($sMessage <> "") 
            { // Message in Session, display
                    $html .= "<div class=\"alert alert-info\">" . $sMessage . "</div>";
                    $_SESSION['mensaje'] = ""; // Clear message in Session
            }

    	    // Warning message
            $sWarningMessage = getWarningMessage();
            if ($sWarningMessage <> "") 
            { // Message in Session, display
		$html .= "<div class=\"alert alert-warning\">" . $sWarningMessage . "</div>";
		$_SESSION['mensaje_advertencia'] = ""; // Clear message in Session
            }

		// Success message
		$sSuccessMessage = getSuccessMessage();
		if ($sSuccessMessage <> "") 
                { // Message in Session, display
			$html .= "<div class=\"alert alert-success\">" . $sSuccessMessage . "</div>";
			$_SESSION['mensaje_exito'] = ""; // Clear message in Session
		}

		// Failure message
		$sErrorMessage = getFailureMessage();
		
		if ($sErrorMessage <> "") 
                { // Message in Session, display
                    $html .= "<div class=\"alert alert-danger\">" . $sErrorMessage . "</div>";
                    $_SESSION['mensaje_error'] = ""; // Clear message in Session
		}
		echo "<div>".$html . "</div>";
	}

?>