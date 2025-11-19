<?php

namespace App\Http\Controllers\Admin;

use App\Models\History;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Carbon\Carbon;

class HistoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(): View
    {
        $histories = History::with('category')->latest()->paginate(10);
        return view('admin.histories.index', compact('histories'));
    }

    public function create(): View
    {
        $categories = Category::all();
        return view('admin.histories.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title'        => 'required|string|max:150',
            'content'      => 'required|string',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:4096',
            'event_date'   => 'required|string',
            'category_id'  => 'nullable|integer|exists:categories,id',
            'is_published' => 'nullable|boolean',
        ]);

        $data['slug'] = $this->makeUniqueSlug($data['title']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('photos', 'public');
        }

        $data['is_published'] = $request->has('is_published');
        $data['published_at'] = $data['is_published'] ? now() : null;
        $data['event_date'] = $this->parseEventDate($data['event_date']);

        History::create($data);

        $message = $data['is_published'] ? 'Sejarah berhasil dipublikasikan!' : 'Sejarah berhasil ditambahkan.';
        // Selalu redirect ke dashboard admin!
        return redirect()->route('admin.dashboard')->with('success', $message);
    }

    public function edit(History $history): View
    {
        $categories = Category::all();
        return view('admin.histories.edit', compact('history', 'categories'));
    }

    public function update(Request $request, History $history): RedirectResponse
    {
        $data = $request->validate([
            'title'        => 'required|string|max:150',
            'content'      => 'required|string',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:4096',
            'event_date'   => 'required|string',
            'category_id'  => 'nullable|integer|exists:categories,id',
            'is_published' => 'nullable|boolean',
            'slug'         => 'nullable|string|max:180',
        ]);

        if (!empty($data['slug'])) {
            $data['slug'] = $this->ensureUniqueSlug($data['slug'], $history->id);
        } elseif ($history->title !== $data['title']) {
            $data['slug'] = $this->makeUniqueSlug($data['title'], $history->id);
        } else {
            $data['slug'] = $history->slug;
        }

        if ($request->hasFile('image')) {
            if ($history->image) {
                Storage::disk('public')->delete($history->image);
            }
            $data['image'] = $request->file('image')->store('photos', 'public');
        }

        $data['event_date'] = $this->parseEventDate($data['event_date']);
        $data['is_published'] = $request->has('is_published');
        $data['published_at'] = $data['is_published'] ? ($history->published_at ?: now()) : null;

        $history->update($data);

        $message = $data['is_published'] ? 'Sejarah berhasil dipublikasikan!' : 'Sejarah berhasil diperbarui.';
        // Selalu redirect ke dashboard admin!
        return redirect()->route('admin.dashboard')->with('success', $message);
    }

    public function destroy(History $history): RedirectResponse
    {
        if ($history->image) {
            Storage::disk('public')->delete($history->image);
        }
        $history->delete();
        // Selalu redirect ke dashboard admin!
        return redirect()->route('admin.dashboard')->with('success', 'Sejarah berhasil dihapus!');
    }

    // --- Helpers ---

    private function makeUniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $base = Str::slug($title);
        $slug = $base;
        $i = 2;
        $exists = fn($s) => History::query()
            ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
            ->where('slug', $s)
            ->exists();
        while ($exists($slug)) {
            $slug = $base . '-' . $i++;
        }
        return $slug;
    }

    private function ensureUniqueSlug(string $raw, ?int $ignoreId = null): string
    {
        $base = Str::slug($raw);
        $slug = $base;
        $i = 2;
        $exists = fn($s) => History::query()
            ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
            ->where('slug', $s)
            ->exists();
        while ($exists($slug)) {
            $slug = $base . '-' . $i++;
        }
        return $slug;
    }

    private function parseEventDate(string $value): Carbon
    {
        $value = trim($value);
        if (str_contains($value, '/')) {
            return Carbon::createFromFormat('d/m/Y', $value)->startOfDay();
        }
        return Carbon::parse($value)->startOfDay();
    }
}
