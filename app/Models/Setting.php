<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jackiedo\DotenvEditor\Facades\DotenvEditor;

class Setting extends Model
{
    use HasFactory;
    public $timestamps = false;

    public static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub
        self::saved(function ($model) {
            if ($model->is_env) {
                DotenvEditor::setKey(strtoupper($model->key), $model->value);
                DotenvEditor::save();
            }
        });
    }

    /**
     * Transform the value from database to the correct format.
     *
     * @return bool|mixed
     */
    public function decodeValue()
    {
        switch ($this->key) {
            case 'app_logo':
                return Custom::getLogo();
            case 'app_bg_authentication':
                return Custom::getBgAuthentication();
            default:
                return $this->value;
        }
    }
}