<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Rules\ValidPrice;

class ArtisanProductController extends Controller
{
    public function listProducts()
    {
        $user = auth()->user();
        
        $products = $user->products()->latest()->get();
        
        return view('artisan.products', compact('products'));
    }

    public function create(){
        return view('artisan.create_product');
    }

    public function store(Request $request){
        $user = auth()->user();
        $path = null;

        $request->validate([
            'name'        => 'required|string|max:200',
            'description' => 'nullable|string',
            'price'       => ['required', new ValidPrice],
            'category'    => 'nullable|string|max:100',
            'image_url' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ],
        [
            'name.required' => 'O nome do produto é obrigatório.',
            'price.required' => 'O preço do produto é obrigatório.',
            'image_url.required' => 'A imagem do produto é obrigatória.',
            'image_url.image' => 'O arquivo deve ser uma imagem válida.',
            'image_url.mimes' => 'A imagem deve ser do tipo: jpg, jpeg, png, webp.',
            'image_url.max' => 'A imagem não pode exceder 2MB.',
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
            'category'  => $request->category,
            'image_url' => $path,
        ]);

         return back()->with('success', 'Produto cadastrado com sucesso!');
    }

    public function showUpdateProductForm($id){
        $product = Product::findOrFail($id);

        return view('artisan.update_product', compact('product'));
    }

    public function update(Request $request, $id){
        $product = Product::findOrFail($id);

        $this->authorizeProduct($product);

        $request->validate([
            'name'        => 'required|string|max:200',
            'description' => 'nullable|string',
            'price'       => ['required', new ValidPrice],
            'category'    => 'nullable|string|max:100',
            'image_url' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ],
        [
            'name.required' => 'O nome do produto é obrigatório.',
            'price.required' => 'O preço do produto é obrigatório.',
        ]);

        if ($request->hasFile('image_url')) {
            $path = $request->file('image_url')->store('products', 'public');
            $product->image_url = $path;
        }

        $product->update([
            'name'        => $request->name,
            'description' => $request->description,
            'price' => str_replace(',', '.', $request->price),
            'category'  => $request->category,
        ]);

        return back()->with('success', 'Produto atualizado com sucesso!');
    }

    public function destroy($id)
    {

        $product = Product::findOrFail($id);
        
        $this->authorizeProduct($product);

        $product->delete();

        return redirect()
            ->route('artesao.produtos')
            ->with('success', 'Produto excluído com sucesso!');
    }

    private function authorizeProduct(Product $product)
    {
        if ($product->artisan_id !== Auth::id()) {
            abort(403, 'Acesso não autorizado.');
        }
    }
}
