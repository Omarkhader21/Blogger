<?php

namespace App\Filament\Resources\WidgetsResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\PostView;
use App\Models\UpvoteDownvote;
use Illuminate\Database\Eloquent\Model;

class StatsOverview extends BaseWidget
{

    public ?Model $record = null;

    protected function getStats(): array
    {
        return [
            Stat::make('Views', PostView::where('post_id', '=', $this->record->id)->count()),
            Stat::make('Upvote', UpvoteDownvote::where('post_id', '=', $this->record->id)->where('is_upvote', '=', 1)->count()),
            Stat::make('Downvote', UpvoteDownvote::where('post_id', '=', $this->record->id)->where('is_upvote', '=', 0)->count()),
        ];
    }
}
