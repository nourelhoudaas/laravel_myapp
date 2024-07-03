<?php

use App\Http\controllers\HomeController;
use App\Http\controllers\LoginController;
use App\Http\controllers\EmployeesController;
use App\Http\controllers\DepartmentController;
use App\Http\controllers\AddEmployeControll;
use App\Http\controllers\BioEmployeControl;
use App\Http\controllers\EmployeControl;
use App\Http\controllers\UploadFile;
use Illuminate\Support\Facades\Route;

/*
Formulaires de connexion/inscription: Utiliser Route::match(['get', 'post']) pour permettre l'affichage du formulaire (GET) et le traitement des données soumises (POST).
Affichage de données: Utiliser Route::get() pour des pages où les utilisateurs consultent simplement les données (comme des profils, des pages d'articles, des tableaux de bord, etc.).
-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
En résumé, utilisez Route::get() lorsque vous avez besoin de gérer uniquement les requêtes GET pour afficher des ressources.
Utilisez Route::match(['get', 'post'])  lorsque vous avez besoin de la flexibilité pour gérer à la fois l'affichage initial
et la soumission des formulaires ou d'autres interactions nécessitant à la fois GET et POST.
*/

Route::controller(HomeController::class)->group(function(){
    Route::get('/','home')->name('app_home');
    Route::get('/about', 'about')->name('app_about');
    Route::match(['get', 'post'], '/dashboard','dashboard')
         ->middleware('auth') //pour acceder a cette page il faut s'authentifier
         ->name('app_dashboard');
});

Route::controller(LoginController::class)->group(function(){
    Route::get('/logout','logout')->name('app_logout');
    Route::post('/exist_username','existUsername')->name('app_exist_username');
    Route::post('/exist_id_nin','existIDNIN')->name('app_exist_id_nin');
    Route::post('/exist_id_p','existIDP')->name('app_exist_id_p');
    Route::match(['get', 'post'], '/forgot_password', 'forgotPassword')->name('app_forgotPassword');
    //[app_..] nom de la route dans la page; [forgotPassword]  nom de la fonction dans le controller; [forgot_password] nom de la page dans la quelle il vas t etre renvoyer
});

Route::controller(EmployeesController::class)->group(function(){
    Route::get('\liste','ListeEmply')->name('app_liste_emply');
    Route::get('\addTemplate/formulaire','createF')->name('app_add_emply');
    Route::get('\liste_abs','AbsenceEmply')->name('app_abs_emply');
    Route::get('\/BioTemplate/search/{id}','getall')->name('BioTemplate.detail');

});

Route::controller(DepartmentController::class)->group(function(){
    Route::get('\add_depart','AddDepart')->name('app_add_depart');
    Route::get('\list_depart','ListeDepart')->name('app_depart');
    Route::match(['get', 'post'], '/dashboard_depart{dep_id}','dashboard_depart')
    ->middleware('auth') //pour acceder a cette page il faut s'authentifier
    ->name('app_dashboard_depart');
});

//Route::get('/BioTemplate/{id}',[BioEmployeControl::class,'create'])->name('BioTemplate.index');
Route::post('/Employe/add',[AddEmployeControll::class,'add']);
Route::put('/BioTemplate/edit/{id}',[BioEmployeControl::class,'update'])->name('BioTemplate.update');
Route::post('/Employe/Travaill',[AddEmployeControll::class,'addToDep'])->name('Employe.travaill');
Route::get('/Employe/IsTravaill/{id}',[AddEmployeControll::class,'existToAdd'])->name('Employe.istravaill');
Route::post('/upload/numdossiers',[UploadFile::class,'uploadFile'])->name('uploadFile');
