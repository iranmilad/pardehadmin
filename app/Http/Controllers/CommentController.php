<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        $comments = Comment::with('post')->orderBy('created_at', 'desc')->paginate(10);
        return view('post-comments', compact('comments'));
    }

    public function create()
    {
        // Assuming that we have a specific post to attach the comment to
        $post = Post::first();
        return view('post-comment', compact('post'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
            'status' => 'required|string|in:pending,approved,rejected',
        ]);

        Comment::create([
            'post_id' => $request->post_id,
            'author' => auth()->user()->name,
            'content' => $request->content,
            'status' => $request->status,
        ]);

        return redirect()->route('comments.list')->with('success', 'دیدگاه با موفقیت ایجاد شد.');
    }

    public function edit($id)
    {
        $comment = Comment::findOrFail($id);
        return view('post-comment', compact('comment'));
    }

    public function update(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);

        $request->validate([
            'content' => 'required|string',
            'status' => 'required|string|in:pending,approved,rejected',
        ]);

        $comment->update([
            'content' => $request->content,
            'status' => $request->status,
        ]);

        return redirect()->route('comments.list')->with('success', 'دیدگاه با موفقیت به‌روزرسانی شد.');
    }

    public function delete(Request $request)
    {
        Comment::findOrFail($request->id)->delete();
        return redirect()->route('comments.list')->with('success', 'دیدگاه با موفقیت حذف شد.');
    }

    public function bulk_action(Request $request)
    {
        $action = $request->action;
        $commentIds = $request->checked_rows;

        if ($action == 'delete' && !empty($commentIds)) {
            Comment::whereIn('id', $commentIds)->delete();
            return redirect()->route('comments.list')->with('success', 'دیدگاه‌ها با موفقیت حذف شدند.');
        }

        return redirect()->route('comments.list')->with('error', 'عملیات نامعتبر است.');
    }


    public function reply(Request $request)
    {
        $request->validate([
            'comment_id' => 'required|exists:comments,id',
            'message' => 'required|string',
        ]);

        $parentComment = Comment::findOrFail($request->comment_id);

        Comment::create([
            'post_id' => $parentComment->post_id,
            'user_id' => auth()->user()->id ?? 1, // یا می‌توانید از `auth()->user()->id` برای ارتباط با کاربر استفاده کنید
            'text' => $request->message,
            'email' => auth()->user()->email ?? "admin@gmail.com",
            'name' => auth()->user()->name ?? 'ادمین',
            'status' => 'approved', // وضعیت پیش‌فرض برای پاسخ
            'parent_comment_id' => $parentComment->id,
        ]);


        return redirect()->route('comments.list')->with('success', 'پاسخ با موفقیت ثبت شد.');
    }


    public function approve($id)
    {
        $comment = Comment::find($id);
        if ($comment) {
            $comment->status = 'approved';
            $comment->save();
        }
        return redirect()->back()->with('success', 'دیدگاه تایید شد');
    }

    public function reject($id)
    {
        $comment = Comment::find($id);
        if ($comment) {
            $comment->status = 'rejected';
            $comment->save();
        }
        return redirect()->back()->with('success', 'دیدگاه رد شد');
    }

}
