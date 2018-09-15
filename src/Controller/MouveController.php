<?php
/**
 * Created by PhpStorm.
 * User: biovor
 * Date: 13/09/18
 * Time: 20:43
 */

namespace App\Controller;




use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Cache\Simple\FilesystemCache;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MouveController extends Controller
{
    /**
     * @Route("/goUp", name="goUp")
     */
    public function goUpAction(Request $request)
    {
        $dest = $request->query->get('dest');

        $this->gestionLedAction($dest['name'], $mouve ='Up');
        $cache = new FilesystemCache();
        $ascenseur = $cache->get('ascenseur');

        return $this->render('ascenseurMouve.html.twig', [
            'ascenseur'=> $ascenseur
        ]);

    }

    // Optimisation possible avec une méthode mouveAction qui prendrait en paramètre supplémentaire le mouve up ou down
    // pour n'avoir plus qu'une seule méthode

    /**
     * @Route("/goDwn", name="goDwn")
     */
    public function downAction(Request $request)
    {
        $dest = $request->query->get('dest');
        $this->gestionLedAction($dest['name'], $mouve ='Dwn');
        $cache = new FilesystemCache();
        $ascenseur = $cache->get('ascenseur');

        return $this->render('ascenseurMouve.html.twig', [
            'ascenseur'=> $ascenseur
        ]);

    }

    public function gestionLedAction($dest, $mouve)
    {
        $cache = new FilesystemCache();
        $ascenseur = $cache->get('ascenseur');

        switch ($dest){
            case ('0'):
                $ascenseur->ledLvl3 =  0;
                $ascenseur->ledLvl2 =  0;
                $ascenseur->ledLvl1 =  0;
                $ascenseur->ledLvl0 =  1;
                $ascenseur->etat ='0';
                $ascenseur->affichage =($mouve);
                $cache ->set('ascenseur', $ascenseur, 1000);

                break;

            case ('1'):
                $ascenseur->ledLvl3 =  0;
                $ascenseur->ledLvl2 =  0;
                $ascenseur->ledLvl1 =  1;
                $ascenseur->ledLvl0 =  0;
                $ascenseur->affichage =($mouve);
                $ascenseur->etat ='1';
                $cache ->set('ascenseur', $ascenseur, 1000);

                break;

            case ('2'):
                $ascenseur->ledLvl3 =  0;
                $ascenseur->ledLvl2 =  1;
                $ascenseur->ledLvl1 =  0;
                $ascenseur->ledLvl0 =  0;
                $ascenseur->affichage =($mouve);
                $ascenseur->etat ='2';
                $cache ->set('ascenseur', $ascenseur,1000);
                break;

            case ('3'):
                $ascenseur->ledLvl3 =  1;
                $ascenseur->ledLvl2 =  0;
                $ascenseur->ledLvl1 =  0;
                $ascenseur->ledLvl0 =  0;
                $ascenseur->affichage =($mouve);
                $ascenseur->etat ='3';
                $cache ->set('ascenseur', $ascenseur, 1000);
                break;
        }
    }
}