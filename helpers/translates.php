<?php
$translates = [
    'search_btn' => __('Tìm', THEMENAME),
    'search_placeholder' => __('Tìm...', THEMENAME),
    'services' => __('Dịch vụ', THEMENAME),
    'open_time' => __('Mở cửa: ', THEMENAME),
    
    'comment_author' => __( 'Tên', THEMENAME),
    'comment_author_email' => __('Email', THEMENAME),
    'your_comments' => __('Bình luận của bạn', THEMENAME),
    'send_comment' => __('Gửi bình luận', THEMENAME),
    'write_your_comments' => __('Viết bình luận (*)', THEMENAME),
    'list_of_comments' => __('Danh sách bình luận : ', THEMENAME),
    'reply_text' => __('Trả lời', THEMENAME),
    'prev_text' => __('Trước : ', THEMENAME),
    'next_text' => __('Sau : ', THEMENAME),
    'comments_are_closed' => __('Bình luận đã được đóng', THEMENAME),
    'comment_notes_before' => __('Email không được công khai. Các trường được yêu cầu *', THEMENAME),

    'excerpt_read_more' => __('Xem thêm', THEMENAME),
    'other_posts' => __('Bài viết khác', THEMENAME)
];

function getTranslateByKey($key){
    global $translates;
    return (isset($translates) && isset($translates[$key])) ? $translates[$key] : null;
}