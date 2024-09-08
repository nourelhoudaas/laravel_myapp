<?php


use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PostesController;
use App\Http\Controllers\AddEmployeControll;
use App\Http\Controllers\BioEmployeControl;
use App\Http\Controllers\UploadFile;
use App\Http\Controllers\UpdatePasswordController;
use Illuminate\Support\Facades\Route;
use App\Actions\Fortify\LoginUser;
use App\Actions\Fortify\UpdateUserPassword;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Mail;
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
    Route::get('/lang/{locale}', 'switchLanguage');
    Route::get('/about', 'about')->name('app_about');
    Route::match(['get', 'post'], '/dashboard','dashboard')
         ->middleware('auth') //pour acceder a cette page il faut s'authentifier
         ->name('app_dashboard');
});


Route::middleware('auth')->group(function () {

    Route::get('/updatePassword', function () {
        App::setLocale(Session::get('locale', config('app.locale')));
        return view('auth.updatePassword');
    })->name('password_update');

});
Route::post('/updatePassword',[UpdatePasswordController::class, 'update'])->name('password_update');

Route::get('/login', function () {
    App::setLocale(Session::get('locale', config('app.locale')));
    return view('auth.login');
})->middleware('guest')->name('login');

Route::post('/login', [LoginUser::class, 'authenticateUser'])->middleware('guest')->name('login_post');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::controller(LoginController::class)->group(function(){

   //  Route::get('/logout','logout')->name('app_logout');
    Route::post('/exist_username','existUsername')->name('app_exist_username');
    Route::post('/exist_id_nin','existIDNIN')->name('app_exist_id_nin');
    Route::post('/exist_id_p','existIDP')->name('app_exist_id_p');
   // Route::match(['get', 'post'], '/forgot_password', 'forgotPassword')->name('app_forgotPassword');
   Route::get('/forgot_password', 'forgotPassword')->name('app_forgotPassword');
    Route::post('forgot_password', 'sendResetLinkEmail');
    Route::get('/check-username','checkUsername')->name('checkUsername');
   //[app_..] nom de la route dans la page; [forgotPassword]  nom de la fonction dans le controller; [forgot_password] nom de la page dans la quelle il vas t etre renvoyer
});

Route::middleware('auth')->group(function () {
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
    Route::get('/Employe/IsTravaill/{id}','existToAdd')->name('Employe.istravaill');
    Route::get('/Employe/IsEducat/{id}','existApp')->name('Employe.iseducat');
    Route::get('/Employe/PostSups','getPostSups')->name('Employe.PostSups');
    
    Route::get('/Employe/check/{id}','find_emp')->name('find_by_nin');
    Route::get('/Employe/list_abs/{id}','get_list_absemp')->name('emp_list_abs');
    Route::get('/Employe/read_just/{id}','read_just')->name('emp_read_justif');



});
});

Route::controller(DepartmentController::class)->group(function(){

    Route::get('\add_depart/{dep_id}','AddDepart')->name('app_add_depart');

    Route::get('/liste','ListeDepart')->name('app_liste_dir');
    Route::get('/departmnet/editer/{departement}','editer')->name('departement.editer');
    Route::put('/departmnet/editer/{departement}','update')->name('departement.update');


    Route::post('/add_depart','store')->name('app_store_depart');
    Route::get('/depcount/{id}','get_emp_dep')->name('app_emp_depart');
    Route::get('/direction/{id}','get_sdic')->name('app_get_sdirection');

    Route::match(['get', 'post'], '/dashboard_depart{dep_id}','dashboard_depart')


    ->middleware('auth') //pour acceder a cette page il faut s'authentifier
    ->name('app_dashboard_depart');
   // Route::get('/department/listcontient','liste_contient')->name('liste.contient');
    Route::match(['get', 'post'], '/listcontient','liste_contient')->name('liste.contient');
    Route::get('/depart/{departement}', 'delete')->name('department.delete');


});


//Route::get('/addTemplate',[EmployeControl::class,'create'])->name('Employe.create');




//Route::get('/BioTemplate/{id}',[BioEmployeControl::class,'create'])->name('BioTemplate.index');
Route::middleware('auth')->group(function () {
    Route::post('/Employe/add',[AddEmployeControll::class,'add'])->name('add_emp_new');
    Route::post('/Employe/Travaill',[AddEmployeControll::class,'addToDep'])->name('Employe.travaill');
    Route::post('/Employe/addApp',[AddEmployeControll::class,'existToAddApp'])->name('add_emp_trav');
    Route::post('/Employe/Generat',[AddEmployeControll::class,'GenDecision'])->name('add_generer');
});
Route::middleware('auth')->group(function () {
Route::put('/BioTemplate/edit/{id}',[BioEmployeControl::class,'update'])->name('BioTemplate.update');
Route::put('/BioTemplate/add_justFile',[BioEmployeControl::class,'update_just'])->name('emp_abs_justfile');
Route::put('/BioTemplate/add_titreFile',[BioEmployeControl::class,'update_cng'])->name('emp_cng_titrefile');
Route::post('/upload/numdossiers',[UploadFile::class,'uploadFile'])->name('uploadFile');
Route::post('/upload/creedossier',[UploadFile::class,'cree_dos_sous'])->name('cree_doss_emp');
Route::get('/upload/getFiles/{id}',[UploadFile::class,'getFiles'])->name('getfile_all_emp');
Route::post('/whoiam',[UploadFile::class,'savedb'])->name('who_stocke');
Route::get('/realwhoiam/{id}',[UploadFile::class,'getname'])->name('who_name');
Route::get('/live/read/{dir}/{subdir}/{file}',[UploadFile::class,'live_File'])->name('read_file_emp');
});

//postes
Route::controller(PostesController::class)->group(function(){

   // Route::post('/postes/add_poste','addposte')->name('app_poste');
   Route::get('/add_poste', 'addposte')->name('app_poste');
   // Route::match(['get', 'post'], '/add_poste','addposte');

    Route::get('/poste','Listeposte')->name('liste_post');
    Route::post('/postes/add_poste','store')->name('app_store_poste');

    Route::get('/postes/modifier/{post}','editer')->name('modifier.post');

    Route::get('/editer/{post}','editer')->name('poste.edit');

    Route::post('/postes/update/{post}','update')->name('update.poste');



    Route::get('/post/{id_post}', 'delete')->name('post.delete');
});



Route::get('/export_dossier/{id}',[UploadFile::class,'export_fichier'])->name('export_file_emp');

