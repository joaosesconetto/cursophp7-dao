<?php

// A classe que estamos criando "Sql", ela herda a classe PDO que já tem todos os comandos que serão aproveitados como por exemplo: BeginTransaction, commit, construct, errorCode, errorInfo, exec (executa a instrução sql), getAttrbute, getAvailableDrivers (retorna a matriz de drivers PDO disponíveis, qyery (executa uma instrução SQL, retornando um conjunto de resultados como um objeto PDOStatement), prepare, rollBack, etc, etc e etc.
class Sql extends PDO {
// $conn é variável de retorno da minha conexão.
	private $conn;
// __construct é uma função extendida do PDO --> Cria uma instância PDO que representa uma conexão a um banco de dados. Este é o método construtor e que executa automaticamente.
	public function __construct(){

		$this->conn = new PDO("sqlsrv:Database=dbphp7;server=localhost\SQLEXPRESS;ConnectionPooling=0", "sa", "root");
		
		// abaixo é meu teste, na passagem do programa por aqui
		echo "Passo 3.1 conecta ao banco de dados SQL". is_string($this->conn) . "<br>"."<br>";	
	}
	
	// Os scripts de apenas Select passam pela função abaixo, mas não alterão a variável statment, ou seja o script do select não ganha mais nenhuma instrução, pois o parametro $parameters estará vazio sem nenhuma condição ou into.
	private function setParams($statment, $parameters = array()){
		// abaixo é meu teste, na passagem do programa por aqui
			echo "Passo 6.1 statment tem o cmd select ==> ". json_encode($statment) . "<br>";	
			echo "Passo 6.2 parameters(array), mostrada com json ==> ". json_encode($parameters) . "<br>";	
			echo "Passo 6.3 parameters(array), mostrada como string  ==> ". is_string($parameters) . "<br>"."<br>";	
		foreach ($parameters as $key => $value) {

			//  a linha abaixo esta montado o meu script do sql como por exemplo: (":PASSWORD", $password)
						
			// abaixo é meu teste, na passagem do programa por aqui
			echo "Passo 6.4 Monta a linha número : ". $n ." do SQL". $key . "<br>";	
			echo "Passo 6.5 Monta a linha número : ". $n ." do SQL". $value . "<br>";	
			// o $this abaixo é o mesmo que statment que é o metódo que foi criado
			$this->setParam($key, $value);	
			echo "Passo 6.9 statment : ". $this . "<br>"."<br>";	
		
		}

	}

	// Os scripts de apenas Select NÃO passam pela função abaixo.
	// No caso desta função, ela trata um dado por vez. Recebe uma chave e um valor por vez
	private function setParam($statment, $key, $value){
		
		// abaixo esta sendo criado um metódo que se chama "$statment"
		$statment->bindParam($key, $value);
		echo "Passo 6.6 Monta a linha número : ". $n ." do SQL". $key . "<br>";	
		echo "Passo 6.7 Monta a linha número : ". $n ." do SQL". $value . "<br>";	
		echo "Passo 6.8 Monta a linha número : ". $n ." do SQL". $statment . "<br>";	

		// abaixo é meu teste, na passagem do programa por aqui
		

	}

	// Os scripts de apenas Select passam pela função abaixo.
	// o primeiro parametro $rowQuery é especificamente a nossa query recebida aqui como parametro
	// o segundo parametro $params = array() são os dados que serão afetados pela nossa query.
	public function query($rowQuery, $params = array()){
		
		// abaixo é meu teste, na passagem do programa por aqui
		echo "Passo 5.1 Função query - Recebe o parametro rowQuery para completar com dados do script, mas no caso do select apenas não há mais dados a complementar ==> ".$rowQuery."<br>";	
		echo "Passo 5.2 Função query - Recebe o parametro params que é um array, para completar com dados do script, mas no caso do select apenas, não há mais dados a complementar. Portanto como vemos, o segundo parametro esta vazio, pois a função select que chama esta passou o um array vazio ==> " . is_string($params)."<br>";
		// como esta classe herda da classe PDO que já tem o cmd prepare, lá no PDO este cmd prepare já esta definido.
		// $RawQuery é todo o meu cmd sql que será executado.
		
		// abaixo é meu teste, na passagem do programa por aqui
		echo ("Passo 5.3 Prepara o comando 'prepare()' para afetar o Banco de Dados com a query a seguir ==> " . $rowQuery . "<br>");

		$stmt = $this->conn->prepare($rowQuery);
		
		// abaixo é meu teste, na passagem do programa por aqui
		echo ("Passo 5.4 Mostra o valor da variável stmt ==> " );
		var_dump($stmt)."<br>";
		echo "<br>". ("Passo 5.5 Mostra o valor da variável params, como já dizemos acima esta vazia ==> " . is_string($params) . "<br>"."<br>");

		$this->setParams($stmt, $params);
		
		$stmt->execute();
		// abaixo é meu teste, na passagem do programa por aqui
		echo "Passo 7.1 Afetou o Banco de Dados: ";
		var_dump($stmt)."<br>";

		return $stmt;
	}

// Os scripts de apenas Select passam pela função abaixo.
	public function select($rowQuery, $params = array()):array
	{

		$stmt = $this->query($rowQuery, $params);
		
		// abaixo é meu teste, na passagem do programa por aqui
		echo "<br>"."<br>"."Passo 8.1 Chama a função query para montar o sql e passa dois parametros : " . json_encode($stmt) . "<br>";	
		echo "Passo 8.2 Chama a função query para montar o sql e passa dois parametros : " . json_encode($params) . "<br>";	
		echo "Passo 8.3 Chama a função query para montar o sql e passa dois parametros : ". $rowQuery . " e " . "<br>" . is_string($this) . "<br>";	
		
		return $stmt->fetchAll(PDO::FETCH_ASSOC);


	}
}

?>
