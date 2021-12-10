<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
	public function listing(){
		//$categories = Category::with(['parent'])->orderBy('created_at', 'DESC')->paginate(10);
		$categories = Category::all();
		$categories_json = [];
		foreach($categories as $category){
			if($category->parent){
				$categories_json[] = [
					'id' => $category->id,
					'name' => $category->name,
					'parent' => $category->parent->name,
					'created_at' => $category->created_at->format('d-m-Y'),
				];
			}
			else{
				$categories_json[] = [
					'id' => $category->id,
					'name' => $category->name,
					'parent' => NULL,
					'created_at' => $category->created_at->format('d-m-Y'),
				];
			}
		}

		return response()->json(
			$categories_json
		);
	}
	
	public function index(Request $request)
	{
        $category = Category::with(['parent'])->orderBy('created_at', 'DESC')->paginate(10);
        $parent = Category::getParent()->orderBy('name', 'ASC')->get();
        return view('categories.index', compact('category', 'parent'));
	}

	/*public function edit($id)
	{
	    $category = Category::find($id);
	    $parent = Category::getParent()->orderBy('name', 'ASC')->get();
	    return view('categories.edit', compact('category', 'parent'));
	}*/

	public function edit($id){
		$category = Category::find($id);
		$parent = $category->parent;
		$parent_name = NULL;
		if($parent != NULL){
			$parent_name = $parent->name;
		}
		$categories_json = [ 
			"category" => $category->toArray(),
			"parent" => $parent_name,
			"categories" => Category::all()->toArray(),
		];
		return response()->json(
			$categories_json
		);
	}

	/*public function update(Request $request, $id)
	{
	    $this->validate($request, [
	        'name' => 'required|string|max:50|unique:categories,name,' . $id
	    ]);

	    $category = Category::find($id);
	    $category->update([
	        'name' => $request->name,
	        'parent_id' => $request->parent_id
	    ]);
	    return redirect(route('category.index'))->with(['success' => 'Category Updated!']);
	}*/
	public function update(Request $request, $id)
	{
		if($request->ajax()){
			$category = Category::find($id);
			$category->update([
				'name' => $request->name,
				'parent_id' => $request->parent_id
			]);
			return response()->json([
				"message" => "listo"
			]);
		}
	}

	public function store(Request $request)
	{
		if($request->ajax()){
			$request->request->add(['slug' => $request->name]);
	    	$new_category = Category::create($request->except('_token'));
			$parent = NULL;
			if($new_category->parent != NULL){
				$parent = $new_category->parent->name;
			}
			return response()->json([
				"category" => $new_category->toArray(),
				"parent" => $parent
			]);
		}
	}

	/*public function destroy($id)
	{
	    $category = Category::withCount(['child', 'product'])->find($id);
	    if ($category->child_count == 0 && $category->product_count == 0) {
	        $category->delete();
	        return redirect(route('category.index'))->with(['success' => 'Category Removed!']);
	    }
	    return redirect(route('category.index'))->with(['error' => 'This Category Has Children Category!']);
	}*/

	public function destroy($id, Request $request){
		if($request->ajax()){
            $category = Category::find($id);
            $category->delete();
            return response()->json(["message"=>"deleted"]);
        }
	}

}
