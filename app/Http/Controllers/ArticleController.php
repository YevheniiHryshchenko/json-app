<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Http\Resources\ArticleResource;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $articles = Article::when($request->categoryId != '0', function ($query) use ($request) {
                return $query->whereHas('categories', function ($query) use ($request) {
                    return $query->where([
                        'id' => $request->categoryId,
                        'is_primary' => true
                    ]);
                });
            })
            ->when($request->searchedTitleText != '', function ($query) use ($request) {
                return $query->where('title', 'LIKE', '%' . $request->searchedTitleText . '%');
            })
            ->when($request->searchedBodyText != '', function ($query) use ($request) {
                return $query->whereHas('content', function ($query) use ($request) {
                    return $query->where('content', 'LIKE', '%' . $request->searchedBodyText . '%');
                });
            })
            ->paginate(config('resources.available_quantity_at_time'));

        $articles->setCollection(
            collect(ArticleResource::collection($articles->getCollection()))
        );

        return response()->json($articles, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
