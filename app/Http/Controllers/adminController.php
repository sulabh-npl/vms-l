<?php

namespace App\Http\Controllers;

use App\Mail\loginMail;
use App\Models\admin_user;
use App\Models\vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class adminController extends Controller
{
    function index()
    {
        if (!Session::get('admin-access')) {
            return redirect("/admin/login");
        }
        return view('admin.admin');
    }
    function login()
    {
        if (isset($_GET['error'])) {
            $msg = $_GET['error'];
        } else {
            $msg = "";
        }
        return view('admin.login', ['msg' => $msg]);
    }
    function list()
    {
        if (!Session::get('admin-access')) {
            return redirect("/admin/login?error=You Must Login First");
        }
        $re = vendor::all();

        return view('admin.list', ["vendors" => $re]);
    }
    function logged(Request $req)
    {
        if (Hash::check($req['otp'], $req->session()->get('admin_otp'))) {
            session(['admin-access' => true]);
            return redirect("/admin");
        } else {
            $req->session()->flush();
            return redirect("/admin/login?error=Wrong-OTP");
        }
    }
    function vendor_login($id)
    {
        if (!Session::get('admin-access')) {
            return redirect("/admin/login?error=You Must Login First");
        }
        session(['uid' => $id, 'utitle' => vendor::where('id', $id)->first()->name, 'per' => 0, "section_id" => 0, 'access' => true, "section" => ""]);
        return redirect("/");
    }
    function otp(Request $req)
    {
        $re = admin_user::where('email', $req['email'])->first();
        if ($re == null) {
            return redirect('/admin/login?error=No user with email address ' . $req['email']);
        }
        if (!Hash::check($req['password'], $re->password)) {
            return redirect('/admin/login?error=Invalid Password');
        }
        $details = [
            "otp" => rand(100000, 999999)
        ];
        session(['admin_otp' => Hash::make($details['otp']), 'admin_per' => $re->permission]);
        Mail::to($req['email'])->send(new loginMail($details));
        return view('admin.otp');
    }
}
