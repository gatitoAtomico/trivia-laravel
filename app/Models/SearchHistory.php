<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SearchHistory extends Model
{
    use HasFactory;

    protected $table = 'search_history'; // Set the table name if it's different from the default naming conventions.

    protected $fillable = [
        'full_name',
        'email',
        'number_of_questions',
        'difficulty',
        'type',
    ];

    public static function createSearchHistory($data)
    {
        $searchHistory = new self;
        $searchHistory->fill($data);
        $searchHistory->save();

        return $searchHistory; // Optionally return the created instance
    }


}
