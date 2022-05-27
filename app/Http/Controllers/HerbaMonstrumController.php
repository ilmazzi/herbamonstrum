<?php
namespace App\Http\Controllers;


use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Auth;
use App\Models\Orario;
use App\Models\Prenotazione;
use App\Models\PrenotazioneTavolo;
use App\Models\Tavolo;
use App\Models\TavoloLibero;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Support\Facades\DB;

class HerbaMonstrumController extends Controller
{
    

    function index()
    {
     return view('login');
    }

    function checklogin(Request $request)
    {
     $this->validate($request, [
      'username'   => 'required',
      'password'  => 'required|alphaNum|min:3'
     ]);

     $user_data = array(
      'name'  => $request->get('username'),
      'password' => $request->get('password')
     );

     if(Auth::attempt($user_data)) 
     {
      return redirect('successlogin');
     }
     else
     {
      return back()->with('error', 'Wrong Login Details');
     }

    }

    function successlogin()
    {
     return view('home');
    }

    function logout()
    {
     Auth::logout();
     return redirect('main');
    }


    function orariSala($idSala){

        $clausule = ['idSala' => $idSala];

        $orari = Orario::where($clausule)
        ->get();

        return $orari;
    }
function tavoliDataOraSala($dataPrenotazione, $oraInizio, $sala){
    $idPrenotazioni = array();
    $clausule = ['dataPrenotazione' => $dataPrenotazione,  'eliminata' => false, 'sala' => $sala];
    $prenotazioni = Prenotazione::where($clausule)->where('oraFine', '>=', $oraInizio)
    ->get();

  
    $tavoli = array();
   

    if ($prenotazioni->isEmpty()){

        return DB::table('tavoli')
        ->leftJoin('prenotazione_tavolo', function ($join) use($idPrenotazioni) {
            $join->on('prenotazione_tavolo.tavolo', '=', 'tavoli.idTavolo')
            ->whereIn('prenotazione_tavolo.prenotazione_id',  $idPrenotazioni);
        })
        ->select(Tavolo::raw('tavoli.*,  case when prenotazione_tavolo.postiRimanenti is null then tavoli.capienza else prenotazione_tavolo.postiRimanenti end as postiRimanenti '))
        ->where('tavoli.sala', $sala)
        ->get();
    } else {
        foreach ($prenotazioni as $prenotazione){
            
           array_push($idPrenotazioni,$prenotazione->idPrenotazione );
          $tavolo =  TavoloLibero::where('prenotazione_id', $prenotazione->idPrenotazione)->select('tavolo')->get();
          if (!empty($tavolo)){
          foreach($tavolo as $t){
        array_push($tavoli, $t->tavolo); 
    }
  
       }
          
            
         }
         
         if(empty($tavoli)){

            return DB::table('tavoli')
            ->leftJoin('prenotazione_tavolo', function ($join) use($idPrenotazioni) {
                $join->on('prenotazione_tavolo.tavolo', '=', 'tavoli.idTavolo')
                ->whereIn('prenotazione_tavolo.prenotazione_id',  $idPrenotazioni);
            })
            ->select(Tavolo::raw('tavoli.*,  case when prenotazione_tavolo.postiRimanenti is null then tavoli.capienza else prenotazione_tavolo.postiRimanenti end as postiRimanenti '))
            ->where('tavoli.sala', $sala)
            ->get();


        } else  {

            return DB::table('tavoli')->leftJoin('prenotazione_tavolo', function ($join) use($idPrenotazioni) {
                $join->on('prenotazione_tavolo.tavolo', '=', 'tavoli.idTavolo')
                ->whereIn('prenotazione_tavolo.prenotazione_id',  $idPrenotazioni);
            })->whereNotIn('idTavolo', $tavoli)
            ->where('tavoli.sala', $sala)
            ->select(Tavolo::raw('tavoli.*,  case when prenotazione_tavolo.postiRimanenti is null then tavoli.capienza else prenotazione_tavolo.postiRimanenti end as postiRimanenti '))
            ->get();

        }

} 
    
}

function prenota(Request $request){
    Debugbar::info(json_encode($request));
    $p = new Prenotazione();
    $p->nomePrenotazione = $request->get('nomePrenotazione');
    $p->dataPrenotazione = $request->get('dataPrenotazione');
    $p->sala = $request->get('sala');
    $p->coperti = $request->get('coperti');
    $p->oraInizio = $request->get('oraInizio');
    $p->oraFine = $request->get('oraFine');
    $p->oraInizio = $request->get('oraInizio');
    $p->note = $request->get('note');
    $p->telefono = $request->get('telefono');
    $p->numeroBambini = $request->get('numeroBambini');
    $p->attiva = 1;
    $p->save();
    $id = $p->id;


    foreach($request->get('tavoli') as $tavolo){


        $nomeTavolo = Tavolo::where('idTavolo', $tavolo)->value('tavolo');
        $checkCapienzaTavolo  = PrenotazioneTavolo::whereRaw( 'ADDTIME("'.$p->oraInizio.'", "02:00:00") <= oraFine')
                                ->where(['tavolo'=> $tavolo, 'dataPrenotazione' => $p->dataPrenotazione])->sum('postiOccupati');
        if(empty($checkCapienzaTavolo)){
            $capienza = Tavolo::where('idTavolo', $tavolo)->value('capienza');
        } else {
            $capienza =  (Tavolo::where('idTavolo', $tavolo)->value('capienza') - $checkCapienzaTavolo); 

        }
                              
        

        $p->tavoli()->saveMany([ 
            new PrenotazioneTavolo(['tavolo' => $tavolo, 'prenotazione_id' => $id, 'postiOccupati' =>$p->coperti, 'sala' =>$p->sala, 'nomeTavolo' => $nomeTavolo, 'postiRimanenti' => $capienza - $p->coperti , 'dataPrenotazione' => $p->dataPrenotazione, 'oraInizio' => $p->oraInizio, 'oraFine' => $p->oraFine]),  
        ]);
    }
   
    
    return redirect('prenotazioni')->with('inserita','Prenotazione inserita correttamente'); 

}


public function prenotazioni(){

    return view('prenotazioni');
}


public function datePrenotazioni(){

   return Prenotazione::where('dataPrenotazione', '>=', today())->orderBy('dataPrenotazione','DESC')->distinct()->select('dataPrenotazione')->get();
}

public function orarioSala($idSala)
{
return Orario::where('idSala' , $idSala)->get();

}

function prenotazioniDataOraSala($dataPrenotazione, $oraInizio, $idSala){
    $limitePrenotazioniPerIntervallo = 15;
$totaleCoperti = Prenotazione::where(['dataPrenotazione' => $dataPrenotazione, 'oraInizio' => $oraInizio, 'sala' => $idSala])->sum('coperti');
if($totaleCoperti <= $limitePrenotazioniPerIntervallo){
   $postiLiberi = 0;

} else {
    $postiLiberi = 1;
}

$prenotazioni = Prenotazione::with('tavoli')->where(['dataPrenotazione' => $dataPrenotazione, 'oraInizio' => $oraInizio, 'sala' => $idSala])->get();

return (['postiLiberi' => $postiLiberi,'prenotazione' => $prenotazioni]);

}

function getPrenotazione($idPrenotazione){
return Prenotazione::find($idPrenotazione);

}


function prenotazioneId($idPrenotazione){

    $prenotazione = Prenotazione::with('tavoli')->find($idPrenotazione); 
    DebugBar::info($prenotazione);
    return view('prenota')->with('prenotazione', $prenotazione);
}


function tavoliPerId($idPrenotazione, $idSala){
    $tavoli = PrenotazioneTavolo::where(['prenotazione_id' => $idPrenotazione, 'sala' => $idSala])->select('tavolo')->get(); 

    return DB::table('tavoli')->leftJoin('prenotazione_tavolo', function ($join) {
        $join->on('prenotazione_tavolo.tavolo', '=', 'tavoli.idTavolo');
    })
    ->where('tavoli.sala' ,$idSala)
    ->whereIn('tavoli.idTavolo', $tavoli)
    ->select(Tavolo::raw('tavoli.*,  case when prenotazione_tavolo.postiRimanenti is null then tavoli.capienza else prenotazione_tavolo.postiRimanenti end as postiRimanenti '))
    ->get();

}

function modificaPrenotazione(Request $request, $idPrenotazione){


Debugbar::info(json_encode($request));
    $p = Prenotazione::find($idPrenotazione);
    $p->nomePrenotazione = $request->get('nomePrenotazione');
    $p->dataPrenotazione = $request->get('dataPrenotazione');
    $p->sala = $request->get('sala');
    $p->coperti = $request->get('coperti');
    $p->oraInizio = $request->get('oraInizio');
    $p->oraFine = $request->get('oraFine');
    $p->oraInizio = $request->get('oraInizio');
    $p->note = $request->get('note');
    $p->telefono = $request->get('telefono');
    $p->numeroBambini = $request->get('numeroBambini');
    $p->attiva = 1;
    $p->save();
    $id = $p->id;

    foreach ($p->tavoli as $tavolo) {
        $tavolo->delete();
    }


    foreach($request->get('tavoli') as $tavolo){


        $nomeTavolo = Tavolo::where('idTavolo', $tavolo)->value('tavolo');
        $checkCapienzaTavolo  = PrenotazioneTavolo::whereRaw( 'ADDTIME("'.$p->oraInizio.'", "02:00:00") <= oraFine')
                                ->where(['tavolo'=> $tavolo, 'dataPrenotazione' => $p->dataPrenotazione])->sum('postiOccupati');
        if(empty($checkCapienzaTavolo)){
            $capienza = Tavolo::where('idTavolo', $tavolo)->value('capienza');
        } else {
            $capienza =  (Tavolo::where('idTavolo', $tavolo)->value('capienza') - $checkCapienzaTavolo); 

        }
                          
        

        $p->tavoli()->saveMany([ 
            new PrenotazioneTavolo(['tavolo' => $tavolo, 'prenotazione_id' => $id, 'postiOccupati' =>$p->coperti, 'sala' =>$p->sala, 'nomeTavolo' => $nomeTavolo, 'postiRimanenti' => $capienza - $p->coperti , 'dataPrenotazione' => $p->dataPrenotazione, 'oraInizio' => $p->oraInizio, 'oraFine' => $p->oraFine]),  
        ]);
}
return view('prenotazioni')->with('inserita','Prenotazione modificata correttamente'); 
}

function prenotaInDataOrasala($dataPrenotazione, $oraInizio, $idSala){
    
    $ora = Orario::where('idOrario', $oraInizio)->value('orario');
      
      $date = \Carbon\Carbon::parse($dataPrenotazione);
      $nuovaData = $date->format('d-m-Y');
  
      return view('nuovaPrenotazione',['dataPrenotazione' => $dataPrenotazione, 'oraInizio' => $ora, 'idSala' => $idSala]);
      
  }

  function cancellaPrenotazione ($idPrenotazione){
    $p =  Prenotazione::find($idPrenotazione);

    $p->eliminata = 1;
    $p->save();

  }

}


