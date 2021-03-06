<?php

namespace App\Http\Controllers\Admin;

use App\Http\Resources\TagResource;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $tags = Tag::latest();

        if ($request->has('type') && $request->input('type') == 'all') {
            $tags = $tags->get();
        } else {
            $tags = $tags->paginate(10);
        }

        return TagResource::collection($tags);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Response
     */
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'tag' => 'required|min:1|max:15',
            'meta_description' => 'required'
        ]);

        Tag::create($data);

        return $this->noContent();
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Tag $tag
     * @return TagResource
     */
    public function edit(Tag $tag)
    {
        return new TagResource($tag);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Tag $tag
     * @param  \Illuminate\Http\Request $request
     * @return \Response
     */
    public function update(Tag $tag, Request $request)
    {
        $data = $this->validate($request, [
            'tag' => 'required|min:1|max:15',
            'meta_description' => 'required'
        ]);

        $tag->fill($data);

        $tag->save();

        return $this->noContent();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Tag $tag
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Tag $tag)
    {
        if ($tag->articles()->count()) {
            return $this->failed('该标签下有内容，您不能删除该标签');
        }

        $tag->delete();

        return $this->noContent();
    }
}
