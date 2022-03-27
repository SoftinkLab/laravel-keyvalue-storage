<?php

namespace SoftinkLab\LaravelKeyvalueStorage;

use Illuminate\Database\Eloquent\Model;

class KVOption extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    public function getTable()
    {
        return config('kvstorage.table_name');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var [type]
     */
    protected $fillable = [
        'key',
        'value',
        'comment',
    ];

    /**
     * Determine if the given key exists.
     *
     * @param  string  $key
     * @return bool
     */
    public function exists($key)
    {
        return $this->where('key', $key)->exists();
    }

    /**
     * Get the specified option by key.
     *
     * @param  string  $key
     * @param  mixed   $default
     * @return mixed
     */
    public function get($key, $default = null)
    {
        if ($option = $this->where('key', $key)->first()) {
            return $option->value;
        }

        return $default;
    }

    /**
     * Set a given option.
     *
     * @param  string  $key
     * @param  string  $comment
     * @param  mixed   $value
     * @return void
     */
    public function set($key, $value, $comment = null)
    {
        if ($comment == null) {
            $this->updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        } else {
            $this->updateOrCreate(
                ['key' => $key],
                ['value' => $value, 'comment' => $comment]
            );
        }
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
                // Check if comment is available.
                if (count($option) == 2) {
                    $this->updateOrCreate(
                        ['key' => $option[0]],
                        ['value' => $option[1]]
                    );
                } else {
                    $this->updateOrCreate(
                        ['key' => $option[0]],
                        ['value' => $option[1], 'comment' => $option[2]]
                    );
                }
            }
        } else {
            $option = $array;
            // Check if comment is available.
            if (count($option) == 2) {
                $this->updateOrCreate(
                    ['key' => $option[0]],
                    ['value' => $option[1]]
                );
            } else {
                $this->updateOrCreate(
                    ['key' => $option[0]],
                    ['value' => $option[1], 'comment' => $option[2]]
                );
            }
        }
    }

    /**
     * Increment a value from the options.
     *
     * @param string $key
     * @param int    $factor
     *
     * @return int|null|string
     */
    public function incrementValue($key, int $factor = 1)
    {
        $currentValue = $this->get($key) ?? 0;
        $newValue = $currentValue + $factor;

        $this->updateOrCreate(
            ['key' => $key],
            ['value' => $newValue]
        );

        return $newValue;
    }

    /**
     * Decrement a value from the options.
     *
     * @param string $key
     * @param int    $factor
     *
     * @return int|null|string
     */
    public function decrementValue($key, int $factor = 1)
    {
        $currentValue = $this->get($key) ?? 0;
        $newValue = $currentValue - $factor;

        $this->updateOrCreate(
            ['key' => $key],
            ['value' => $newValue]
        );

        return $newValue;
    }

    /**
     * Delete the specified option.
     *
     * @param  string  $key
     * @return bool
     */
    public function remove($key)
    {
        return (bool) $this->where('key', $key)->delete();
    }
}
