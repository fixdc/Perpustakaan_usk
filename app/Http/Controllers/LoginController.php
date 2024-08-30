<?php
namespace App\Http\Controllers;

use App\Models\T_admin;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginform()
    {
        return view('loginpage');
    }
    public function showLoginformadmin()
    {
        return view('loginpageadmin');
    }









    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->only('f_username', 'f_password');

        // Add custom check for login
        if (Auth::guard('web')->attempt(['f_username'=>$request->f_username, 'password'=>$request->f_password])) { 

            


            $request->session()->regenerate();

            return redirect()->intended('/')->with('success', 'Login successful');
        }

        return back()->with('invalid', 'Login Failed');
    }



    


    
    public function loginadmin(Request $request): RedirectResponse
    {   
        $credentials = $request->only('f_username', 'f_password');

        $status = T_admin::firstWhere('f_username', $request->f_username);

        $admin = Auth::guard('admin')->user();

        if (Auth::guard('admin')->attempt(['f_username'=>$request->f_username, 'password'=>$request->f_password])) { 

            if($status->f_status != 'Aktif'){

                Auth::guard('admin')->logout();

                return redirect()->back()->with('nonactive', 'user belum aktif');
                
            }else{
                $request->session()->regenerate();
    
                return redirect()->intended('/')->with('success', 'Login successful');
            }

        }

        return back()->with('invalid', 'Login Failed');
    }




    

    public function logout()
    {
        $anggota = Auth::guard('web')->user();
        $admin = Auth::guard('admin')->user();

        if ($anggota) {
            Auth::guard('web')->logout();
        } 

        if ($admin) {
            Auth::guard('admin')->logout();
        } 

        return redirect('/');
    }
}
