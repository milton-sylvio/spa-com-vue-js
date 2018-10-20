<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\User;
use Auth;
use Hash;

class UserController extends Controller
{
    public function login (Request $request) 
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string',
        ]);
    
        if ($validator->fails()) {
            return [
                'status' => false, 
                'validation' => true, 
                'errors' => $validator->errors()
            ];
        }
    
        if (Auth::attempt([ 'email' => $data['email'], 'password' => $data['password'] ])) {
            $user = auth()->user();
            $user->token = $user->createToken($user->email)->accessToken;
            $user->image = asset($user->image);

            return [
                'status' => true,
                'user' => $user
            ];
        } else {
            return ['status' => false];
        }
    }

    public function register (Request $request) 
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    
        if ($validator->fails()) {
            return [
                'status' => false, 
                'validation' => true, 
                'errors' => $validator->errors()
            ];
        }
    
        $image = '/profiles/default.jpg';
    
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'image' => $image
        ]);
    
        $user->token = $user->createToken($user->email)->accessToken;
        $user->image = asset($user->image);
    
        return [
            'status' => true,
            'user' => $user
        ];
    }

    public function profile (Request $request) 
    {
        $user = $request->user();
        $data = $request->all();
    
        if (isset($data['password'])) {
            $validator = Validator::make($data, [
                'name' => 'required|string|max:255',
                'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
                'password' => 'required|string|min:6|confirmed',
            ]);
                
            if ($validator->fails()) {
                return [
                    'status' => false, 
                    'validation' => true, 
                    'errors' => $validator->errors()
                ];
            }
            
            $user->password = Hash::make($data['password']);
        } else {
            $validator = Validator::make($data, [
                'name' => 'required|string|max:255',
                'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            ]);
            
            if ($validator->fails()) {
                return [
                    'status' => false, 
                    'validation' => true, 
                    'errors' => $validator->errors()
                ];
            }
    
            $user->name = $data['name'];
            $user->email = $data['email'];
        }
    
        if (isset($data['image'])) {
            $validator = Validator::extend('base64image', function ($attribute, $value, $parameters, $validator) {
                $explode = explode(',', $value);
                $allow = ['png', 'jpg', 'svg', 'jpeg', 'gif'];
    
                $format = str_replace(
                    ['data:image/', ';', 'base64'],
                    ['', '', ''],
                    $explode[0]
                );
    
                // Verificamos o formato do arquivo
                if (!in_array($format, $allow)) {
                    return false;
                }
    
                if (!preg_match('%^[a-zA-Z0-9/+]*={0,2}$%', $explode[1])) {
                    return false;
                }
    
                return true;
            });
    
            $validator = Validator::make($data, [
                'image' => 'base64image',
            ], ['base64image' => 'Tipo de imagem inválida!']);
    
            if ($validator->fails()) {
                return [
                    'status' => false, 
                    'validation' => true, 
                    'errors' => $validator->errors()
                ];
            }
    
            $time = time();
            $dir = 'profiles';
    
            // $dirImg = $dir . DIRECTORY_SEPARATOR . 'profile_id_' . $user->id;
            
            $ext = substr($data['image'], 11, strpos($data['image'], ';') - 11);
    
            $urlImage = $dir . DIRECTORY_SEPARATOR . $time . '-profile_id-' . $user->id . '.' . $ext;
            
            $file = str_replace('data:image/' . $ext . ';base64,', '', $data['image']);
            $file = base64_decode($file);
    
            if (!file_exists($dir)) {
                mkdir($dir, 0700);
            }
    
            if ($user->image) {
                if (file_exists($user->image)) {
                    unlink($user->image);
                }
            }
    
            file_put_contents($urlImage, $file);
    
            $user->image = $urlImage;
        }
    
        $user->save();
    
        $user->image = asset($user->image);
        $user->token = $user->createToken($user->email)->accessToken;
    
        return [
            'status' => true,
            'user' => $user
        ];
    }
}