<?php

use App\Livewire\Pages\About;
use App\Livewire\Pages\Blog;
use App\Livewire\Pages\Contact;
use App\Livewire\Pages\Courses;
use App\Livewire\Pages\Home;
use App\Livewire\Pages\Indicators;
use App\Livewire\Pages\TradingBotDetail;
use App\Livewire\Pages\TradingBots;
use App\Livewire\Pages\VendorProgram;
use Illuminate\Support\Facades\Route;

Route::get('/',Home::class)->name('home');

Route::get('/strategies',)->name('strategies');
Route::get('/strategy/{slug}', )->name('strategy');

Route::get('/platforms',)->name('platforms');
Route::get('/platform/{slug}', )->name('platform');

Route::get('/trading-bots',TradingBots::class)->name('trading-bots');
Route::get('/trading-bot/{slug}', TradingBotDetail::class)->name('trading-bot');

Route::get('/indicators',Indicators::class)->name('indicators');
Route::get('/indicator/{slug}', )->name('indicator');

Route::get('/vendor-program',VendorProgram::class)->name('vendor-program');

Route::get('/courses',Courses::class)->name('courses');

Route::get('/blog',Blog::class)->name('blog');
Route::get('/blog/{slug}', Home::class)->name('blog.post');

Route::get('/about',About::class)->name('about');
Route::get('/contact',Contact::class)->name('contact');


