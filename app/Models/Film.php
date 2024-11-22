<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 
class Film extends Model
{
    use HasFactory;
 
    protected $fillable = [
        'title',
        'description',
        'releaseYear',
        'languageId',
        'originalLanguageId',
        'rentalDuration',
        'rentalRate',
        'length',
        'replacementCost',
        'rating',
        'specialfeatures',
        'idDirector',
    ];
}