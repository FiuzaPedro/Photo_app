<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserPhotos;
use Illuminate\Http\Request;

class UserPhotoController extends Controller
{
    public function show() {
        $photoData = UserPhotos::select('photo')->get()->pluck('photo');
        return view('/dashboard', ['photoData' => $photoData]);
    }
    public function upload(Request $request, int $userId) {            
        $request->validate([
            'photos.*' => 'required|image|mimes:jpg,png,jpeg,webp'
        ]);         
        
        $currentUser = User::findOrFail($userId);
        $photoData = [];

        if($files = $request->file('photos')) {
            foreach($files as $file) {                
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $path = 'uploads/photos';
                $file->move($path, $filename);
                
                $photoData[] = [
                    'user_id' => $userId,
                    'photo' => $path . $filename
                ];
            } //end foreach
            UserPhotos::insert($photoData);
            return redirect()->back()->with('status', 'Upload Successful!');
        } else {
            return redirect()->back()->with('nostatus', 'No photos Selected or something went wrong');
        }
        //end if
        
        
        
    }
}
