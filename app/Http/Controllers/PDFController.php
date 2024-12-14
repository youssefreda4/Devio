<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\PDF;

class PDFController extends Controller
{
    public function generatePDF()
    {
        $posts = Post::orderBy('id', 'DESC')->with('user')
            ->with('tags')->limit(3)->get();

        $posts = [
            'title' => 'Welcome to Divio.com',
            'date' => date('m/d/Y'),
            'posts' => $posts,
        ];

        $pdf = PDF::loadView('Pdf.pdf', $posts);

        return $pdf->download('postsReport.pdf');
    }
}
