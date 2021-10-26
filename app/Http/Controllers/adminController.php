<?php

namespace App\Http\Controllers;

use App\Mail\loginMail;
use App\Models\admin_user;
use App\Models\vendor;
use Facade\FlareClient\Stacktrace\File;
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
    function add_vendor()
    {
        if (!Session::get('admin-access')) {
            return redirect("/admin/login");
        }
        if (Session::get('admin-per') != 0) {
            return redirect("/admin/login?error=Login with permitted account");
        }
        if (isset($_GET['msg'])) {
            $msg = $_GET['msg'];
        } else {
            $msg = "";
        }
        return view('admin.add_vendor', ['msg' => $msg]);
    }
    function add_vendor_post(Request $req)
    {
        if (!Session::get('admin-access')) {
            return redirect("/admin/login");
        }
        if (Session::get('admin-per') != 0) {
            return redirect("/admin/login?error=Login with permitted account");
        }
        DB::table('vendors')->insert([
            "name" => $req['name'],
            "email" => $req->email,
            "phone" => $req->phone,
            "address" => $req->address,
            "registered_date" => date('Y-m-d'),
            "exp_date" => $req['exp_date']
        ]);
        $d = DB::table('vendors')->orderBy('id', 'desc')->first();
        $file = $req->file('bg_img');
        $file->move("images", $d->id . ".jpg");
        DB::statement("CREATE TABLE $d->id" . "_sections (
            id int NOT NULL AUTO_INCREMENT,
            name text,
            PRIMARY KEY(id)
        )");
        DB::statement("CREATE TABLE $d->id" . "_staff (
            id int NOT NULL AUTO_INCREMENT,
            name text,
            phone text,
            email text,
            password text,
            section_id int,
            permission int,
            PRIMARY KEY(id)
        )");
        DB::statement("CREATE TABLE $d->id" . "_visitors (
            id int NOT NULL AUTO_INCREMENT,
            name text,
            name_ch text,
            sex text,
            dob date,
            phone text,
            address text,
            purpose text,
            section_name text,
            addresser text,
            addresser_id int,
            date date,
            time time,
            doc_type text,
            doc_id text,
            father_name text,
            issue_date date,
            exp_date date,
            PRIMARY KEY(id)
        )");
        DB::table($d->id . '_sections')->insert([
            'id' => 0,
            'name' => 'Main'
        ]);
        DB::update('update ' . $d->id . '_sections set id = 0 where name = "Main"');
        DB::table($d->id . '_staff')->insert([
            'name' => $req->uname,
            "phone" => $req->uphone,
            "email" => $req->uemail,
            "password" => bcrypt($req->upassword, ['rounds' => 4]),
            "section_id" => 0,
            "permission" => 0
        ]);
        return redirect('/admin/addVendor?msg=Vendor Added Sucessfully');
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
            // $req->session()->forget('otp');
            return redirect("/admin");
        } else {
            // $req->session()->flush();
            return redirect("/admin/otp?error=Wrong-OTP");
        }
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
    function logout()
    {
        Session::flush();
        return redirect('/admin/login');
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
        session(['admin_otp' => Hash::make($details['otp']), 'admin-per' => $re->permission]);
        Mail::to($req['email'])->send(new loginMail($details));
        return view('admin.otp');
    }
    function otp_get()
    {
        if (Session::get('otp')) {
            return view('admin.otp', ["msg" => $_GET['error']]);
        } else {
            return redirect('/admin/login');
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
    function vendor_update(Request $req)
    {
        if ($req->session()->get('admin-access') == true && $req->session()->get('admin-per') == 0) {
            if ($req->file('bg_img') != "") {
                $file = $req->file('bg_img');
                $file->move("images/", $req->id . ".jpg");
            }
            $re = DB::update("update vendors set name = ?, phone = ?, email = ?, address= ?, exp_date = ? where id = ?", [$req['name'], $req['phone'], $req['email'], $req->address, $req['exp_date'], $req['id']]);
            return redirect('/admin/list');
        } else {
            return "You are not permitted to update.";
        }
    }
    function vendor_delete($id, Request $req)
    {
        if ($req->session()->get('admin-access') == true && $req->session()->get('admin-per') == 0) {
            vendor::destroy($id);
            DB::statement('DROP TABLE ' . $id . '_visitors');
            DB::statement('DROP TABLE ' . $id . '_sections');
            DB::statement('DROP TABLE ' . $id . '_staff');
            unlink("images/" . $id . ".jpg");
            return redirect('/admin/list');
        } else {
            return "You are not permitted to update.";
        }
    }
    function vendors($id, Request $req)
    {
        if ($req->session()->get('admin-access') == true && $req->session()->get('admin-per') == 0) {
            $res = DB::select('select * from vendors where id = ?', [$id]);
            return json_encode($res);
        } else {
            return "You are not permitted to view.";
        }
    }
}
