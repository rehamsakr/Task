# Laravel Task

## Task Requirements
create Laravel blog project  with auth, module Posts  with comments
- custom route: dashboard
- Posts [ id, title, author, content,image, date , soft delete ]
- comments [id, post_id, user_id, comment, date, soft delete]
- laravel bootstrap auth ui
- Post validation => title unique, image with image type [ png, jpg, webp ] and max size for upload 2M, content Minimum number of letters 20
- Comment Validation => user_id,post_id, comment Minimum
- image => return path with name from model    
  * example appends name (image_for_web)
- date  => custom format return from model     
    * example appends date (date_for_web )
- helper function for uploading image
- Post insert and update with validation
- Post with soft delete
- delete comment with post
- 404 custom page

## Installation
1) Clone Repo
2) Make a copy file `.evn.example` to `.env` using command `cp .env.example .env`
3) Set the DB config in the `.env` file
4) Run the command `composer update`
5) Run the command `php artisan key:generate`
6) Run the command `php artisan migrate --seed`

## Admin Login
- url [your_url/login]
- email [admin@admin.com]
- password [123456]
