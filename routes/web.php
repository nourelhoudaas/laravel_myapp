<?php

use App\Http\controllers\HomeController;
use App\Http\controllers\LoginController;
use App\Http\controllers\EmployeesController;
use App\Http\controllers\DepartmentController;
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
    Route::post('/exist_email','existEmail')->name('app_exist_email');
    Route::post('/exist_username','existUsername')->name('app_exist_username');
    Route::match(['get', 'post'], '/activation_code/{token}','activationCode')->name('app_activation_code');
    Route::get('/user_checker','userChecker')->name('app_user_checker');
    Route::get('/resend_activation_code/{token}','resendActivateCode')->name('app_resend_activation_code');
    Route::get('/activation_account_link/{token}','activationAccountLink')->name('app_activation_account_link');
    Route::match(['get', 'post'],'/activation_account_change_email/{token}','activateAccountChangeEmail')->name('app_activation_account_change_email');
    Route::match(['get', 'post'], '/forgot_password', 'forgotPassword')->name('app_forgotPassword');
    //[app_..] nom de la route dans la page; [forgotPassword]  nom de la fonction dans le controller; [forgot_password] nom de la page dans la quelle il vas t etre renvoyer
});

Route::controller(EmployeesController::class)->group(function(){
    Route::get('\liste','ListeEmply')->name('app_liste_emply');
    Route::get('\add','AddEmply')->name('app_add_emply');
});

Route::controller(DepartmentController::class)->group(function(){
    Route::get('\list_depart','ListeDepart')->name('app_depart');
});
