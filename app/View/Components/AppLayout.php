<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;
use Illuminate\Support\Collection;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class AppLayout extends Component
{
    public Collection $categories;

    public function __construct(public ?string $metaTitle = null, public ?string $metaDescription = null)
    {
        $this->categories = Category::select('categories.id', 'categories.title', 'categories.slug', DB::raw('count(*) as total'))
            ->join('category_post', 'categories.id', '=', 'category_post.category_id')
            ->groupBy('categories.id')
            ->orderByDesc('total')
            ->limit(5)
            ->get();
    }

    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('layouts.app');
    }
}
