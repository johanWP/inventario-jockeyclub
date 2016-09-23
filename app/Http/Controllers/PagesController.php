<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    public function home()
    {
        $bienvenida = [
            ['autor' =>'San Francisco de Asis', 'frase' => 'Comienza haciendo lo que es necesario, después lo que es posible y de repente estarás haciendo lo imposible.'],
            ['autor' =>'Platón', 'frase' => 'Todas las cosas serán producidas en superior cantidad y calidad, y con mayor facilidad, cuando cada hombre trabaje en una sola ocupación, de acuerdo con sus dones naturales, y en el momento adecuado, sin inmiscuirse en nada más.'],
            ['autor' =>'Walt Disney', 'frase' => 'La forma de empezar es dejar de hablar y empezar a hacerlo.'],
            ['autor' =>'Steve Jobs', 'frase' => 'Tu trabajo va a llenar buena parte de tu vida, y la única manera de estar realmente satisfecho contigo mismo es hacer lo que creas que es un trabajo fantástico. Y la única manera de hacer un trabajo fantástico es amar lo que haces. Y si todavía no lo has encontrado, sigue buscando. No te rindas. Cuando lo encuentres, te darás cuenta, desde lo más profundo de tu corazón, que lo has encontrado.'],
            ['autor' =>'Frank Sinatra', 'frase' => 'La gente a menudo comentan que soy muy afortunado. La suerte es importante sólo en la medida en tener la oportunidad de venderte a ti mismo en el momento oportuno. Después de eso, usted tiene que tener talento y saber cómo usarlo.'],
            ['autor' =>'Albert Einstein', 'frase' => 'No es que yo sea tan inteligente, es solo que me quedo con los problemas más tiempo.'],
            ['autor' =>'Muhammad Ali', 'frase' => 'El que no tenga el coraje suficiente para tomar riesgos no conseguirá nada en la vida.'],
            ['autor' =>'Mark Twain', 'frase' => 'Es mejor permanecer callado y parecer tonto que hablar y despejar las dudas definitivamente.'],
            ['autor' =>'Anxo Pérez', 'frase' => 'Si das diez, cuando podrías dar cien, no has ganado diez, has perdido noventa.'],
            ['autor' =>'J.P. Sergent', 'frase' => 'El éxito no se logra sólo con cualidades especiales. Es sobre todo un trabajo de constancia, de método y de organización.'],
            ['autor' =>'Paul J. Meyer', 'frase' => 'La productividad nunca es un accidente. Es siempre el resultado de un compromiso con la excelencia, la planificación inteligente y centrada en el esfuerzo.'],
            ['autor' =>'Bill Gates', 'frase' => 'El ordenador nació para resolver problemas que antes no existían.'],
            ['autor' =>'Stephen Hawking', 'frase' => 'El mayor enemigo del conocimiento no es la ignorancia, sino la ilusión del conocimiento.'],
        ];

        $cita = collect($bienvenida[rand(0, count($bienvenida)-1)]); //dd($cita);
        return view('home', compact('cita'));
    }
}
