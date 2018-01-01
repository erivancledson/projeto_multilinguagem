<?php
class Language {

	private $l;
	private $ini;
	private $bd;

	public function __construct() {
		//linguaguem que vem por padrão
		$this->l = 'pt-br';
        //clicou na linguam ele muda ela para a linguagem clicada
		if(!empty($_SESSION['lang']) && file_exists('lang/'.$_SESSION['lang'].'.ini')) {
			$this->l = $_SESSION['lang'];
		}
        //carrega o arquivo de linguagem
		$this->ini = parse_ini_file('lang/'.$this->l.'.ini');

		global $pdo;
		$sql = "SELECT * FROM lang WHERE lang = :lang";
		$sql = $pdo->prepare($sql);
		$sql->bindValue(":lang", $this->l);
		$sql->execute();

		if($sql->rowCount() > 0) {
			foreach($sql->fetchAll() as $item) {
				$this->bd[$item['nome']] = $item['valor'];
			}
		}
	}
     //retorna a linguam padrão que esta definida
	public function getLanguage() {
		return $this->l;
	}

	public function get($word, $return = false) {
		$text = $word;
         //verifica se a palavra tem no dicionario se não tiver retorna a propria palavra
		//verifica a do arquivo
		if(isset($this->ini[$word])) {
			$text = $this->ini[$word];
		}
		//verifica no banco de dados
		elseif(isset($this->bd[$word])) {
			$text = $this->bd[$word];
		}

		if($return) {
			//retorna o texto
			return $text;
		} else {
			echo $text;
		}

	}

















}