<?php

namespace App\Repositories;

use App\Models\User;

class BaseRepository
{
    const MODEL = User::class;

    public function optionQuery($options, $query = null)
    {
        if (is_null($query)) {
            $query = $this->query();
        }
        foreach ($options as $key => $option) {
            if (is_array($option)) {
                if (strtolower($option[1]) == "in") {
                    $query->whereIn($option[0], $option[2]);
                } else {
                    $query->where($option[0], $option[1], $option[2]);
                }
            } else {
                $query->where($key, $option);
            }
        }
        return $query;
    }

    public function find($id, $options = [])
    {
        $query = $this->optionQuery($options);
        return $query->find($id);
    }

    public function create($attributes = [])
    {
        return $this->query()->create($attributes);
    }

    public function update($id, $options = [], $attributes = [])
    {
        $result = $this->find($id, $options);
        if ($result) {
            $result->update($attributes);

            return $result;
        }
        return false;
    }

    public function query()
    {
        return call_user_func(static::MODEL . '::query');
    }
}
