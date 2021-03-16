<?php

class Usuario {

	private $idusuario;
	private $deslogin;
	private $dessenha;
	private $dtcadastro;

	public function getIdusuario(){

		return $this->idusuario;
	}

	public function setIdusuario($value){
		$this->idusuario = $value;
	}

	public function getDeslogin(){

		return $this->deslogin;
	}

	public function setDeslogin($value){
		$this->deslogin = $value;
	}
	
	public function getDessenha(){

		return $this->dessenha;
	}

	public function setDessenha($value){
		$this->dessenha = $value;
	}

	public function getDtcadastro(){

		return $this->dtcadastro;
	}

	public function setDtcadastro($value){
		$this->dtcadastro = $value;
	}

// A função loadByid foi feita para carregar um usuário só por vez
	public function loadByid($id){

		$sql = new Sql();
// A condição do Where esta declarado por referencia ":ID" a qual  será relacionada no array ao lado
		$results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(
			":ID"=>$id));

		if (count($results) > 0){

			$row = $results[0];
						
			$this->setIdusuario($row['idusuario']);
			$this->setDeslogin($row['deslogin']);
			$this->setDessenha($row['dessenha']);
			$this->setDtcadastro(new DateTime($row['dtcadastro']));

		}
	}

		public static function getList(){

		$sql = new Sql();
		return $sql->select("SELECT * FROM tb_usuarios ORDER BY idusuario;");
		
	}

	public static function search($login){

		$sql = new Sql();
// Da forma como esta sendo feito o cmd sql abaixo, evita o haqueamento por conta de algum malfeitor infiar um cmd dentro da nossa linha de sql utilizando o caracter aspas.
		return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin", array(':SEARCH'=>"%".$login."%" ));
	}

// Quando a função não for static como a de baixo, devemos utilizar a classe como por exemplo os seteres da vida....kkkk
	public function login($Login, $password){

		$sql = new Sql();
		// A condição do Where esta declarado por referencia ":ID" a qual  será relacionada no array ao lado
		$results = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :PASSWORD", array(":LOGIN"=>$Login, ":PASSWORD"=>$password));

		if (count($results) > 0){

			$row = $results[0];
						
			$this->setIdusuario($row['idusuario']);
			$this->setDeslogin($row['deslogin']);
			$this->setDessenha($row['dessenha']);
			$this->setDtcadastro(new DateTime($row['dtcadastro']));

		}
		 else {
			// Exceção é a classe base para todas as exceções de usuário
			// a classe exceção abaixo não funcionou
			throw new Exception("Login e/ou senha inválidos.");
			// echo "Login e/ou senha inválidos.";
		}
	}
// O metódo abaixo __toString é chamado de metódo mágico. Quando da-se um echo "no caso aqui o echo e realizado pelo json_enconde" no objeto, ao inves de ser mostrado a estrutura do objeto será executado o que estiver dentro deste metódo __toString. 
	
	public function __toString(){

		return json_encode(array(
			"idusuario"=>$this->getIdusuario(),
			"deslogin"=>$this->getDeslogin(),
			"dessenha"=>$this->getDessenha(),
			"dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
			// "dtcadastro"=>$this->getDtcadastro()
		));
	}
}
?>

