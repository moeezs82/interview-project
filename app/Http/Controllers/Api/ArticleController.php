<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    //
    public function store(ArticleRequest $request)
    {
        $article = Article::create($request->validated());

        return response()->json($article, 201);
    }

    public function get($id)
    {
        $article = Article::find($id);

        if (!$article) {
            return response()->json(['message' => 'Article not found'], 404);
        }

        return response()->json($article);
    }

    public function delete($id)
    {
        $article = Article::find($id);

        if (!$article) {
            return response()->json(['message' => 'Article not found'], 404);
        }

        $article->delete();
        return response()->json("done");
    }

    public function update(Request $request, $id)
    {
        $article = Article::find($id);

        if (!$article) {
            return response()->json(['message' => 'Article not found'], 404);
        }

        $requestValidated = $request->validate([
            'title' => 'required|max:30',
            'content' => 'required',
            'author' => 'required|max:255',
            'category' => 'required|max:255',
            'published_at' => 'required|date',
        ]);

        $article->update($requestValidated);
        return response()->json($article);
    }
}
