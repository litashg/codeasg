<?php
/**
 * @author Eugene Terentev <eugene@terentev.net>
 */

$cache = [
    'class' => yii\caching\FileCache::class,
    'cachePath' => '@frontend/runtime/cache'
];

return $cache;
