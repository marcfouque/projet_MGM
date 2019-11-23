<?php
			session_start();
			session_destroy();
			echo 1;
			/*
			script de deconnexion, destruction de la session, le prochian sessiostart en initialisera une nouvelle au lieu de la recuperer
			retour
				- 1 si le script se finit
			*/


?>
