<?php

namespace App\Http\Controllers;

use App\Mail\loginMail;
use App\Models\vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class vendorController extends Controller
{
    function index(Request $req)
    {
        if (!$req->session()->get('access')) {
            return redirect("/login");
        }
        $uid = $req->session()->get('uid');
        $result = DB::select("SELECT * FROM $uid" . "_visitors");
        $resu = DB::statement('SELECT * FROM ' . $uid . "_staff");
        return view("index", ['visitors' => $result, 'staffs' => $resu, "info" => $req->session()]);
    }
    function login(Request $req)
    {
        if (isset($_GET['error'])) {
            $msg = $_GET['error'];
        } else {
            $msg = "";
        }
        $result = vendor::all();
        return view('login', ['msg' => $msg, 'val' => $result]);
    }
    function logged(Request $req)
    {
        if (Hash::check($req['otp'], $req->session()->get('otp'))) {
            session(['access' => true]);
            return redirect("/");
        } else {
            $req->session()->flush();
            return redirect("/login?error=Wrong-OTP");
        }
    }
    function logout(Request $req)
    {
        $req->session()->flush();
        return redirect("/login");
    }
    function otp(Request $req)
    {
        $rslt = vendor::where('name', $req['n'])->first();
        if ($rslt == null) {
            return redirect("/login?error=Not a valid company");
        }
        setcookie('loc', $req['n'], time() + 3600 * 24 * 365);
        $id = $rslt->id;
        $result = DB::select('select * from ' . $id . '_staff where email = "' . $req['uname'] . '"');
        if ($result == null) {
            return redirect("/login?error=Invalid User");
        }
        if (!Hash::check($req['password'], $result[0]->password)) {
            return redirect("/login?error=Wrong Password");
        }
        session(['uid' => $rslt->id, 'utitle' => $rslt->name, 'per' => $result[0]->permission]);
        if ($result[0]->section_id == 0) {
            session(['section_id' => 0, 'section' => ""]);
        } else {
            $rlt = DB::select("SELECT * FROM $id" . "_sections WHERE id = ?", [$result[0]->section_id]);
            session(['section_id' => $rlt[0]->id, 'section' => "$rlt[0]->name"]);
        }
        $details = [
            "otp" => rand(100000, 999999)
        ];
        session(['otp' => Hash::make($details['otp'])]);
        Mail::to($req['uname'])->send(new loginMail($details));
        return view('otp');
    }
}
