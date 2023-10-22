<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    public function index(Request $request)
    {

        $datas = User::when(!is_null($request->get('search')), function ($query) use ($request) {
            return $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->get('search') . '%')
                    ->orWhere('email', 'like', '%' . $request->get('search') . '%');
            });
        })->orderBy('created_at', 'desc')->paginate(10);


        return view('user.index', compact('datas'));
    }

    public function edit(User $user)
    {
        return response()->json([
            'data' => $user
        ]);
    }

    public function store(CreateUserRequest $request)
    {
        $data = $request->all();

        $data['password'] =  Hash::make($data['password']);

        User::create($data);

        return response()->json([
            'message' => 'Berhasil menambahkan user!'
        ]);
    }


    public function update(UpdateUserRequest $request, User $user)
    {


        $data = $request->all();

        $data['password'] =  Hash::make($data['password']);

        $user->update($data);

        return response()->json([
            'message' => 'Berhasil merubah User!',
        ]);
    }

    public function destroy(User $user)
    {

        $user->delete();
        return response()->json([
            'message' => 'User berhasil dihapus!'
        ]);
    }
}
