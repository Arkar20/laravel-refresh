<?php

use Inertia\Inertia;
use App\Models\Podcast;
use App\Jobs\ProcessPodcast;
use App\Events\ChangeStatusPodcast;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    $podcasts = Podcast::all();

    return Inertia::render('Dashboard',compact('podcasts'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/podcasts',function(){
    Podcast::all()->each(function(Podcast $podcast){
        // Bus::chain(
        //     [
        //         Bus::batch([
        //             new ProcessPodcast($podcast),
        //             new ChangeStatusPodcast($podcast)
        //         ])

        //     ]
        // )->dispatch();



        ProcessPodcast::dispatch($podcast);


    });
    return 'success';

});
require __DIR__.'/auth.php';
