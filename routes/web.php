<?php

use App\Http\Controllers\HerbaMonstrumController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('login');
});
Route::get('home', function () {
    return view('home');
});

Route::get('/nuovaPrenotazione', function () {
    return view('nuovaPrenotazione');
});


Route::post('checklogin', [HerbaMonstrumController::class,  'checklogin']);
Route::get('successlogin', [HerbaMonstrumController::class,  'successlogin']);

Route::get('/main', [HerbaMonstrumController::class,  'index']);
Route::get('logout',  [HerbaMonstrumController::class,  'logout']);
Route::get('/orari/{sala}', [HerbaMonstrumController::class,  'orariSala']);
Route::get('/tavoli/{dataPrenotazione}/{oraInizio}/{sala}', [HerbaMonstrumController::class,  'tavoliDataOraSala']);
Route::get('/capienza/{idTavolo}', [HerbaMonstrumController::class,  'capienza']);
Route::post('/prenota/nuova', [HerbaMonstrumController::class,  'prenota'])->name('prenota.nuova');
Route::get('/prenota/{dataPrenotazione}/{oraInizio}/{idSala}', [HerbaMonstrumController::class,  'prenotaInDataOrasala']);
Route::put('/modificaPrenotazione/{idPrenotazione}', [HerbaMonstrumController::class,  'modificaPrenotazione'])->name('prenota.edit');;
Route::get('/prenotazioni', [HerbaMonstrumController::class,  'prenotazioni']);
Route::get('/datePrenotazioni', [HerbaMonstrumController::class,  'datePrenotazioni']);
Route::get('/orari/{idsala}', [HerbaMonstrumController::class,  'orarioSala']);
Route::get('/prenotazioni/{dataPrenotazione}/{oraInizio}/{idSala}', [HerbaMonstrumController::class,  'prenotazioniDataOraSala']);
Route::get('/prenotazione/{idPrenotazione}', [HerbaMonstrumController::class,  'getPrenotazione']);
Route::get('/prenotazioneUpdate/{idPrenotazione}', [HerbaMonstrumController::class,  'prenotazioneId']);
Route::get('/tavoliPerId/{idPrenotazione}/{idSala}', [HerbaMonstrumController::class,  'tavoliPerId']);
Route::get('/tavoliData/{dataPrenotazione}/{oraInizio/}{idSala}', [HerbaMonstrumController::class,  'tavoliDataOraSala']);
Route::get('/cancellaPrenotazione/{idPrenotazione}', [HerbaMonstrumController::class,  'cancellaPrenotazione']);
