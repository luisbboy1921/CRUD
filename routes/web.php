<?php
use App\Http\Controllers\AlumnosController;
use App\Models\Alumno;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::resource('/alumnos',AlumnosController::class);//Va a genera las rutas el create el guardado el actualizar e eliminar
Route::get('/boton', [AlumnosController::class, 'boton']);
//Route::get('/alumnos/boton', [AlumnosController::class, 'boton']);


// web.php (o api.php, dependiendo de tu configuración)

//Route::get('/hello', 'HelloController@index');

//O se puede definir tambien de esta manera
//Route::get('alumnos',[AlumnosController::class,'index']);
//Route::post('alumnos/crear',[AlumnosController::class,'create']);

