<?php
$array = array(
    'success' => true,
    'lists' => [
        'blog-left' => [
            'name' => 'منو بلاگ',
            'caption' => 'لیست های سمت چپ بلاگ',
            'id' => 'blog_left'
        ],
    ],
    'links' => [
        'post' => [
            'before' => "/blog/",
            'after' => '',
        ],
    ]
);
echo $options = json_encode($array);
