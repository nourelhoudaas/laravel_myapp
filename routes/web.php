<?php


use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\AddEmployeControll;
use App\Http\Controllers\BioEmployeControl;
use App\Http\Controllers\UploadFile;
use App\Http\Controllers\UpdatePasswordController;
use Illuminate\Support\Facades\Route;
use App\Actions\Fortify\LoginUser;
use App\Actions\Fortify\UpdateUserPassword;
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

Route::middleware('auth')->group(function () {
    Route::get('/updatePassword', function () {
        return view('auth.updatePassword');
    })->name('password_update');

});
Route::post('/updatePassword',[UpdatePasswordController::class, 'update'])->name('password_update');

Route::get('/login', function () {
    return view('auth.login');
})->middleware('guest')->name('login');

Route::post('/login', [LoginUser::class, 'authenticateUser'])->middleware('guest')->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::controller(LoginController::class)->group(function(){

   //  Route::get('/logout','logout')->name('app_logout');
    Route::post('/exist_username','existUsername')->name('app_exist_username');
    Route::post('/exist_id_nin','existIDNIN')->name('app_exist_id_nin');
    Route::post('/exist_id_p','existIDP')->name('app_exist_id_p');
    Route::match(['get', 'post'], '/forgot_password', 'forgotPassword')->name('app_forgotPassword');
    //[app_..] nom de la route dans la page; [forgotPassword]  nom de la fonction dans le controller; [forgot_password] nom de la page dans la quelle il vas t etre renvoyer
});

Route::controller(EmployeesController::class)->group(function(){
    Route::get('\liste','ListeEmply')->name('app_liste_emply');
    Route::get('/liste_abs','AbsenceEmply')->name('app_abs_emply');
    Route::get('/addTemplate/formulaire','createF')->name('app_add_emply');
    Route::get('/liste_abs_deprt/{id_dep}','listabs_depart')->name('list_abs_emply');
    Route::get('/abense_dates/{date}','absens_date')->name('list_abs_date');
    Route::get('/BioTemplate/search/{id}','getall')->name('BioTemplate.detail');
    Route::post('/add_absence','add_absence')->name('emp_add_absence');
    Route::get('/conge','list_cong')->name('emp_list_conge');
    Route::get('/check_droitcg/{id_emp}','check_cg')->name('emp_conge_check');
    Route::post('/add_emp_holiday','add_cng')->name('add_emp_hol');
    Route::get('/conge/filter/{typeconge} ', 'filterByType')->name('conge.filter');
    Route::get('/conge/filterbydep/{department} ', 'filterbydep');
    Route::get('/conge/filtercongdep/{typeconge}/{department} ', 'filtercongdep');
});

Route::controller(DepartmentController::class)->group(function(){

    Route::get('\add_depart{dep_id}','AddDepart')->name('app_add_depart');

    Route::match(['get', 'post'], '/dashboard_depart{dep_id}','dashboard_depart')
    ->middleware('auth') //pour acceder a cette page il faut s'authentifier
    ->name('app_dashboard_depart');
});


//Route::get('/addTemplate',[EmployeControl::class,'create'])->name('Employe.create');




//Route::get('/BioTemplate/{id}',[BioEmployeControl::class,'create'])->name('BioTemplate.index');
Route::post('/Employe/add',[AddEmployeControll::class,'add']);
Route::put('/BioTemplate/edit/{id}',[BioEmployeControl::class,'update'])->name('BioTemplate.update');
Route::post('/Employe/Travaill',[AddEmployeControll::class,'addToDep'])->name('Employe.travaill');
Route::get('/Employe/IsTravaill/{id}',[AddEmployeControll::class,'existToAdd'])->name('Employe.istravaill');
Route::post('/upload/numdossiers',[UploadFile::class,'uploadFile'])->name('uploadFile');
Route::post('/upload/creedossier',[UploadFile::class,'cree_dos_sous'])->name('cree_doss_emp');
Route::get('/upload/getFiles/{id}',[UploadFile::class,'getFiles'])->name('getfile_all_emp');
Route::get('/live/read/{dir}/{subdir}/{file}',[UploadFile::class,'live_File'])->name('read_file_emp');
Route::post('/Employe/addApp',[AddEmployeControll::class,'existToAddApp']);
Route::post('/Employe/Generat',[AddEmployeControll::class,'GenDecision']);
Route::get('/Employe/IsEducat/{id}',[AddEmployeControll::class,'existApp'])->name('Employe.iseducat');

