<?php
session_start();

function errorMessage() {
	if(isset($_SESSION['ErrorMsg'])) {
		$ErrorOutputMsg = "<div class=\"alert alert-danger\" role=\"alert\"  style=\"margin-top: 20px;\">";
		$ErrorOutputMsg .= htmlentities($_SESSION['ErrorMsg'], ENT_QUOTES);
		$ErrorOutputMsg .= "</div>";

		$_SESSION['ErrorMsg'] = null;

		return $ErrorOutputMsg;
	}
}

function successMessage() {
	if(isset($_SESSION['SuccessMsg'])) {
		$ErrorOutputMsg = "<div class=\"alert alert-success\" role=\"alert\" style=\"margin-top: 20px;\">";
		$ErrorOutputMsg .= htmlentities($_SESSION['SuccessMsg'], ENT_QUOTES);
		$ErrorOutputMsg .= "</div>";

		$_SESSION['SuccessMsg'] = null;

		return $ErrorOutputMsg;
	}
}



?>