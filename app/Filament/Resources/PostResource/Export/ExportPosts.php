<?php

namespace App\Filament\Resources\PostResource\Export;

use App\Models\Post;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class ExportPosts extends Exporter
{
    protected static ?string $model = Post::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('author.name')
                ->label(trans('cms.content.posts.sections.author.columns.author')),
            ExportColumn::make('title')
                ->label(trans('cms.content.posts.sections.post.columns.title')),
            ExportColumn::make('slug')
                ->label(trans('cms.content.posts.sections.post.columns.slug')),
            ExportColumn::make('short_description')
                ->label(trans('cms.content.posts.sections.seo.columns.short_description')),
            ExportColumn::make('body')
                ->label(trans('cms.content.posts.sections.post.columns.body')),
            ExportColumn::make('type')
                ->label(trans('cms.content.posts.sections.status.columns.type')),
            ExportColumn::make('is_published')
                ->label(trans('cms.content.posts.sections.status.columns.is_published')),
            ExportColumn::make('published_at')
                ->label(trans('cms.content.posts.sections.status.columns.published_at')),
            ExportColumn::make('is_trend')
                ->label(trans('cms.content.posts.sections.status.columns.is_trend')),
            ExportColumn::make('views')
                ->label(trans('cms.content.posts.sections.status.columns.views')),
            ExportColumn::make('likes')
                ->label(trans('cms.content.posts.sections.status.columns.likes')),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your posts export has completed and '.number_format($export->successful_rows).' '.str('row')->plural($export->successful_rows).' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' '.number_format($failedRowsCount).' '.str('row')->plural($failedRowsCount).' failed to export.';
        }

        return $body;
    }
}
