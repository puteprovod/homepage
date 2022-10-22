<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StoreRequest;
use App\Http\Resources\Post\PostResource;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\DB;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
            try {
            Db::beginTransaction();

            $data = $request->validated();
            $category = $data['category'];
            unset ($data['category']);

            $data['category_id'] = $this->getCategoryId($category);
            $post = Post::create($data);
            Db::commit();
        } catch (\Exception $exception) {

            DB::rollBack();
            $post = $exception->getMessage();
        }

        return $post instanceof Post ? new PostResource($post) : $post;
        //return redirect()->route('posts.index');
    }

    private function getCategoryId($item)
    {

        $category = !isset($item['id']) ? Category::create($item) : Category::find($item['id']);
        return $category->id;
    }
}
