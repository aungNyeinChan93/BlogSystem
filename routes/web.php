<?php

use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Route;


Route::redirect("/","list");
Route::get("list",[BlogController::class,"list"])->name("listPage");
Route::post("list",[BlogController::class,"create"])->name("create");
Route::get("delete/{blog}",[BlogController::class,"delete"])->name("delete");
Route::get("detail/{blog}",[BlogController::class,"detail"])->name("detail");
Route::get("edit/{blog}",[BlogController::class,"edit"])->name("edit");
Route::put("update/{blog}",[BlogController::class,"update"])->name("update");
