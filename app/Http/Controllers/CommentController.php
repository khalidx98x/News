<?php

namespace App\Http\Controllers\Admin;

use App\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $page_name = 'Comments Page';

    public function __construct()
    {
        $this->middleware('permission:view-comment|all')->only('index');
        $this->middleware('permission:replay-comment|all')->only('store');
        $this->middleware('permission:comment-approval|all')->only('status');
    }

    public function index($id)
    {
        $comments = Comment::where('post_id', $id)->get();

        return view('admin.comment.index')->with([
            'page_name' => $this->page_name,
            'comments' => $comments,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required',
        ]);
        $data['comment'] = $request->comment;
        $data['name'] = auth()->user()->name;
        $data['post_id'] = $id;
        $data['status'] = 1;

        Comment::create($data);

        return redirect()->route('comment.index', $id)->with('success', 'The comment has been created successfully !!');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for replay to the comment from specific post.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function replay($id)
    {
        return view('admin.comment.create')->with([
            'page_name' => $this->page_name,
            'post_id' => $id,
        ]);
    }

    //apporve the comment

    public function status($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->status == 1 ? $comment->status = 0 : $comment->status = 1;
        $comment->save();

        return redirect()->route('comment.index', $comment->post_id)->with('success', 'The comment status has changed successfully !!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
}
