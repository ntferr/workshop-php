<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
//        return [
//            'users' => [
//                'Anderson', 'Nathan', 'Luan', 'Gregory'
//            ]
//        ];
//        return response()->json([
//            'Anderson', 'Nathan', 'Luan', 'Gregory', 'Jardel', 'Natália'
//        ]);
        return User::all();
    }
    public function show($id)
    {
        //return User::where('id', $id)->get();
        // retorna relação de tabela return User::where('id', $id)->with('post')->get();
        return User::find($id);
    }

    public function create(Request $request)
    {
        //$validatedData = $request->validate([
        //    'name' => 'required|min:3|max:250',
        //    'email' => 'required|unique:users|email|max:250',
        //]);
        $validation = $this->validateRequest($request);

        if($validation->fails()) {
            return $validation->errors();
        }

        $user = new User();

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = $request->input('password');

        $user->save();

        return 'user created!';
        //return $request->all();
    }

    public function update(Request $request, $id)
    {
        $validation = $this->validateRequest($request);

        if($validation->fails()) {
            return $validation->errors();
        }

        User::where('id', $id)->update($request->all());
        //->update(['name'=>$request=>input('')]);
        return 'user updated';
    }

    public function delete($id)
    {
        User::where('id', $id)->delete();

        return 'user deleted!';
    }
    private function validateRequest($request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required|min:3|max:250',
//            'email' => 'required|unique:users|email|max:250',
        ]);
        return $validation;
    }
}
