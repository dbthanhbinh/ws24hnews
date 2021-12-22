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
    'list_of_comments' => __('Danh sách bình luận : '),
    'reply_text' => __('Trả lời'),
    'prev_text' => __('Trước : '),
    'next_text' => __('Sau : '),
    'comments_are_closed' => __('Bình luận đã được đóng'),
    'comment_notes_before' => __('Email không được công khai. Các trường được yêu cầu *'),

    'excerpt_read_more' => __('Xem thêm'),
    'other_posts' => __('Bài viết khác')
];

function getTranslateByKey($key){
    global $translates;
    return (isset($translates) && isset($translates[$key])) ? $translates[$key] : null;
}