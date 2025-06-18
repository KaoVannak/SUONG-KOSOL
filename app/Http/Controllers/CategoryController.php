<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CategoryController extends Controller
{
    private $apiUrl = 'http://127.0.0.1:5000/api/categories';

    /**
     * Display a listing of the categories.
     */
    public function index()
    {
        $response = Http::get($this->apiUrl);
        $categories = $response->json();
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new category.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created category in the API.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $response = Http::post($this->apiUrl, $validated);

        if ($response->successful()) {
            $newCategory = $response->json();
            return redirect()->route('categories.index')
                ->with('success', 'Category created at: ' . $newCategory['created_at']);
        }

        return back()->with('error', 'Failed to create category.')->withInput();
    }

    /**
     * Show the form for editing the specified category.
     */
    public function edit($id)
{
    $response = Http::get("{$this->apiUrl}/$id");

    if ($response->failed()) {
        return redirect()->route('categories.index')->with('error', 'Category not found');
    }

    $category = (object) $response->json(); // Cast to object for Blade ease
    return view('categories.edit', compact('category'));
}



    /**
     * Update the specified category in the API.
     */
     public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $response = Http::put("{$this->apiUrl}/$id", $validated);

        if ($response->successful()) {
            return redirect()->route('categories.index')->with('success', 'Category updated successfully');
        }

        return back()->withErrors(['api_error' => 'Update failed']);
    }

    /**
     * Remove the specified category from the API.
     */
    public function destroy($id)
    {
        $response = Http::delete("{$this->apiUrl}/$id");

        return redirect()->route('categories.index')->with(
            $response->successful() ? 'success' : 'error',
            $response->successful() ? 'Category deleted successfully.' : 'Failed to delete category.'
        );
    }
}
