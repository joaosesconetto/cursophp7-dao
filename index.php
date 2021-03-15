<?php
// o PHP irá verificar se o arquivo já foi incluído e, em caso afirmativo, não o incluirá (solicitará) novamente.

// abaixo é meu teste, na passagem do programa por aqui
echo "Passo 1.1 no index.php - Verifica se o arquivo de configuração esta carregado e carrega se não estiver ==>"."<br>"."<br>";
require_once("config.php");
// Aqui eu atribui a uma nova váriavel "$sql" a minha classe Sql() criada no arquivo sql.php, por que não posso fazer ações diretamente naquela classe Sql(), por isso tenho que fazer por referencia, criando esta referencia como abaixo;

$sql = new Sql();

// abaixo é meu teste, na passagem do programa por aqui
echo "Passo 4.1 função Sql até este ponto esta vazia ". is_string($sql) . "<br>";
echo "Passo 4.2 Monta o SELECT e chama a função select: 'SELECT * FROM tb_usuarios' "."<br>"."<br>";	
$usuarios = $sql->select("SELECT * FROM tb_usuarios");


echo json_encode($usuarios);

?>