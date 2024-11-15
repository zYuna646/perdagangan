<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Catalog;
use App\Models\Category;
use App\Models\Harga;
use App\Models\Information;
use App\Models\Kegiatan;
use App\Models\Tipe;
use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $count_catalog = Catalog::count();
        $count_category = Category::count();
        $count_video = Video::count();
        $count_information = Information::count();
        $count_alat = Alat::count();
        $count_tipe = Tipe::count();
        $count_kegiatan = Kegiatan::count(); // Count Kegiatan entries
        $count_harga = Harga::count(); // Count Harga entries
    
        $latest_products = Catalog::orderBy('created_at', 'desc')->take(5)->get();
        $latest_video = Video::orderBy('created_at', 'desc')->take(1)->first();
        $latest_informations = Information::orderBy('created_at', 'desc')->take(3)->get();
        $latest_kegiatan = Kegiatan::orderBy('created_at', 'desc')->take(5)->get(); // Fetch latest Kegiatan entries
        $latest_harga = Harga::orderBy('created_at', 'desc')->take(5)->get(); // Fetch latest Harga entries
    
        return view('admin.dashboard', [
            'title' => 'Dashboard',
            'subtitle' => '',
            'active' => 'dashboard',
            'count_catalog' => $count_catalog,
            'count_category' => $count_category,
            'count_video' => $count_video,
            'count_information' => $count_information,
            'count_alat' => $count_alat,
            'count_tipe' => $count_tipe,
            'count_kegiatan' => $count_kegiatan,
            'count_harga' => $count_harga,
            'latest_products' => $latest_products,
            'latest_video' => $latest_video,
            'latest_informations' => $latest_informations,
            'latest_kegiatan' => $latest_kegiatan,
            'latest_harga' => $latest_harga,
        ]);
    }
    
    

    public function accountSetting()
    {
        return view('admin.settings.account-setting.index', [
            'title' => 'Account Setting',
            'subtitle' => '',
            'active' => 'account-setting',
        ]);
    }

    public function changePassword(Request $request, $id)
    {
        $this->validate($request, [
            'current_password' => 'required',
            'new_password' => 'required|min:8',
            'confirm_new_password' => 'required|same:new_password',
        ], [
            'current_password.required' => 'Current Password is required',
            'new_password.required' => 'New Password is required',
            'new_password.min' => 'New Password must be at least 8 characters',
            'confirm_new_password.required' => 'Confirm New Password is required',
            'confirm_new_password.same' => 'Confirm New Password must be same with New Password',
        ]);

        $user = User::findOrFail($id);

        if (password_verify($request->current_password, $user->password)) {
            $user->update([
                'password' => bcrypt($request->new_password),
            ]);

            return redirect()->back()->with('success', 'Password has been changed');
        } else {
            return redirect()->back()->with('error', 'Current Password is wrong');
        }
    }

    public function changeInformation(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
        ], [
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'email.email' => 'Email must be a valid email address',
        ]);

        $user = User::findOrFail($id);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->back()->with('success', 'Information has been changed');
    }
}
