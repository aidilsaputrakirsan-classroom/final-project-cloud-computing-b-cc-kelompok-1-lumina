<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // plus cek role admin di middleware/global gate kalau ada
    }

    public function index(): View
    {
        $categories = Category::latest()->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    public function create(): View
    {
        return view('admin.categories.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:100|unique:categories,name',
            'description' => 'nullable|string|max:500',
            'is_active'   => 'nullable|boolean',
        ], [
            'name.required' => 'Nama kategori wajib diisi.',
            'name.unique'   => 'Nama kategori sudah terdaftar.',
        ]);

        $slug = Str::slug($validated['name']);
        // pastikan slug unik
        $original = $slug;
        $i = 2;
        while (Category::where('slug', $slug)->exists()) {
            $slug = $original . '-' . $i++;
        }

        Category::create([
            'name'        => $validated['name'],
            'slug'        => $slug,
            'description' => $validated['description'] ?? null,
            'is_active'   => (bool)($validated['is_active'] ?? true),
        ]);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit(Category $category): View
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category): RedirectResponse
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:100|unique:categories,name,' . $category->id,
            'description' => 'nullable|string|max:500',
            'is_active'   => 'nullable|boolean',
        ]);

        $slug = $category->slug;
        if ($category->name !== $validated['name']) {
            $slug = Str::slug($validated['name']);
            $original = $slug;
            $i = 2;
            while (Category::where('slug', $slug)->where('id', '!=', $category->id)->exists()) {
                $slug = $original . '-' . $i++;
            }
        }

        $category->update([
            'name'        => $validated['name'],
            'slug'        => $slug,
            'description' => $validated['description'] ?? null,
            'is_active'   => (bool)($validated['is_active'] ?? true),
        ]);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}
