<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    public function type()
    {
        return $this->belongsTo(Type::class);

    }

    public function Technologies()
    {
        return $this->belongsToMany(Technology::class);
    }

    public function getTypeBadge()
    {
        return $this->type ? "<span class='badge' style='background-color: {$this->type->color}'>{$this->type->label}</span>" : "Undefined";
    }

    public function getTechnologyBadges()
    {
        $badges = "";
        foreach ($this->technologies as $technology) {
            $badges .= "<span class='badge mx-1' style='background-color: {$technology->color}'>{$technology->label}</span>";
        }
        return $badges;
    }
}