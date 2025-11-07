<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class History extends Model {
    protected $fillable = ['category_id', 'title', 'slug', 'content', 'image', 'event_date', 'location', 'is_published'];
    public function category() {
        return $this->belongsTo(Category::class);
    }
}
