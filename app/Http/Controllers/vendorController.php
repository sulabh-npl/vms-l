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

use function Complex\sec;

class vendorController extends Controller
{
    function index(Request $req)
    {
        if (!$req->session()->get('access')) {
            return redirect("/login");
        }
        $uid = $req->session()->get('uid');
        $staff = $uid . "_staff";
        $vi = $uid . "_visitors";
        if (Session::get('section_id') == 0) {
            $visitor = DB::table($vi)->get();
        } else {
            $visitor = DB::table($vi)->where("$vi.section_id", "=", Session::get('section_id'))->get();
        }
        // $resu = DB::statement('SELECT * FROM ' . $uid . "_staff");
        return view("index", ['visitors' => $visitor, "info" => $req->session()]);
    }
    function add_section()
    {
        if (!session()->get('access') || session()->get('per') != 0) {
            return redirect("/login?error=Login with permitted account");
        }
        if (isset($_GET['msg'])) {
            $msg = $_GET['msg'];
        } else {
            $msg = "";
        }
        return view('addSection', ['msg' => $msg]);
    }
    function add_section_post(Request $req)
    {
        if (!session()->get('access') || session()->get('per') != 0) {
            return redirect("/login?error=Login with permitted account");
        }
        DB::table(Session::get('uid') . "_sections")->insert([
            'name' => $req['name']
        ]);
        return redirect('/addSection?msg=Section added sucessfully');
    }

