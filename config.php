<?php
// spl_autoload_register - Registra a função dada como implementação __autoload ()
// o nome da classe que consta é identificado automaticamente pelo spl_autoload_register()
spl_autoload_register(function($class_name){
	// abaixo é meu teste, na passagem do programa por aqui
	
	 
	$filename2 = "Passei_por_aqui.php";
	if (file_exists(($filename2))){
		require_once($filename2);
	}
	
	$msg = new Passei_por_aqui();
	$texto = "Passo 2.1 no config.php - Faz o autoload da classe: " . $class_name . "<br>";
	$msg->echoMsg($texto);

	// deve ser concatenado o sufixo .php ao nome da classe para que esta classe ou arquivo seja carregado.
	$filename = "class".DIRECTORY_SEPARATOR.$class_name.".php";
	// abaixo é meu teste, na passagem do programa por aqui
		if (file_exists(($filename))){
		require_once($filename);
	}
	$texto = "Passo 2.2 no config.php - concatena a classe Sql com .php, e verifica se a o arq. de classe existe na pasta atual. Se existir abre o arquivo e começa a executa-lo (requere_once) ==> " . $filename ."<br>"."<br>";
	$msg->echoMsg($texto);
	
	
});

?>