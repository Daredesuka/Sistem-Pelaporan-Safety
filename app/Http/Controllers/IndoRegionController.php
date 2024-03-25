<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Regency;
use App\Models\Village;
use Illuminate\Http\Request;

class IndoRegionController extends Controller
{
    public function getRegency(Request $request)
    {   
        $province_id = $request->province_id;
        $regencies = Regency::where('province_id', $province_id)->get();
        $option = "<option value=''>-- Pilih Kota/Kabupaten --</option>";
        foreach($regencies as $regency) {
            if(auth()->user()->regency_id !== NULL && $regency->id === auth()->user()->regency_id){
                echo "<option value='$regency->id' selected>$regency->name</option>";
            } else {
                $option .= "<option value='$regency->id'>$regency->name</option>";
            }
        }
        echo $option;
    }

    public function getDistrict(Request $request)
    {
        $regency_id = $request->regency_id;
        $districts = District::where('regency_id', $regency_id)->get();
        $option = "<option value=''>-- Pilih Kecamatan --</option>";
        foreach($districts as $district) {
            if(auth()->user()->district_id !== NULL && $district->id === auth()->user()->district_id){
                echo "<option value='$district->id' selected>$district->name</option>";
            } else {
                $option .= "<option value='$district->id'>$district->name</option>";
            }
        }
        echo $option;
    }

    public function getVillage(Request $request)
    {
        $district_id = $request->district_id;
        $villages = Village::where('district_id', $district_id)->get();
        $option = "<option value=''>-- Pilih Kelurahan/Desa --</option>";
        foreach($villages as $village) {
            if(auth()->user()->village_id !== NULL && $village->id === auth()->user()->village_id){
                echo "<option value='$village->id' selected>$village->name</option>";
            } else {
                $option .= "<option value='$village->id'>$village->name</option>";
            }
        }
        echo $option;
    }
    public function getKota(Request $request)
    {
        $province_id = $request->province_id;
        $regencies = Regency::where('province_id', $province_id)->get();
        $option = "<option value=''>-- Pilih Kota/Kabupaten --</option>";
        foreach($regencies as $regency) {
            $option .= "<option value='$regency->id'>$regency->name</option>";
        }
        echo $option;
    }

    public function getKecamatan(Request $request)
    {
        $regency_id = $request->regency_id;
        $districts = District::where('regency_id', $regency_id)->get();
        $option = "<option value=''>-- Pilih Kecamatan --</option>";
        foreach($districts as $district) {
            $option .= "<option value='$district->id'>$district->name</option>";
        }
        echo $option;
    }

    public function getDesa(Request $request)
    {
        $district_id = $request->district_id;
        $villages = Village::where('district_id', $district_id)->get();
        $option = "<option value=''>-- Pilih Kelurahan/Desa --</option>";
        foreach($villages as $village) {
            $option .= "<option value='$village->id'>$village->name</option>";
        }
        echo $option;
    }
}
