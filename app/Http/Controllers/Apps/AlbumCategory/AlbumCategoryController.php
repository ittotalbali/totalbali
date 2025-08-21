<?php

namespace App\Http\Controllers\Apps\AlbumCategory;

use App\Http\Controllers\Controller;
use App\Services\AlbumCategory\DeleteAlbumCategoryService;
use App\Services\AlbumCategory\GetAlbumCategoryService;
use App\Services\AlbumCategory\StoreAlbumCategoryService;
use App\Services\AlbumCategory\UpdateAlbumCategoryService;
use Illuminate\Http\Request;

class AlbumCategoryController extends Controller
{
    public function index(GetAlbumCategoryService $getAlbumCategoryService)
    {
        $result = $getAlbumCategoryService->execute();

        return view('admin.album-category.index', [
            'album_categories' => $result->data
        ]);
    }

    public function get(
        Request $request,
        GetAlbumCategoryService $getAlbumCategoryService
    ) {
        $result = $getAlbumCategoryService->execute($request->all());

        return response()->json([
            'success' => true,
            'data' => $result->data
        ]);
    }

    public function store(
        Request $request,
        StoreAlbumCategoryService $storeAlbumCategoryService
    ) {
        $result = $storeAlbumCategoryService->execute($request->all());

        return response()->json([
            'success' => true,
            'data' => $result->data
        ]);
    }

    public function update(
        Request $request,
        UpdateAlbumCategoryService $updateAlbumCategoryService
    ) {
        $result = $updateAlbumCategoryService->execute($request->all());

        return response()->json([
            'success' => true,
            'data' => $result->data
        ]);
    }

    public function delete(
        Request $request,
        DeleteAlbumCategoryService $deleteAlbumCategoryService
    ) {
        $result = $deleteAlbumCategoryService->execute($request->all());

        return response()->json([
            'success' => true,
            'data' => $result->data
        ]);
    }
}
