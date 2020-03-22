<?php

namespace SoftinkLab\LaravelKeyvalueStorage;

use Illuminate\Support\Facades\Storage;

class KVOptionJSON
{
    protected $fileName = 'keyvalue-storage.json';
    protected $data = array();

    public function __construct()
    {
        // Load file to array
        if (Storage::disk(config('kvstorage.disk'))->exists(config('kvstorage.path') . $this->fileName)){
            $contents = Storage::disk(config('kvstorage.disk'))->get(config('kvstorage.path') . $this->fileName);
            $this->data = json_decode($contents, true);
        }
    }

    /**
     * Determine if the given key exists.
     *
     * @param  string  $key
     * @return bool
     */
    public function exists($key) : bool
    {
        return array_key_exists($key, $this->data);
    }

    /**
     * Get the specified option by key.
     *
     * @param  string  $key
     * @param  mixed  $default
     * @return mixed
     */
    public function get($key, $default = null)
    {
        if (!array_key_exists($key, $this->data)) {
            return $default;
        }

        return $this->data[$key];
    }

    /**
     * Set a given option.
     *
     * @param  string  $key
     * @param  string   $comment
     * @param  mixed   $value
     * @return void
     * 
     */
    public function set($key, $value, $comment = null)
    {
        $this->data[$key] = $value;
        $this->setContent();
    }

    /**
     * Set given options of array.
     *
     * @param  array  $array
     * @return void
     */
    public function setArray($array)
    {
        // Multiple elements are present
        if (is_array($array[0])) {
            foreach ($array as $option) {
                $this->data[$option[0]] = $option[1];
            }
        } else {
            $option = $array;
            $this->data[$option[0]] = $option[1];
        }

        $this->setContent();
    }

    /**
     * Delete the specified option.
     *
     * @param  string  $key
     * @return bool
     */
    public function remove($key)
    {
        unset($this->data[$key]);
        $this->setContent();

        return true;
    }

    /**
     * Store the updated array in file.
     * 
     * @return void
     */
    public function setContent()
    {
        Storage::disk(config('kvstorage.disk'))->put(config('kvstorage.path') . $this->fileName, json_encode($this->data));
    }
}