<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleBulkDeleteRequest;
use App\Http\Requests\ArticleRequest;
use App\Http\Requests\ArticleTagRequest;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use App\Models\Tag;

class ArticleController extends Controller
{
    public function store(ArticleRequest $request)
    {
        return new ArticleResource(Article::create($request->validated()));

    }

    public function index()
    {
        return ArticleResource::collection(Article::All());

    }

    public function show(Article $article)
    {
        return new ArticleResource($article);
    }

    public function update(ArticleRequest $request, Article $article)
    {
        $article->update($request->validated());
        return response()->json([
            'id' => $article->id
        ]);
    }

    public function delete(Article $article)
    {
        $article->delete();
        return response()->json([
            'id' => $article->id
        ]);
    }

    public function bulkDelete(ArticleBulkDeleteRequest $request)
    {
        Article::whereIn('id', $request->get('ids'))->delete();
        return response()->json([
            'success' => true,
        ]);
    }

    public function attach(ArticleTagRequest $articleTagRequest, Article $article)
    {
        $tagIds = Tag::query()
            ->whereIn(
                'name',
                array_values(
                    $articleTagRequest->validated('tags')
                )
            )
            ->get()
            ->pluck('id');

        new ArticleResource($article->tags()->syncWithoutDetaching($tagIds));

        return response()->json([
            'tags' => $tagIds,
        ]);

    }
}

