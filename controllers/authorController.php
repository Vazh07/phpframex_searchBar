<?php
require_once('./models/authorModel.php');
require_once('logController.php');

class authorController extends Controller {

	public function index() {
		return $this->show('');
	}

	public function show($keyWord) {
		$athrs = authorModel::all();
		$authors = array_map(function($athr)use($keyWord){
			//$athr["books"] = bookModel::where('book_author_id',$athr["author_id"]);
			$isSearching = (isset($keyWord) &&  trim($keyWord) !== '');
			if(
				$isSearching &&
				(
					$athr["author_id"]==$keyWord ||
					$athr["author_name"]==$keyWord || 
					$athr["author_nationality"]==$keyWord ||
					$athr["author_fields"]==$keyWord
				)
			)return $athr;
				if(!$isSearching) return $athr;
				else return [];
			},$athrs);
		$suggestions = array_map(function($athr){return ["sugg_name"=>$athr["author_name"],"sugg_nationality"=>$athr["author_nationality"],"sugg_field"=>$athr["author_fields"]];},$athrs);
		return view('author/show',
			['authors'=>array_filter($authors),
			'suggestions'=> $suggestions,
			'title'=>'Author Detail']);
	}

	public function search(){
		return $this->show(Input::get('author_key_value'));
	}

}
?>