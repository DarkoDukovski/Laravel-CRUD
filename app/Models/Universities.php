<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Universities extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'country', 'alpha_two_code', 'domain', 'web_page'
    ];
}