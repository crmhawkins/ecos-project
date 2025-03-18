<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/blog_single', function () {
    return view('blog_single');
});

Route::get('/blog', function () {
    return view('blog');
});

Route::get('/cart', function () {
    return view('cart');
});

Route::get('/checkout', function () {
    return view('checkout');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/course_sidebar', function () {
    return view('course-sidebar');
});

Route::get('/course', function () {
    return view('course');
});

Route::get('/course2', function () {
    return view('course2');
});

Route::get('/course3', function () {
    return view('course3');
});

Route::get('/error', function () {
    return view('error');
});

Route::get('/event_single', function () {
    return view('event_single');
});

Route::get('/event', function () {
    return view('event');
});

Route::get('/faq', function () {
    return view('faq');
});

Route::get('/index_2', function () {
    return view('index_2');
});

Route::get('/index_3', function () {
    return view('index_3');
});

Route::get('index', function () {
    return view('index');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/register', function () {
    return view('register');
});

Route::get('/shop', function () {
    return view('shop');
});

Route::get('/single_course', function () {
    return view('single_course');
});

Route::get('/single_shop', function () {
    return view('single_shop');
});

Route::get('/team-details', function () {
    return view('team-details');
});

Route::get('/team', function () {
    return view('team');
});

Route::get('/thank_you', function () {
    return view('thank-you');
});
