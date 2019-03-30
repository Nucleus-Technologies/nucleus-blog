<?php

namespace App\Http\Controllers;

use App\Story;
use App\Writer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class WritersController extends Controller
{

    public function login ()
    {
        if (auth()->check()) {
            return redirect()->route('writer.dashboard');
        }
        
        return view('writer.login', ['page' => 'writer.login']);
    }
    
    public function register()
    {
        if (!auth()->check()) return view('writer.register');
        
        return redirect()->route('writer.dashboard');
    }
    
    public function store()
    {
        if (!auth()->check()) {
            $data = request()->except('_token');
            
            if (strlen($data['password']) < 8)
                return redirect()->back()->with('error', "Minimum length for password is 8 chars.");
            
            $data['password'] = Hash::make($data['password']);
            $data['active'] = 0;
            $writer = new Writer($data);
            
            if ($writer->save())
                return redirect()->route('login')->with('success', "Account created. Contact administrator to activate.");
            else
                return redirect()->route('register')->with('error', "Unable to create your account.");
        }
        
        return redirect()->route('writer.dashboard');
    }
    
    public function auth ()
    {
        if (auth()->check()) {
            return redirect()->route('writer.dashboard');
        }
        
        $credentials = request()->only('username', 'password');
        
        if (auth()->attempt($credentials)) {
            return redirect()->route('writer.dashboard');
        } else {
            return redirect()->route('login')->with('error', "Unable to login. Invalid credentials.");
        }
    }
    
    public function dashboard ()
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', "You must login to access this section.");
        }
    
        $stories = Story::all();
        $stories = $stories->where('writer', '=', auth()->user()->id);
        
        if (auth()->user()->active == 1)
            return view('writer.dashboard', ['writer' => auth()->user(), 'page' => 'writer.dashboard', 'stories' => $stories]);
        else {
            auth()->logout();
            return redirect()->route('login')->with('info', "Your account isn't active. Contact administrator.");
        }
    }
    
    public function profile ()
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', "You must login to access this section.");
        }
        
        $avatar = blank(auth()->user()->avatar) ? asset('assets/img/author.png') : Storage::url(auth()->user()->avatar);
        
        return view('writer.settings', ['writer' => auth()->user(), 'page' => 'writer.profile', 'avatar' => $avatar]);
    }
    
    public function update ()
    {
        $writer = Writer::find(auth()->user()->id);
        
        if (filled(request()->input())) {
            if (!$writer->update(request()->input())) {
                return redirect()->route('writer.profile')->with('error', "Unable to update your account.");
            }
        }
        
        if (filled(request()->allFiles())) {
            $avatar = request()->file('avatar');
            
            if (Storage::disk('local')->exists($writer->avatar)) {
                Storage::disk('local')->delete($writer->avatar);
            }
            
            $avatar = $avatar->storePublicly('public');
            
            if (!$writer->update(['avatar' => $avatar])) {
                return redirect()->route('writer.profile')->with('error', "Unable to update your avatar.");
            }
        }
        
        return redirect()->route('writer.profile')->with('success', "Account updated!");
    }
    
    public function password ()
    {
        
        if (filled(request()->input())) {
            $input = request()->validate([
                'current_password' => 'required|min:8',
                'new_password' => 'required|min:8',
                'retyped_password' => 'required|min:8'
            ]);
            
            $writer = auth()->user();
            
            if (Hash::check($input['current_password'], $writer->password)) {
                if ($input['new_password'] == $input['retyped_password']) {
                    if (!$writer->update(['password' => Hash::make($input['new_password'])])) {
                        return redirect()->route('writer.profile')->with('error', "Unable to update your password.");
                    } else {
                        return redirect()->route('writer.profile')->with('success', "Password updated!");
                    }
                } else {
                    return redirect()->route('writer.profile')->with('error', "Password doesn't match.");
                }
            } else {
                return redirect()->route('writer.profile')->with('error', "Incorrect password.");
            }
        }
        
    }
    
    public function logout ()
    {
        auth()->logout();
        
        return redirect()->route('home');
    }
}
