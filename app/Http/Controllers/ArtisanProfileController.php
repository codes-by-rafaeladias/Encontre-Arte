<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ArtisanProfileController extends Controller
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
            'whatsapp'       => 'nullable|regex:/^(\+55)?\d{10,11}$/|unique:users,whatsapp',
            'instagram'      => 'nullable|regex:/^(https?:\/\/)?(www\.)?instagram\.com\/[A-Za-z0-9._]+\/?$|^@?[A-Za-z0-9._]+$/|unique:users,instagram',
        ],
        [
            'state.required' => 'O campo estado é obrigatório.',
            'city.required' => 'O campo cidade é obrigatório.',
            'whatsapp.regex' => 'Digite um WhatsApp válido.',
            'instagram.regex' => 'Digite um usuário válido do Instagram.',
            'whatsapp.unique' => 'Digite um WhatsApp válido.',
            'instagram.unique' => 'Digite um usuário válido do Instagram.',
        ]);

        $user->business_name = $request->business_name;
        $user->bio = $request->bio;
        $user->state = $request->state;
        $user->city = $request->city;

        if ($request->filled('whatsapp')) {
            $number = preg_replace('/\D/', '', $request->whatsapp);

            if (!str_starts_with($number, '55')) {
                $number = '55' . $number;
            }
            
            $user->whatsapp = '+' . $number;
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

       return redirect()->route('artisan.home')->with('success', 'Cadastro feito com sucesso.');
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'           => 'required|string|max:255',
            'business_name'  => 'nullable|string|max:255',
            'bio'            => 'nullable|string',
            'profile_image'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'state'          => 'required|string',
            'city'           => 'required|string',
            'whatsapp' => ['nullable', 'regex:/^(\+55)?\d{10,11}$/', Rule::unique('users', 'whatsapp')->ignore($user->id),],
            'instagram' => ['nullable','regex:/^(https?:\/\/)?(www\.)?instagram\.com\/[A-Za-z0-9._]+\/?$|^@?[A-Za-z0-9._]+$/', Rule::unique('users', 'instagram')->ignore($user->id),],
        ],
        [
            'name.required' => 'O campo nome é obrigatório.',
            'state.required' => 'O campo estado é obrigatório.',
            'city.required' => 'O campo cidade é obrigatório.',
            'whatsapp.regex' => 'Digite um WhatsApp válido.',
            'instagram.regex' => 'Digite um usuário válido do Instagram.',
            'whatsapp.unique' => 'Digite um WhatsApp válido.',
            'instagram.unique' => 'Digite um usuário válido do Instagram.',
        ]);

        $user->name = $request->name;
        $user->business_name = $request->business_name;
        $user->bio = $request->bio;
        $user->state = $request->state;
        $user->city = $request->city;

        if ($request->filled('whatsapp')) {
            $number = preg_replace('/\D/', '', $request->whatsapp);

            if (!str_starts_with($number, '55')) {
                $number = '55' . $number;
            }
            
            $user->whatsapp = '+' . $number;
        }
        else{
            $user->whatsapp = $request->whatsapp;
        }

        if ($request->filled('instagram')) {
            $user->instagram = str_replace(['https://instagram.com/', 'https://www.instagram.com/', 'www.instagram.com/'], '', $request->instagram);
            $user->instagram = ltrim($user->instagram, '@');
        }
        else{
            $user->instagram = $request->instagram;
        }

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