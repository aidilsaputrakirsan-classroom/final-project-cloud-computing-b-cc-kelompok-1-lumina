<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Category extends Model {
    protected $fillable = ['name', 'slug', 'description', 'icon', 'is_active'];
    public function histories() {
        return $this->hasMany(History::class);
    }
}
