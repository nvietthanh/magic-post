<?php

use Illuminate\Database\Query\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

Builder::macro('whereLike', function($column, $value) {
    $escaped = str_replace(['\\', '_', '%'], ['\\\\', '\\_', '\\%'], $value);

    $isJapanese = preg_match('/[\x{4E00}-\x{9FBF}\x{3040}-\x{309F}\x{30A0}-\x{30FF}]/u', $value);

    if ($isJapanese && !Str::contains($column, '->')) {
        return $this->where(DB::raw("BINARY `$column`"), 'LIKE', "%$escaped%");
    } else {
        return $this->where($column, 'LIKE', "%$escaped%");
    }
});

Builder::macro('orWhereLike', function($column, $value) {
    $escaped = str_replace(['\\', '_', '%'], ['\\\\', '\\_', '\\%'], $value);

    $isJapanese = preg_match('/[\x{4E00}-\x{9FBF}\x{3040}-\x{309F}\x{30A0}-\x{30FF}]/u', $value);

    if ($isJapanese && !Str::contains($column, '->')) {
        return $this->orWhere(DB::raw("BINARY `$column`"), 'LIKE', "%$escaped%");
    } else {
        return $this->orWhere($column, 'LIKE', "%$escaped%");
    }
});