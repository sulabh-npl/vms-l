<?php

namespace App\Http\Controllers;

use App\Mail\loginMail;
use App\Models\vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class appController extends Controller
{
    function login($company, $name, $pw)
    {
        $rslt = vendor::where('name', $company)->first();
        if ($rslt == null) {
            return "101";
        }

        // setcookie('loc', $req['n'], time() + 3600 * 24 * 365);
        $id = $rslt->id;
        $result = DB::select('select * from ' . $id . '_staff where email = "' . $name . '"');
        if ($result == null) {
            return "102";
        }
        if (!Hash::check($pw, $result[0]->password)) {
            return "103";
        }
        // session(['uid' => $rslt->id, 'name' => $result[0]->name, 'utitle' => $rslt->name, 'per' => $result[0]->permission, "id" => $result[0]->id]);
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
        Mail::to($name)->send(new loginMail($details));
        return [
            "otp" => $details['otp'],
            "loc" => $company,
            'uid' => $rslt->id,
            'name' => $result[0]->name,
            'utitle' => $rslt->name,
            'per' => $result[0]->permission,
            "id" => $result[0]->id
        ];
    }
}