    function change_pass(Request $req)
    {
        if ($req['new'] != $req['r_new']) {
            return redirect('/change_pass')->with('msg', "Passwords Dont Match");
        }
        $re = DB::table($req->session()->get('uid') . "_staff")->select("*")->where('id', "=", $req->session()->get('id'))->first();
        if (!Hash::check($req['old'], $re->password)) {
            return redirect('/change_pass')->with('msg', "Incorrect Password");
        }
        $hash = Hash::make($req['new']);
        DB::update('update ' . $req->session()->get('uid') . '_staff set password = ? where id = ?', [$hash, $req->session()->get('id')]);
        return redirect('/change_pass')->with('msg', "Password Changed");
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
            // $req->session()->remove('uid');
            // $req->session()->remove('utitle');
            // $req->session()->remove('per');
            // $req->session()->remove('section_id');
            // $req->session()->remove('section');
            return redirect("/otp?error=Wrong-OTP");
        }
    }
    function logout(Request $req)
    {
        $req->session()->remove('access');
        $req->session()->remove('uid');
        $req->session()->remove('utitle');
        $req->session()->remove('per');
        $req->session()->remove('otp');
        $req->session()->remove('section_id');
        $req->session()->remove('section');
        return redirect("/login");
    }
    function manage_users(Request $req)
    {
        if ($req->session()->get('access') != true) {
            return redirect("/login");
        }
        if ($req->session()->get('section_id') == 0) {
            $id = $req->session()->get('uid');
            $staff = $id . "_staff";
            $sections = $id . "_sections";
            $re = DB::table($sections)->join($staff, "$sections.id", "=", "$staff.section_id")->select("$staff.*", "$sections.name as sec_name")->get();
            // $re = DB::select("SELECT $staff.name, $staff.email, $staff.phone, $staff.permission, $sections.name FROM $staff INNER JOIN $sections ON $staff.section_id=$sections.id");
        } else {
            return redirect("/login?error=login with permtted account");
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
        return view("new_user", ["sections_user" => $result, "msg" => $msg]);
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
        session(['uid' => $rslt->id, 'name' => $result[0]->name, 'utitle' => $rslt->name, 'per' => $result[0]->permission, "id" => $result[0]->id]);
        if ($result[0]->section_id == 0) {
            session(['section_id' => 0, 'section' => ""]);
            $sec = DB::table($id . "_sections")->select("*")->where('id', "!=", 0)->get();
            session(['sections', $sec]);
        } else {
            $result = $result[0];
            $rlt = DB::table($id . "_sections")->where('id', "=", $result->section_id)->first();
            // $rlt = DB::select("SELECT * FROM $id" . "_sections WHERE id = ?", ["$result[0]->section_id"]);
            session(['section_id' => $rlt->id, 'section' => "$rlt->name"]);
        }
        $details = [
            "otp" => rand(100000, 999999)
        ];
        session(['otp' => Hash::make($details['otp'])]);
        Mail::to($req['uname'])->send(new loginMail($details));
        return view('otp', ["msg" => ""]);
    }
    function otp_get()
    {
        if (Session::get('otp')) {
            return view('otp', ["msg" => $_GET['error']]);
        } else {
            return redirect('/login');
        }
    }
    function post_new_user(Request $req)
    {
        $hashed = bcrypt($req['password'], ['rounds' => 4]);
        // $hashed = Hash::make($req['password'], ['rounds' => 3]);
        DB::insert("insert into " . $req->session()->get('uid') . "_staff (name, phone, email, password, permission, section_id) VALUES (?,?,?,?,?,?)", [$req['name'], $req['phone'], $req['email'], $hashed, $req['per'], $req['section_id']]);
        return redirect('/new_user?msg=User added sucessfully');
    }
    function section()
    {
        $name = $_GET['name'];
        $uid = Session::get('uid');
        // $staff = $uid . "_staff";
        $vi = $uid . "_visitors";
        $visitor = DB::table($vi)->where($vi . ".section_name", "=", $name)->get();
        return view("section", ["visitors" => $visitor, "sec_name" => $name]);
    }
    function section_rename(Request $req)
    {
        $name = $_GET['name'];
        $uid = Session::get('uid');
        // $staff = $uid . "_staff";
        $vi = $uid . "_visitors";
        if ($req->act == "1") {
            DB::update('update ' . $vi . ' set section_name = ? where section_name = ?', [$req->re_name, $name]);
        }
        DB::update('update ' . $uid . '_sections set name = ? where name = ?', [$req->re_name, $name]);
        return redirect('/section?name=' . $req->re_name);
    }
    function section_del($name)
    {
        if (!Session::get('access')) {
            return redirect("/login");
        }
        $id = DB::table(Session::get('uid') . '_sections')->where('name', $name)->first();
        if ($id == null) {
            return "Don't Update URL";
        }
        $id = $id->id;
        DB::delete('DELETE FROM ' . Session::get('uid') . '_sections WHERE name = ?', [$name]);
        DB::update('update users set section_id = 1 where section_id = ?', [$id]);
        // DB::update('update ' .  . '_sections set name = ? where name = ?', [$req->re_name, $name]);
        return redirect('/');
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
    function user()
    {
        $v = DB::table(Session::get('uid') . '_staff')->where('id', '=', Session::get('id'))->first();
        return view("user", ["v" => $v]);
    }
    function visitor($id, Request $req)
    {
        if ($req->session()->get('access') == true) {
            $res = DB::select('select * from ' . $req->session()->get('uid') . '_visitors where id = ?', [$id]);
            return json_encode($res);
        } else {
            return "You are not permitted to view.";
        }
    }
    function visitor_edit(Request $req)
    {
        if ($req->session()->get('access') == true && $req->session()->get('per') != 2) {
            if ($req['doc_type'] != "Citizenship") {
                DB::update("update " . $req->session()->get('uid') . "_visitors set name = ?, date = ?, time= ?, doc_type = ?, doc_id = ?, issue_date = ?, exp_date = ?, father_name = ? where id = ?", [$req['name'], $req['date'], $req['time'], $req['doc_type'], $req['doc_id'], $req['issue_date'], $req['exp_date'], $req['fname'], $req['id']]);
            } else {
                DB::update("update " . $req->session()->get('uid') . "_visitors set name = ?, date = ?, time= ?, doc_type = ?, doc_id = ?, issue_date = ?, father_name = ? where id = ?", [$req['name'], $req['date'], $req['time'], "Citizenship", $req['doc_id'], $req['issue_date'], $req['fname'], $req['id']]);
            }
            return redirect('/');
        } else {
            return "You are not permitted to update.";
        }
    }
    function visitor_delete($id, Request $req)
    {
        if ($req->session()->get('access') == true && $req->session()->get('per') != 2) {
            DB::delete('delete from ' . $req->session()->get('uid') . '_visitors where id = ?', [$id]);
            return redirect("/");
        } else {
            return "You are not permitted to delete.";
        }
    }
    function view_self(Request $req)
    {
        if ($req->session()->get('access') == true) {
            $id = vendor::where('id', "=", $req->session()->get('uid'))->first();
            return view("self", ["d" => $id]);
        } else {
            return "You are not permitted to delete.";
        }
    }
}
