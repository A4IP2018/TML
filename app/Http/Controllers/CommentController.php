<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Comment;
use App\User;
use Auth;
class CommentController extends Controller
{

    /**
     * Get Comments for pageId
     *
     * @return Comment
     */
    public function index($pageId)
    {
        //
        $comments = Comment::where('page_id',$pageId)->get();
        $commentsData = [];


        foreach ($comments as $key) {
            $user = User::find($key->users_id);
            $username = $user->username;
            $replies = $this->replies($key->id);
            $reply = 0;

            if(sizeof($replies) > 0){
                $reply = 1;
            }
                array_push($commentsData,[
                    "username" => $username,
                    "commentid" => $key->id,
                    "comment" => $key->comment,
                    "reply" => $reply,
                    "replies" => $replies,
                    "date" => $key->created_at->toDateTimeString()
                ]);

        }
        $collection = collect($commentsData);
        return $collection;
    }
    protected function replies($commentId)
    {
        $comments = Comment::where('reply_id',$commentId)->get();
        $replies = [];

        foreach ($comments as $key) {
            $user = User::find($key->users_id);
            $username = $user->username;


                array_push($replies,[
                    "username" => $username,
                    "commentid" => $key->id,
                    "comment" => $key->comment,
                    "date" => $key->created_at->toDateTimeString()
                ]);


        }

        $collection = collect($replies);
        return $collection;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'comment' => 'required',
            'reply_id' => 'filled',
            'page_id' => 'filled',
            'users_id' => 'required',
        ]);
        $comment = Comment::create($request->all());
        // dd($comment);
        if($comment)
            return [ "status" => "true","commentId" => $comment->id ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}