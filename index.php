<?php
// o PHP irá verificar se o arquivo já foi incluído e, em caso afirmativo, não o incluirá (solicitará) novamente.

// abaixo é meu teste, na passagem do programa por aqui
// echo "Passo 1.1 no index.php - Verifica se o arquivo de configuração esta carregado e carrega se não estiver ==>"."<br>"."<br>";


require_once("config.php");
// Aqui eu atribui a uma nova váriavel "$sql" a minha classe Sql() criada no arquivo sql.php, por que não posso fazer ações diretamente naquela classe Sql(), por isso tenho que fazer por referencia, criando esta referencia como abaixo;

require_once("Passei_por_aqui.php");
$texto = "Passo 1.1 no index.php - Verifica se o arquivo de configuração esta carregado e carrega se não estiver ==>"."<br>"."<br>";
$msg = new Passei_por_aqui();
$msg->echoMsg($texto);

// carreta um usuário especifico
// $root = new Usuario();
// $root->loadbyId(1);
// echo $root;

// carrega uma lista de usuários
// Abaixo escrevemos um metódo estatico. Portanto não utilizamos o this. Funciona da forma statica ou como esta nos segundos comandos abaixo.
// $lista = Usuario::getList();
// echo json_encode($lista);

// carrega toda a tabela de usuários
// $usuarios = $sql->select("SELECT * FROM tb_usuarios");
// echo json_encode($usuarios);

// carrega uma lista de usuários buscando pelo login do usuário. Utilizando a condição like
// $search = Usuario::search("jo");
// echo json_encode($search);

// carrega um usuário usando o login e a senha
$usuario = new Usuario();
// utilizando o metódo login;
$usuario->login("joao", "999");
echo $usuario;
?>

