<?php

namespace App\Exports;

use App\Models\Post;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class PostsExport implements FromView ,WithColumnWidths
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): view
    {
        return view('exports.posts', [
            'posts' =>Post::with('user')
            ->get()
        ]);
    }

    public function columnWidths(): array
    {
        return [
            'A' => 63.67,  // Title column width
            'B' => 153.67,  // Body column width
            'C' => 27.22,  // User column width
            'D' => 30,  // Tags column width
            'E' => 20,  // Created At column width
        ];
    }
}
