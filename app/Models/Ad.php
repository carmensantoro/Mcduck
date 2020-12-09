<?php

namespace App\Models;

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Scout\Searchable;

class Ad extends Model
{

    use Searchable;   
    use HasFactory;
    protected $fillable = ['title', 'body', 'price', 'category_id'];
    
    public function toSearchableArray()
    {
        // $array = $this->toArray();
        // $annuncio = $this->ads->pluck('name')->join(', ');
        // Customize array ad esepio cosi
        $category = $this->category->name;
        $array = [
            // è obbligatorio mettere l'id
            'id' => $this->id,
            'title' => $this->title,
            'body' => $this->body,
            'category' => $category,
        ];
        
        return $array;
    }

    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
