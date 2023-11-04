<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{

    public function edit()
    {
        $company = Company::first();
        return view('company.edit', compact('company'));
    }
    public function update(Company $company, Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string',
            'address' => 'required|string',
            'logo' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        if ($request->file('logo')) {
            $gambar = $request->file('logo');
            $namaFile = time() . '.' . $gambar->getClientOriginalExtension();
            $lokasiPenyimpanan = 'image'; // Anda bisa menentukan lokasi penyimpanan yang sesuai dengan kebutuhan Anda.

            $gambar->move($lokasiPenyimpanan, $namaFile);
            $data['logo'] = url('/image/' . $namaFile);
        }

        $company->update($data);

        return redirect()->route('company.edit')->with('success', 'Perusahaan berhasil diupdate!');
    }
}
