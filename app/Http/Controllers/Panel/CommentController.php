<?php

namespace App\Http\Controllers\Panel;

use App\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class   CommentController extends Controller
{

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $all = Comment::orderBy('id', 'desc')->with('user', 'product');

        if ($request->search) {
            $all = $all->where('title', 'LIKE', '%' . $request->search . '%')
                ->orWhere('title', 'LIKE', '%' . $request->search . '%')
                ->orWhereHas('user', function ($query) use ($request) {
                    $query->where('full_name', 'LIKE', '%' . $request->search . '%');
                })->orWhereHas('product', function ($query) use ($request) {
                    $query->where('name', 'LIKE', '%' . $request->search . '%');
                });
        }

        $comments = $all->paginate(20)->appends($request->query());
        return view('panel.comment.index', compact('comments'));
    }

    /**
     * @param Comment $comment
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Comment $comment)
    {
        $comment = Comment::where('id',$comment->id)->with('user','product')->first();

        return view('panel.comment.edit',compact('comment'));
    }

    /**
     * @param Request $request
     * @param Comment $comment
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Comment $comment)
    {
        $comment->update([
            'approved' => $request['approved'],
        ]);

        $message = 'your comment edited successfully';
        return redirect(route('comment.index'))->with('message',$message);
    }
}
