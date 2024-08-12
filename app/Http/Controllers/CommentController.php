<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Traits\AuthorizeAccess;

class CommentController extends Controller
{
    use AuthorizeAccess;

    public function __construct()
    {
        // تنظیم نام دسترسی مورد نیاز
        $this->permissionName = 'manage_comments';
    }

    public function index(Request $request)
    {
        // ساختن کوئری برای نظرات
        $query = Comment::with('post')->orderBy('created_at', 'desc');

        // اعمال فیلتر بر اساس دسترسی‌های کاربر
        $query = $this->applyAccessControl($query);

        // صفحه‌بندی نتایج
        $comments = $query->paginate(10);

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

        return redirect()->route('comments.index')->with('success', 'دیدگاه با موفقیت ایجاد شد.');
    }

    public function edit($id)
    {
        $comment = Comment::findOrFail($id);
        $this->authorizeAction($comment);
        return view('post-comment', compact('comment'));
    }

    public function update(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);
        $this->authorizeAction($comment);
        $request->validate([
            'content' => 'required|string',
            'status' => 'required|string|in:pending,approved,rejected',
        ]);

        $comment->update([
            'content' => $request->content,
            'status' => $request->status,
        ]);

        return redirect()->route('comments.index')->with('success', 'دیدگاه با موفقیت به‌روزرسانی شد.');
    }

    public function delete(Request $request)
    {
        Comment::findOrFail($request->id)->delete();
        return redirect()->route('comments.index')->with('success', 'دیدگاه با موفقیت حذف شد.');
    }

    public function bulk_action(Request $request)
    {
        $action = $request->action;
        $commentIds = $request->checked_rows;

        if ($action == 'delete' && !empty($commentIds)) {
            Comment::whereIn('id', $commentIds)->delete();
            return redirect()->route('comments.index')->with('success', 'دیدگاه‌ها با موفقیت حذف شدند.');
        }

        return redirect()->route('comments.index')->with('error', 'عملیات نامعتبر است.');
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


        return redirect()->route('comments.index')->with('success', 'پاسخ با موفقیت ثبت شد.');
    }


    public function approve($id)
    {
        $comment = Comment::find($id);
        $this->authorizeAction($comment);
        if ($comment) {
            $comment->status = 'approved';
            $comment->save();
        }
        return redirect()->back()->with('success', 'دیدگاه تایید شد');
    }

    public function reject($id)
    {
        $comment = Comment::find($id);
        $this->authorizeAction($comment);
        if ($comment) {
            $comment->status = 'rejected';
            $comment->save();
        }
        return redirect()->back()->with('success', 'دیدگاه رد شد');
    }

}
