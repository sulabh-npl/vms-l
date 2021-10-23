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
use DataTables;

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
    function manage_users(Request $req)
    {
        if ($req->session()->get('section_id') == 0) {
            $id = $req->session()->get('uid');
            $staff = $id . "_staff";
            $sections = $id . "_sections";
            $re = DB::table($sections)->join($staff, "$sections.id", "=", "$staff.section_id")->select("$staff.*", "$sections.name as sec_name")->get();
            // $re = DB::select("SELECT $staff.name, $staff.email, $staff.phone, $staff.permission, $sections.name FROM $staff INNER JOIN $sections ON $staff.section_id=$sections.id");
        }
        // $re = DB::select("SELECT * FROM " . $req->session()->get('uid') . "_staff");
        return view("manage_users", ["users" => $re]);
    }
    function new_user(Request $req)
    {
        if (!session()->get('access') || session()->get('per') != 0) {
            return redirect("/login?error=Login with permitted account");
        }
        if (isset($_GET['msg'])) {
            $msg = $_GET['msg'];
        } else {
            $msg = "";
        }
        if (session()->get('section_id') == 0) {
            $result = DB::select('select * from ' . session()->get('uid') . "_sections");
        } else {
            $result = null;
        }
        return view("new_user", ["sections" => $result, "msg" => $msg]);
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
    function post_new_user(Request $req)
    {
        $hashed = bcrypt($req['password'], ['rounds' => 4]);
        // $hashed = Hash::make($req['password'], ['rounds' => 3]);
        DB::insert("insert into " . $req->session()->get('uid') . "_staff (name, phone, email, password, permission, section_id) VALUES (?,?,?,?,?,?)", [$req['name'], $req['phone'], $req['email'], $hashed, $req['per'], $req['section_id']]);
        return redirect('/new_user?msg=User added sucessfully');
    }
    function staff($id, Request $req)
    {
        if ($req->session()->get('access') == true && $req->session()->get('per') == 0) {
            $res = DB::select('select id,name,email,phone,permission from ' . $req->session()->get('uid') . '_staff where id = ?', [$id]);
            return json_encode($res);
        } else {
            return "You are not permitted to view.";
        }
    }
    function staff_delete($id, Request $req)
    {
        if ($req->session()->get('access') == true && $req->session()->get('per') == 0) {
            DB::delete('delete from ' . $req->session()->get('uid') . '_staff where id = ?', [$id]);
            return "sucess";
        } else {
            return "You are not permitted to delete.";
        }
    }
    function staff_update(Request $req)
    {
        if ($req->session()->get('access') == true && $req->session()->get('per') == 0) {
            if ($req['password'] != "") {
                $hashed = bcrypt($req['password'], ['rounds' => 4]);
                DB::update("update " . $req->session()->get('uid') . "_staff set name = ?, phone = ?, email = ?, password= ?, permission = ? where id = ?", [$req['name'], $req['phone'], $req['email'], $hashed, $req['per'], $req['id']]);
            } else {
                DB::update("update " . $req->session()->get('uid') . "_staff set name = ?, phone = ?, email =? , permission = ? where id = ?", [$req['name'], $req['phone'], $req['email'], $req['per'], $req['id']]);
            }
            return redirect('/manage_users');
        } else {
            return "You are not permitted to update.";
        }
    }
}
