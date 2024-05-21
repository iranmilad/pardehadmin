<?php

namespace App\Http\Controllers;

use Exception;
use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use App\Http\Requests\CommentRequest;

class CommentController extends Controller
{
    /**
     * @param CommentRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function store(CommentRequest $request)
    {
        $comment = Auth::check()
            ? $request->user()->comments()->create($request->all())
            : Comment::create($request->all());
        return response()->json([
            'content' => view('partials.article.comment')
                ->with('comment', $comment)
                ->render(),
            'message' => Lang::get('ajax.add-comment', ['name' => $request->name])
        ]);
    }

    /**
     * @param Comment $comment
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function delete(Comment $comment)
    {
        $this->authorize('delete', $comment);
        try {
            $comment->delete();
            return response()->json(['status' => true]);
        } catch (Exception $e) {
            return response()->json(['status' => false]);
        }
    }

    /**
     * @param Request $request
     * @param Comment $comment
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, Comment $comment)
    {
        $this->authorize('update', $comment);
        $comment->update($request->all());
        return response()->json(['text' => $comment->text]);
    }
}
