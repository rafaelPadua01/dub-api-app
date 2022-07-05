<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;

class ProductsController extends Controller
{
  	 private $products;

	public function __construct(Products $products){
		$this->products = $products;
	}
	public function index(){
		//Retorna para vuetify todos os produtos
		//faz um join nas categorias a partir da id_category salva nos produtos
		//e seleciona a coluna de nomes para cada produto correspondente a esta id
		$products = Products::join('categories', 'categories.id', '=', 'products.category_id')
			->get(['products.*', 'categories.category_name']);
		$response = $products;
		return \Response::json($response);
	}
	public function create(Request $request){
		//recebe os dados vindos da request 
		//armazena em data 
		$data = $request->all();
		
		//Armazena a imagem 
		$product_image = $request->file('product_image');
	//	$image_name = $product_image->getClientOriginalName();
		
		//Recebe usuario que está na sessão 
		$auth_user = 1;  //1 é ficticio
		
		//tenta inserir os dados e cria um tratamento para os error
		try{
				//Insere os dados
				$insert_table = Products::create([
					'product_name' => $request->product_name,
					'category_id' => $request->category_id,
					//'user_id' => $auth_user,
					'product_image' => $request->file('product_image')->getClientOriginalName(),
					'product_price' => $request->product_price,	
					'description_product' => $request->description_product,
					'product_quantity' => $request->product_quantity,
				]);
			//Verifica se insert retorna true
			if($insert_table){
				$path = Storage::putFileAs('/public/products/'.$request->product_name, $product_image, $product_image->getClientOriginalName());
				$response =$data;
				return \Response::json($response);
			}
		
			
		}
		//Tratamento de excessão de erros
		catch(Exception $e){
			$error = $e;
			return \Response::json($error);
		} 
		
	}
	public function read($id){
		$categorie_id = $id;
		try{
			$select_products = Products::where('category_id', '=', $categorie_id)->get();
			return \Response::json($select_products);
									
		}
		catch(Exception $e){
			$error = $e;
			return \Response::json($error);
		}
	}
	public function update(Request $request, $id)
	{
		$id_product = $id;
		$data = $request->all();
		$product = Products::findOrFail($id);
		//dd($product->product_name);

		try{
			$remove_directory = Storage::deleteDirectory('/public/products/'.$product->product_name);
			
		//	$rename_directory = Storage::move('/public/products/'.$product->product_name, 'public/products/'.$request->product_name);
			if($remove_directory){
					$new_directory  = Storage::putFileAs('/public/products/'.$request->product_name, $request->file('product_image'), $request->file('product_image')->getClientOriginalName());
					$update_table = Products::where('id', '=', $id)
										->update($data);
					$update_table_img = Products::where('id', '=', $id)
											->update(['product_image' => $request->file('product_image')->getClientOriginalName()]);
					return \Response::json($data);
				}
				else 
				{
					return \Response::json('Não foi possível substituir o aquivo');
				}
			
			
		} 
		catch(Exception $e){
			$error = $e;
			return \Response::json($error);
		}
		
	}
	public function delete($id){
		$delete_product = Products::findOrFail($id);
		try{
			$remove_directory = Storage::deleteDirectory('/public/products/'.$delete_product->product_name);
			if($remove_directory){
				$remove_product = Products::where('id', '=', $id)
										->delete();
				return \Response::json($delete_product);
			}
			
		}
		catch(Exception $e){
			$error = $e;
			return \Response::json($error);	
		}
		//dd($delete);
	}
}

