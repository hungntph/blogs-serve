<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateCommentRequest;
use App\Services\User\CommentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller
{
    public function __construct(
        public CommentService $commentService,
    ) {
    }

    public function create(Request $request)
    {
        $result = $this->commentService->createComment($request->only('blog_id', 'content'));
        return response()->json($result);
    }

    public function update(int $id, UpdateCommentRequest $request)
    {
        $comment = $this->commentService->getCommentById($id);
        if (Gate::allows('update-comment', $comment)) {
            $update = $this->commentService->updateComment($id, $request->only('content'));
            return response()->json($update);
        }
        abort(403);
    }

    public function destroy(int $id)
    {
        $comment = $this->commentService->getCommentById($id);
        if (Gate::allows('delete-comment', $comment)) {
            $delete = $this->commentService->delete($id);
            return response()->json($delete);
        }
        abort(403);
    }
}
