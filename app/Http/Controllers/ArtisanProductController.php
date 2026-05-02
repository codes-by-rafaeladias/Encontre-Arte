<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Technique;
use App\Models\Material;
use Illuminate\Support\Facades\Auth;
use App\Rules\ValidPrice;

class ArtisanProductController extends Controller
{
    public function listProducts()
    {
        $user = auth()->user();
        
        $products = $user->products()->latest()->paginate(9);
        
        return view('artisan.products', compact('products'));
    }

    public function create(){

        $categories = Category::orderBy('name')->get();
        $techniques = Technique::orderBy('name')->get();
        $materials = Material::orderBy('name')->get();

        return view('artisan.create_product',compact('categories', 'techniques', 'materials'));
    }

    public function store(Request $request){
        $user = auth()->user();
        $path = null;

        $request->validate([
            'name'        => 'required|string|max:200',
            'description' => 'nullable|string',
            'price'       => ['required', new ValidPrice],
            'category_id' => 'required|exists:categories,id',
            'technique_id' => 'required|exists:techniques,id',
            'image_url' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'required|in:em_estoque,indisponivel,sob_encomenda',
            'materials' => 'nullable|array',
            'materials.*' => 'exists:materials,id',
        ],
        [
            'name.required' => 'O nome do produto é obrigatório.',
            'price.required' => 'O preço do produto é obrigatório.',
            'category_id.required' => 'A categoria do produto é obrigatória',
            'technique_id.required' => 'A técnica usada na produção é obrigatória',
            'category_id.exists' => 'Selecione uma categoria válida',
            'technique_id.exists' => 'Selecione uma técnica válida',
            'image_url.required' => 'A imagem do produto é obrigatória.',
            'image_url.image' => 'O arquivo deve ser uma imagem válida.',
            'image_url.mimes' => 'A imagem deve ser do tipo: jpg, jpeg, png, webp.',
            'image_url.max' => 'A imagem não pode exceder 2MB.',
            'status.required' => 'O status é obrigatório',
            'status.in' => 'Selecione um status válido',
            'materials.*.exists' => 'Selecione materiais válidos',
        ]);

        if ($request->hasFile('image_url')) {
             $fileName = time() . '.' . $request->image_url->extension();

             $path = $request->image_url->storeAs(
                'products_images',
                $fileName,
                'public'
            );
        }

         $product = Product::create([
            'artisan_id'  => $user->id,
            'name'        => $request->name,
            'description' => $request->description,
            'price' => str_replace(',', '.', $request->price),
            'category_id' => $request->category_id,
            'technique_id' => $request->technique_id,
            'image_url' => $path,
            'status' => $request->status,
        ]);
        
        $product->materials()->sync($request->input('materials', []));

        return redirect()->route('artisan.products.index')->with('success', 'Produto cadastrado com sucesso!');
    }

    public function showUpdateProductForm($id){
        $product = Product::findOrFail($id);
        $categories = Category::orderBy('name')->get();
        $techniques = Technique::orderBy('name')->get();
        $materials = Material::orderBy('name')->get();

        return view('artisan.update_product', compact('product', 'categories', 'techniques', 'materials'));
    }

    public function update(Request $request, $id){
        $product = Product::findOrFail($id);

        $this->authorizeProduct($product);

        $request->validate([
            'name'        => 'required|string|max:200',
            'description' => 'nullable|string',
            'price'       => ['required', new ValidPrice],
            'category_id' => 'required|exists:categories,id',
            'technique_id' => 'required|exists:techniques,id',
            'image_url' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'required|in:em_estoque,indisponivel,sob_encomenda',
            'materials' => 'nullable|array',
            'materials.*' => 'exists:materials,id',
        ],
        [
            'name.required' => 'O nome do produto é obrigatório.',
            'price.required' => 'O preço do produto é obrigatório.',
            'category_id.required' => 'A categoria do produto é obrigatória',
            'technique_id.required' => 'A técnica usada na produção é obrigatória',
            'category_id.exists' => 'Selecione uma categoria válida',
            'technique_id.exists' => 'Selecione uma técnica válida',
            'status.required' => 'O status é obrigatório',
            'status.in' => 'Selecione um status válido',
            'materials.*.exists' => 'Selecione materiais válidos',
        ]);

        if ($request->hasFile('image_url')) {
            $path = $request->file('image_url')->store('products', 'public');
            $product->image_url = $path;
        }

        $product->update([
            'name'        => $request->name,
            'description' => $request->description,
            'price' => str_replace(',', '.', $request->price),
            'category_id' => $request->category_id,
            'technique_id' => $request->technique_id,
            'status' => $request->status,
        ]);

        $product->materials()->sync($request->input('materials', []));

        return redirect()->route('artisan.products.index')->with('success', 'Produto atualizado com sucesso!');
    }

    public function destroy($id)
    {

        $product = Product::findOrFail($id);
        
        $this->authorizeProduct($product);

        $product->delete();

        return redirect()
            ->route('artisan.products.index')
            ->with('success', 'Produto excluído com sucesso!');
    }

    private function authorizeProduct(Product $product)
    {
        if ($product->artisan_id !== Auth::id()) {
            abort(403, 'Acesso não autorizado.');
        }
    }
}
