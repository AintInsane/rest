<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagBulkDeleteRequest;
use App\Http\Requests\TagRequest;
use App\Http\Resources\TagResource;
use App\Models\Tag;

class TagController extends Controller
{
    public function store(TagRequest $request)
    {
        return new TagResource(Tag::firstOrCreate($request->validated()));
    }

    public function index()
    {
        return TagResource::collection(Tag::All());
    }

    public function show(Tag $tag)
    {
        return new TagResource($tag);
    }

    public function update(TagRequest $request, Tag $tag)
    {
        $tag->update($request->validated());
        return response()->json([
            'id' => $tag->id
        ]);
    }

    public function delete(Tag $tag)
    {
        $tag->delete();

        return response()->json([
            'id' => $tag->id
        ]);
    }
    public function bulkDelete(TagBulkDeleteRequest $request )
    {
        Tag::whereIn('name', $request->get('ids'))->delete();
        return response()->json([
            'success' => true,
        ]);
    }
}
