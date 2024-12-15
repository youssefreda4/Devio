<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\PDF;

class PDFController extends Controller
{
    public function generatePDF()
    {
        // $posts = Post::orderBy('id', 'DESC')
        //     ->with('user', 'tags', 'comments')
        //     ->limit(8)->get();

        // $posts = [
        //     'title' => 'Welcome to Divio.com',
        //     'date' => date('m/d/Y'),
        //     'posts' => $posts,
        // ];

        $users = User::select('users.id', 'users.name')
            ->selectRaw('COUNT(posts.id) as total_posts')
            ->selectRaw('SUM((SELECT COUNT(*) FROM comments WHERE comments.post_id = posts.id)) as total_comments')
            ->join('posts', 'users.id', '=', 'posts.user_id')
            ->groupBy('users.id', 'users.name')
            ->get();

        $users = [
            'title' => 'Welcome to Divio.com',
            'date' => date('m/d/Y'),
            'users' => $users,
        ];

        $pdf = PDF::loadView('Pdf.pdf-copy', $users);

        return $pdf->download('usersReport.pdf');
    }
}
