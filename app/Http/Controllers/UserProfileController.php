<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    public function showCreateProfileForm(){
         return view('artisan.create_user_profile');
    }

    public function showUpdateProfileForm(){
         return view('artisan.update_user_profile', ['user' => auth()->user()]);
    }

    public function create(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'business_name'  => 'nullable|string|max:255',
            'bio'            => 'nullable|string',
            'profile_image'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'state'          => 'required|string',
            'city'           => 'required|string',
            'whatsapp'       => 'nullable|regex:/^55[0-9]{10,11}$/',
            'instagram'      => 'nullable|regex:/^(https?:\/\/)?(www\.)?instagram\.com\/[A-Za-z0-9._]+\/?$|^@?[A-Za-z0-9._]+$/',
        ],
        [
            'state.required' => 'O campo estado é obrigatório.',
            'city.required' => 'O campo cidade é obrigatório.',
            'whatsapp.regex' => 'Digite um WhatsApp válido: 55DDDXXXXXXXX',
            'instagram.regex' => 'Digite um usuário válido do Instagram.',
        ]);

        $user->business_name = $request->business_name;
        $user->bio = $request->bio;
        $user->state = $request->state;
        $user->city = $request->city;

        if ($request->filled('whatsapp')) {
            $user->whatsapp = preg_replace('/\D/', '', $request->whatsapp);
        }

        if ($request->filled('instagram')) {
            $user->instagram = str_replace(['https://instagram.com/', 'https://www.instagram.com/', 'www.instagram.com/'], '', $request->instagram);
            $user->instagram = ltrim($instagram, '@');
        }

        if ($request->hasFile('profile_image')) {
             $fileName = time() . '.' . $request->profile_image->extension();

             $path = $request->profile_image->storeAs(
                'profile_images',
                $fileName,
                'public'
            );

             $user->profile_image = $path;
        }

        $user->save();

       return redirect()->route('painel.artesao')->with('success', 'Cadastro feito com sucesso.');
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'           => 'required|string|max:255',
            'business_name'  => 'nullable|string|max:255',
            'bio'            => 'nullable|string',
            'profile_image'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ],
        [
            'name.required' => 'O campo nome é obrigatório.',
        ]);

        $user->name = $request->name;
        $user->business_name = $request->business_name;
        $user->bio = $request->bio;

        if ($request->hasFile('profile_image')) {

            if ($user->profile_image && file_exists(storage_path('app/public/' . $user->profile_image))) {
                unlink(storage_path('app/public/' . $user->profile_image));
            }

             $fileName = time() . '.' . $request->profile_image->extension();

             $path = $request->profile_image->storeAs(
                'profile_images',
                $fileName,
                'public'
            );

             $user->profile_image = $path;
        }

        $user->save();

       return back()->with('success', 'Perfil atualizado com sucesso!');

    }

}