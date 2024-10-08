<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserPhotos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class UserPhotoController extends Controller
{
    public function show() {
        $photoData = UserPhotos::select('*')->where('user_id', Auth::user()->id)->get();        
        return view('/dashboard', ['photoData' => $photoData]);
    }
    public function upload(Request $request, int $userId) {            
        $request->validate([
            'photos.*' => 'required|image|mimes:jpg,png,jpeg,webp'
        ]);         
        
        $currentUser = User::findOrFail($userId);
        $photoData = [];

        if($files = $request->file('photos')) {
            foreach($files as $key => $file) {                
                $extension = $file->getClientOriginalExtension();
                $filename = $key . time() . '.' . $extension;
                $path = 'uploads/photos';
                $file->move($path, $filename);
                
                $photoData[] = [
                    'user_id' => $userId,
                    'photo' => $path . '/' . $filename
                ];
            } //end foreach
            UserPhotos::insert($photoData);
            return redirect()->back()->with('status', 'Upload Successful!');
        } else {
            return redirect()->back()->with('nostatus', 'No photos Selected or something went wrong');
        }
        //end if
        
        
        
    } //end upload function

    public function delete(int $photoId) {
        $photo = UserPhotos::findOrFail($photoId);
        if (File::exists($photo->photo)) {
            File::delete($photo->photo);
        }
        $photo->delete();
        return redirect()->back()->with('status', 'Photo Deleted');
    }//end delete function


    public function createAlbum(int $userId) {
        $userPhotos = UserPhotos::all()->where('user_id', $userId);
        $userAlbum = User::select('album')->where('id', $userId)->pluck('album')->all();
        // dd($userAlbum);
        $userData = [
            'userPhotos' => $userPhotos,
            'userAlbum' => $userAlbum
        ];
        return view('userphotos/createalbum', ['userData' => $userData]);
    }

    public function saveAlbum(int $userId, Request $request) {         
        if($request->htmlContent) {
            $currentUser = User::find($userId); 
            $currentUser->album = $request->htmlContent;
            $currentUser->save();
        } else {
            return redirect()->back()->with('nostatus', 'No content to save');
        }
        
        return redirect('userphotos/createalbum/' . $userId)->with(['userAlbum' => $currentUser->album]);        
        // return redirect()->back()->with(['userAlbum' => $currentUser->album]);
    }
}
