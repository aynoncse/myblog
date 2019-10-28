<?php
	class Format{
		public function formatDate($date){
			return date('F j, Y, g:i a',strtotime($date));
		}
		public function textShorten($text, $limit = 500){
			$text = $text. " ";
			$text = substr($text, 0, $limit);
			$text = substr($text, 0, strrpos($text, ' '));
			$text = $text.".....";
			return $text;
		}
		public function validation($data){
			$data = trim($data);
			$data = stripcslashes($data);
			$data = htmlspecialchars($data);
			
			return $data;
		}
		public function title(){
			$title = $_SERVER['SCRIPT_FILENAME'];
			$title = basename($title, '.php');
			$title = str_replace('_', ' ', $title);
			if ($title == 'index') {
				$title = 'Home';
				return ucwords($title);
			}else{
				return ucwords($title);
			}
		}

	}
?>