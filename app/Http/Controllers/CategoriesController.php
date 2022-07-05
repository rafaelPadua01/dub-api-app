<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;

class CategoriesController extends Controller 
{
	private $categories;

	public function __construct(Categories $categories) {
		$this->categories = $categories;
	}
	public function index() {
		$categories = Categories::all();
		return \Response::json($categories);
	}
	public function insert(Request $request) {
		$data = $request->all();
		$user_id = 1;
		try{
			 //Insere os dados na tabela 
			$insert_table = Categories::create([
				'category_name' => $request->name_category,	
			//	'id_user' => $user_id,
			]);	
			if($insert_table){
				$response = $data;
				return \Response::json($response);
			}
			return \Response::json($response);
		}
		catch(Exception $e) {
			$error = $e;
			return \Response::json($error);
		}	
	}
	public function update(Request $request, $id){
		$data = $request->all();
		
			try{
				$update_categories = Categories::where('id', $id)
					->update(['category_name' => $request->name_category]);
				return \Response::json($data);
			}
			catch(Exception $e) {
				$error = $e;
				return \Response::json($error);
			}
	}
	public function delete($id) {
		try{
			$delete_category = Categories::where('id', $id)
												->delete();
			return \Response::json($delete_category);
		}
		catch(Execption $e){
			$error = $e;
			return \Response::json($error);		
		}
	}


}
