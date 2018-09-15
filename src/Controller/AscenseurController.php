<?php
/**
 * Created by PhpStorm.
 * User: biovor
 * Date: 13/09/18
 * Time: 20:28
 */
namespace App\Controller;

use App\Entity\Ascenseur;
use Symfony\Component\Cache\Simple\FilesystemCache;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class AscenseurController extends Controller
{
    /**
     * on initialise l'ascenseur au RDC au démarrage de l'application
     * @Route("/", name="home")
     */
    public function initAscenseurAction()
    {
        $cache = new FilesystemCache(); //création d'un objet cache pour pouvoir stocker l'état de l'ascenseur au fur et à mesure de son évolution
        $ascenseur = new Ascenseur();  // Création de notre objet ascenseur pour notre simulation
        $ascenseur->setEtat(0);


        // on set l'état initial de notre ascenseur dans le cache
        $cache ->set('ascenseur', $ascenseur, $this->getParameter('temp_cache'));

        return $this->render('index.html.twig',[
        ]);
    }

    /**
     *
     * @Route("/ascenseur", name="ascenseur")
     */
    public function gestionAscenseurAction(Request $request)
    {
        $cache = new FilesystemCache();
        $ascenseur = $cache->get('ascenseur'); //On récupère l'état actuel de notre ascenseur

        // Création d'un form par bouton d'étage de lascenseur. (pour la vue)
        // Optimisation possible avec un form collection
        $form3 = $this->createFormBuilder()
            ->add('name', HiddenType::class)
            ->add('3', SubmitType::class)
            ->getForm();
        $form3->handleRequest($request);

        $form2 = $this->createFormBuilder()
            ->add('name', HiddenType::class)
            ->add('2', SubmitType::class)
            ->getForm();
        $form2->handleRequest($request);

        $form1 = $this->createFormBuilder()
            ->add('name', HiddenType::class)
            ->add('1', SubmitType::class)
            ->getForm();
        $form1->handleRequest($request);

        $form0 = $this->createFormBuilder()
            ->add('name', HiddenType::class)
            ->add('RDC', SubmitType::class)
            ->getForm();
        $form0->handleRequest($request);

        // ici on va gérer l'action à effectuer en fonction de l'état actuel de notre ascenseur
        // Optimisation du code possible en sortant cette partie dans un contrôler d'état.
        switch ($ascenseur->etat) {
            case (3):
                $ascenseur->ledLvl3 = 0; //si on est au 3éme, on éteint la LED qui indique le 3eme
                $ascenseur->ledLvl2 = 1; // led allumée = choix d'étage possible
                $ascenseur->ledLvl1 = 1;
                $ascenseur->ledLvl0 = 1;
                $ascenseur->ledErreur = 0;
                $ascenseur->affichage = ('3'); // Affichage de l'état actuel sur le panneau de commande
                $cache->set('ascenseur', $ascenseur, $this->getParameter('temp_cache'));
                if ($form0->isSubmitted()) {
                    return $this->redirectToRoute('goDwn', array(
                            'dest' => $form0->getData())
                    );
                }
                if ($form1->isSubmitted()) {
                    return $this->redirectToRoute('goDwn', array(
                            'dest' => $form1->getData())
                    );
                }
                if ($form2->isSubmitted()) {
                    return $this->redirectToRoute('goDwn', array(
                            'dest' => $form2->getData())
                    );
                }

                break;

            case (2):
                $ascenseur->ledLvl3 = 1;
                $ascenseur->ledLvl2 = 0;
                $ascenseur->ledLvl1 = 1;
                $ascenseur->ledLvl0 = 1;
                $ascenseur->ledErreur = 0;
                $ascenseur->affichage = ('2');
                $cache->set('ascenseur', $ascenseur, $this->getParameter('temp_cache'));

                if ($form0->isSubmitted()) {
                    $dest=$form0->getData();
                    if ($ascenseur->etat < $dest['name']){
                        return $this->redirectToRoute('goUp', array(
                                'dest' => $form0->getData())
                        );} elseif ($ascenseur->etat > $dest['name']){
                        return $this->redirectToRoute('goDwn', array(
                                'dest' => $form0->getData())
                        );}
                }
                if ($form1->isSubmitted()) {
                    $dest=$form1->getData();
                    if ($ascenseur->etat < $dest['name']){
                        return $this->redirectToRoute('goUp', array(
                                'dest' => $form1->getData())
                        );} elseif ($ascenseur->etat > $dest['name']){
                        return $this->redirectToRoute('goDwn', array(
                                'dest' => $form1->getData())
                        );}
                }
                if ($form3->isSubmitted()) {
                    $dest=$form3->getData();
                    if ($ascenseur->etat < $dest['name']){
                        return $this->redirectToRoute('goUp', array(
                                'dest' => $form3->getData())
                        );} elseif ($ascenseur->etat > $dest['name']){
                        return $this->redirectToRoute('goDwn', array(
                                'dest' => $form3->getData())
                        );}
                }
                break;

            case (1):
                $ascenseur->ledLvl3 =  1;
                $ascenseur->ledLvl2 =  1;
                $ascenseur->ledLvl1 =  0;
                $ascenseur->ledLvl0 =  1;
                $ascenseur->ledErreur =  0;
                $ascenseur->affichage =('1');
                $cache ->set('ascenseur', $ascenseur, $this->getParameter('temp_cache'));
                if ($form0->isSubmitted()) {
                    $dest=$form0->getData();
                    if ($ascenseur->etat < $dest['name']){
                        return $this->redirectToRoute('goUp', array(
                                'dest' => $form0->getData())
                        );} elseif ($ascenseur->etat > $dest['name']){
                        return $this->redirectToRoute('goDwn', array(
                                'dest' => $form0->getData())
                        );}
                }
                if ($form2->isSubmitted()) {
                    $dest=$form2->getData();
                    if ($ascenseur->etat < $dest['name']){
                        return $this->redirectToRoute('goUp', array(
                                'dest' => $form2->getData())
                        );} elseif ($ascenseur->etat > $dest['name']){
                        return $this->redirectToRoute('goDwn', array(
                                'dest' => $form2->getData())
                        );}
                }
                if ($form3->isSubmitted()) {
                    $dest=$form3->getData();
                    if ($ascenseur->etat < $dest['name']){
                        return $this->redirectToRoute('goUp', array(
                                'dest' => $form3->getData())
                        );} elseif ($ascenseur->etat > $dest['name']){
                        return $this->redirectToRoute('goDwn', array(
                                'dest' => $form3->getData())
                        );}
                }
                break;

            case (0):
                $ascenseur->ledLvl3 =  1;
                $ascenseur->ledLvl2 =  1;
                $ascenseur->ledLvl1 =  1;
                $ascenseur->ledLvl0 =  0;
                $ascenseur->ledErreur =  0;
                $cache ->set('ascenseur', $ascenseur, $this->getParameter('temp_cache'));
                $ascenseur->affichage =('RDC');
                if ($form1->isSubmitted()) {
                    return $this->redirectToRoute('goUp', array(
                            'dest' => $form1->getData())
                    );
                }
                if ($form2->isSubmitted()) {
                    return $this->redirectToRoute('goUp', array(
                            'dest' => $form2->getData())
                    );
                }
                if ($form3->isSubmitted()) {
                    return $this->redirectToRoute('goUp', array(
                            'dest' => $form3->getData())
                    );
                }
                break;

            default:
                $ascenseur->ledErreur =  1; // pour montrer que l’on a un gros problème
        }

        return $this->render('ascenseur.html.twig', array(
            'ascenseur'=> $ascenseur,
            'form0' => $form0->createView(),
            'form1' => $form1->createView(),
            'form2' => $form2->createView(),
            'form3' => $form3->createView(),
        ));
    }
}