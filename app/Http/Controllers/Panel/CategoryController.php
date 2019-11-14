<?php

namespace App\Http\Controllers\Panel;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $all = Category::whereNull('parent_id')->orderBy('id', 'desc')->with(['children' => function ($query) {
            $query->orderBy('id', 'desc');
        }]);

        if ($request->search) {
            $all = $all->where('name', 'LIKE', '%' . $request->search . '%');
        }

        $categories = $all->paginate(20)->appends($request->query());
        return view('panel.category.index', compact('categories'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'unique:categories']
        ]);

        Category::create([
            'name' => $request['name'],
            'parent_id' => $request['parent_id'],
        ]);

        $message = $request->name . " category created successfully";
        return redirect()->back()->with('message', $message);
    }

    /**
     * @param Category $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Category $category)
    {

        $posts = Category::whereNull('parent_id')->orderBy('id','desc')->get()->except($category['id']);

        return view('panel.category.edit', compact('category','posts'));
    }

    /**
     * @param Request $request
     * @param Category $category
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Category $category)
    {
        $this->validate($request, [
            'name' => 'required', 'unique:categories'.$category->id
        ]);

        $category->update([
            'name'      => $request['name'],
            'parent_id' => $request['parent_id'],
        ]);
        $message = "your categories name changed";
        return redirect(route('category.index'))->with('message', $message);
    }

}
