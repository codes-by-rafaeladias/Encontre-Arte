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
        ]);

        $user->business_name = $request->business_name;
        $user->bio = $request->bio;

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

       return redirect()->route('logout')->with('success', 'Cadastro feito com sucesso.');
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'           => 'required|string|max:255',
            'business_name'  => 'nullable|string|max:255',
            'bio'            => 'nullable|string',
            'profile_image'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
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