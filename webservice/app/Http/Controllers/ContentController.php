<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Content;

class ContentController extends Controller
{
    public function add(Request $request) 
    {
        $data = $request->all();
        $user = $request->user();

        // Validação

        $content = new Content;
        $content->title = $data['title'];
        $content->text = $data['text'];
        $content->link = $data['link'];
        $content->image = $data['image'];
        $content->date = date('Y-m-d H:i:s');
        
        $user->contents()->save($content);
        
        return [
            'status' => true,
            'contents' => $user->contents
        ];
    }

    public function list(Request $request)
    {
        $contents = Content::with('user')->orderBy('date', 'DESC')->paginate(5);

        return [
            'status' => true,
            'contents' => $contents
        ];
    }
}
