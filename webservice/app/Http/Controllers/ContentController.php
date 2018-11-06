<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Content;

class ContentController extends Controller
{
    public function add(Request $request) 
    {
        $data = $request->all();
        $user = $request->user();

        // Validação
        $validator = Validator::make($data, [
            'title' => 'required',
            'text' => 'required',
        ]);
    
        if ($validator->fails()) {
            return [
                'status' => false, 
                'validation' => true, 
                'errors' => $validator->errors()
            ];
        }

        $content = new Content;
        $content->title = $data['title'];
        $content->text = $data['text'];
        $content->link = $data['link'];
        $content->image = $data['image'];
        $content->date = date('Y-m-d H:i:s');
        
        $user->contents()->save($content);
        
        $contents = Content::with('user')->orderBy('date', 'DESC')->paginate(5);

        return [
            'status' => true,
            'contents' => $contents
        ];
    }

    public function list(Request $request)
    {
        $contents = Content::with('user')->orderBy('date', 'DESC')->paginate(5);
        $user = $request->user();

        foreach ($contents as $key => $content) {
            $content->total_likes = $content->likes()->count();

            $liked = $user->likes()->find($content->id);

            $content->liked_content = ($liked) ? true : false;
        }
        
        return [
            'status' => true,
            'contents' => $contents
        ];
    }

    // Add Curtidas
    public function like($id, Request $request) 
    {
        $content = Content::find($id);
        
        if ($content) {
            $user = $request->user();
            $user->likes()->toggle($content->id);
            // return $content->likes()->count();
            // return $content->likes();

            return [
                'status' => true,
                'likes' => $content->likes()->count(),
                'list' => $this->list($request)
            ];
        } else {
            return [
                'status' => false, 
                'validation' => true, 
                'errors' => 'Conteúdo inexistente!'
            ];

        }
    }
}
