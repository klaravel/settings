<?php

namespace Klaravel\Settings\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    protected $fillable = ['key', 'value'];

    //Big block of caching functionality.
    public function cached()
    {
        // check cache is available else set cache and return
        return Cache::get('Klaravel\Settings\Setting', function () {
            $data = $this->get();
            Cache::put('Klaravel\Settings\Setting', $data, 60 * 24);

            return $data;
        });
    }
    public function save(array $options = [])
    {   //both inserts and updates
        parent::save($options);

        // delete cache
        Cache::forget('Klaravel\Settings\Setting');
    }
    public function delete(array $options = [])
    {   //soft or hard
        parent::delete($options);

        // delete cache
        Cache::forget('Klaravel\Settings\Setting');
    }
    public function restore()
    {   //soft delete undo's
        parent::restore();

        // delete cache
        Cache::forget('Klaravel\Settings\Setting');
    }
}
