<?php namespace Klaravel\Settings;

use Illuminate\Support\Facades\Cache;
use Klaravel\Settings\Models\Setting as SettingModel;

/**
 * Setting class is helper class to get set all settings 
 * from/to database
 */
class SettingHelper
{
	/**
	 * Check setting has key exits
	 * 
	 * @param  string  $key
	 * @return boolean
	 */
    public function has($key) 
    {
    	return (new SettingModel)
        	->cached()
        	->where('key', $key)
        	->count() > 0;
    }

    /**
     * Get value if key exists else it will return null
     * 
     * @param  string $key 
     * @return string|null
     */
    public function get($key) 
    {
    	if (!$this->has($key))
    		return null;

        return (new SettingModel)
        	->cached()
        	->where('key', $key)
        	->first()
        	->value;
    }

    /**
     * Store new key and value in settings if it's already
     *  exits then override.
     *  
     * @param  string $key
     * @param  string $value
     * @return null
     */
    public function put($key, $value)
    {
    	// if key exits then override
        if ($this::has($key))  {

        	$setting = (new SettingModel)
        		->cached()
        		->where('key', $key)
        		->first();

    		$setting->value = $value;
    		return $setting->save();
        }

        return SettingModel::create([
        	'key' => $key, 
        	'value' => $value
    	]);
    }

    /**
     * Delete setting data from databasse
     * 
     * @param  string $key
     * @return boolean
     */
    public function forget($key)
    {
        $isDeleted = SettingModel::where('key', $key)
        	->delete();

    	// if delete record then delete cache
    	if ($isDeleted) {
        	Cache::forget('Klaravel\Settings\Setting');
    	}

        return $isDeleted;
    }
}