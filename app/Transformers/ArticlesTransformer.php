<?php
namespace App\Transformers;

use App\Models\News;
use League\Fractal\TransformerAbstract;

class ArticlesTransformer extends TransformerAbstract
{
    public function transform(News $articles)
    {
        return [
            'id' => $articles->id,
            'title' => $articles->title,
            'slug' => $articles->slug,
            'content' => $articles->content,
            'user_id' => $articles->user_id
        ];
    }
}