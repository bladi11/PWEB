<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    
    protected $fillable = ['title', 'course','description', 'completed', 'horario'];

    // Mutador para convertir el título a mayúsculas antes de guardarlo
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = strtoupper($value);
    }

    // Accesor para mostrar el curso con la primera letra en mayúscula
    public function getCourseAttribute($value)
    {
        return ucfirst($value);
    }

    // Accesor para mostrar la descripción con la primera letra en mayúscula
    public function getDescriptionAttribute($value)
    {
        return ucfirst($value);
    }

    // Relación con el modelo User (una tarea pertenece a un usuario)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
