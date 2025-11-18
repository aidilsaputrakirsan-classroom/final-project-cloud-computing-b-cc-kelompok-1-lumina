<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use App\Models\Destination;
use App\Models\Category;
use App\Models\History;

class SearchController extends Controller
{
    // Pilih kolom yang tersedia dari kandidat
    protected function pickColumn(array $candidates, string $table)
    {
        foreach ($candidates as $col) {
            if (Schema::hasColumn($table, $col)) {
                return $col;
            }
        }
        return null;
    }

    public function search(Request $request)
    {
        $keyword = trim($request->query('query', ''));

        if ($keyword === '') {
            return view('search.result', [
                'keyword'  => '',
                'wisata'   => collect(),
                'sejarah'  => collect(),
                'category' => collect(),
            ]);
        }

        $limit = 50;
        $results = [
            'wisata'   => collect(),
            'sejarah'  => collect(),
            'category' => collect(),
        ];

        // Pastikan tabel ada sebelum query
        if (Schema::hasTable('destinations')) {
            $destNameCol = $this->pickColumn(['nama_tempat', 'name', 'title', 'judul'], 'destinations');
            $destDescCol = $this->pickColumn(['deskripsi','description','content'], 'destinations');

            if ($destNameCol || $destDescCol) {
                $q = Destination::query();
                if ($destNameCol) $q->where($destNameCol, 'ILIKE', "%{$keyword}%");
                if ($destDescCol) {
                    if ($destNameCol) $q->orWhere($destDescCol, 'ILIKE', "%{$keyword}%");
                    else $q->where($destDescCol, 'ILIKE', "%{$keyword}%");
                }
                $results['wisata'] = $q->limit($limit)->get();
            }
        }

        if (Schema::hasTable('histories')) {
            $histTitle = $this->pickColumn(['title','name','judul'], 'histories');
            $histContent = $this->pickColumn(['content','deskripsi','description'], 'histories');

            if ($histTitle || $histContent) {
                $q = History::query();
                if ($histTitle) $q->where($histTitle, 'ILIKE', "%{$keyword}%");
                if ($histContent) {
                    if ($histTitle) $q->orWhere($histContent, 'ILIKE', "%{$keyword}%");
                    else $q->where($histContent, 'ILIKE', "%{$keyword}%");
                }
                $results['sejarah'] = $q->limit($limit)->get();
            }
        }

        if (Schema::hasTable('categories')) {
            $catName = $this->pickColumn(['name','nama_kategori','kategori','title'], 'categories');
            if ($catName) {
                $results['category'] = Category::where($catName, 'ILIKE', "%{$keyword}%")
                    ->limit($limit)->get();
            }
        }

        return view('search.result', [
            'keyword'  => $keyword,
            'wisata'   => $results['wisata'],
            'sejarah'  => $results['sejarah'],
            'category' => $results['category'],
        ]);
    }

    public function autosuggest(Request $request)
    {
        $keyword = trim($request->query('query', ''));

        if ($keyword === '' || strlen($keyword) < 2) {
            return response()->json([]);
        }

        $limit = 5;
        $out = [];

        if (Schema::hasTable('destinations')) {
            $destNameCol = $this->pickColumn(['nama_tempat', 'name', 'title', 'judul'], 'destinations');
            if ($destNameCol) {
                $rows = Destination::where($destNameCol, 'ILIKE', "%{$keyword}%")
                    ->limit($limit)->get();
                foreach ($rows as $r) {
                    $out[] = [
                        'type' => 'wisata',
                        'name' => $r->{$destNameCol},
                        'id'   => $r->slug ?? $r->id
                    ];
                }
            }
        }

        if (Schema::hasTable('histories')) {
            $histTitle = $this->pickColumn(['title','name','judul'], 'histories');
            if ($histTitle) {
                $rows = History::where($histTitle, 'ILIKE', "%{$keyword}%")
                    ->limit($limit)->get();
                foreach ($rows as $r) {
                    $out[] = [
                        'type' => 'sejarah',
                        'name' => $r->{$histTitle},
                        'id'   => $r->slug ?? $r->id
                    ];
                }
            }
        }

        if (Schema::hasTable('categories')) {
            $catName = $this->pickColumn(['name','nama_kategori','kategori','title'], 'categories');
            if ($catName) {
                $rows = Category::where($catName, 'ILIKE', "%{$keyword}%")
                    ->limit($limit)->get();
                foreach ($rows as $r) {
                    $out[] = [
                        'type' => 'category',
                        'name' => $r->{$catName},
                        'id'   => $r->id
                    ];
                }
            }
        }

        return response()->json($out);
    }
}
