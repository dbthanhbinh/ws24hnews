<?php
$translates = [
    'search_btn' => __('Tìm'),
    'search_placeholder' => __('Tìm...'),
    'services' => __('Dịch vụ'),
    'open_time' => __('Mở cửa: '),
    
    'comment_author' => __( 'Tên' ),
    'comment_author_email' => __('Email'),
    'your_comments' => __('Bình luận của bạn'),
    'send_comment' => __('Gửi bình luận'),
    'write_your_comments' => __('Viết bình luận (*)'),

    'other_posts' => __('Bài viết khác')
];

function getTranslateByKey($key){
    global $translates;
    return (isset($translates) && isset($translates[$key])) ? $translates[$key] : null;
}