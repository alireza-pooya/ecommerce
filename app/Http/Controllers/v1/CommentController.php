<?php

namespace App\Http\Controllers\v1;

use App\Comment;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * @param Request $request
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request, Product $product)
    {
        $this->validate($request, [
            'rating' => 'required',
            'title' => 'required',
            'body' => 'required',
        ]);

        $user_id = Auth::id();
        $comments = Comment::all();

        foreach ($comments as $comment) {
            if ($user_id == $comment->user_id && $comment->product_id == $product->id) {
                $message = "your left comment before";
                return redirect()->back()->with('message', $message);
            }
        }

        Comment::create([
            'user_id'       => Auth::id(),
            'product_id'    => $product->id,
            'title'         => $request['title'],
            'body'          => $request['body'],
            'rating'        => $request['rating'],
        ]);

        $message = "your comment saved successfully";
        return redirect()->back()->with('message', $message);
    }
}
