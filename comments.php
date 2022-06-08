<?php 

if(comments_open()){
$comments_arguments = array(
    'max_depth' => 2,
    'type'      => 'comment',
    'avatar_size'       => 60,
);
wp_list_comments($comments_arguments);

$comment_form_arguments = array(

'fields' => array(
    'auther' => '<div class="form-singel"><input type="text" placeholder="Name"></div>',
    'email'  => '<div class="form-singel"><input type="email" placeholder="email"></div>',
    'url'  => '<div class="form-singel"><textarea placeholder="Comment"></textarea></div>',
),
'comment_field' => '<div class="form-singel"><textarea placeholder="Comment" name="comment"></textarea></div>',
'submit_button' => '<div class="form-singel"><button class="main-btn">Submit</button></div>',

);
comment_form($comment_form_arguments);
}else{
echo 'Comments are closed';
}
?>