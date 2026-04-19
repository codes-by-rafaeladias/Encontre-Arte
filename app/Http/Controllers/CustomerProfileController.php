<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CustomerProfileController extends Controller
{
    public function showCreateProfileForm(){
         return view('customer.create_user_profile');
    }

    public function showUpdateProfileForm(){
         return view('customer.update_user_profile', ['user' => auth()->user()]);
    }

    public function create(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'profile_image'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'state'          => 'required|string',
            'city'           => 'required|string',
        ],
        [
            'state.required' => 'O campo estado é obrigatório.',
            'city.required' => 'O campo cidade é obrigatório.',
        ]);

        $user->state = $request->state;
        $user->city = $request->city;

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

       return redirect()->route('customer.home')->with('success', 'Cadastro feito com sucesso.');
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'           => 'required|string|max:255',
            'profile_image'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'state'          => 'required|string',
            'city'           => 'required|string',
        ],
        [
            'name.required' => 'O campo nome é obrigatório.',
            'state.required' => 'O campo estado é obrigatório.',
            'city.required' => 'O campo cidade é obrigatório.',
        ]);

        $user->name = $request->name;
        $user->state = $request->state;
        $user->city = $request->city;

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