<?php

namespace App\Http\Controllers\admin;

use App\DataTables\BlogCommentDataTable;
use App\Http\Controllers\Controller;
use App\Models\BlogComment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class BlogCommentController extends Controller
{
    function __construct()
    {
        $this->middleware(['permission:blog comment']);
    }
    public function index(BlogCommentDataTable $datatable): View|JsonResponse
    {
        return $datatable->render('admin.blog.blog-comment.index');
    }

    public function commentStatusUpdate(Request $request): Response
    {
        $request->validate([
            'status' => ['required', 'boolean']
        ]);

        $comment = BlogComment::findOrFail($request->id);
        $comment->status = $request->status;
        $comment->save();

        return response(['status' => 'success', 'message' => 'Updated Sucesfully']);
    }

    public function destroy(string $id) : Response {
        try {
            BlogComment::findOrFail($id)->delete();

            return response([
                'status' => "success",
                'message' => "Comment deleted successfully"
            ]);
        } catch (\Exception $e) {
            logger($e);
            return response([
                'status' => "error",
                'message' => $e->getMessage()
            ]);
        }
    }
}
