<?php

namespace App\Controller;
use App\Entity\Demande;
use App\Entity\Utilisateur;
use App\Entity\Patient;
use App\Repository\PatientRepository;
use App\Repository\UtlisateurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\HttpFoundation\Request;
use Acme\DemoBundle\Form\Type\FieldsetType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
class PrincipalController extends AbstractController
{
    /**
     * @Route("/principal", name="principal")
     */
    public function index(): Response
    {
        return $this->render('principal/index.html.twig', [
            'controller_name' => 'PrincipalController',
        ]);
    }
    /**
     * @Route("/compte", name="compte")
     */
    public function compte(): Response
    {
        $repository=$this->getDoctrine()->getRepository(Utilisateur::class);
        $lesUtilisateurs=$repository->findAll();
        $repository2=$this->getDoctrine()->getRepository(Patient::class);
        $lesPatients=$repository2->findAll();
        return $this->render('principal/compte.html.twig', [
            'controller_name' => 'PrincipalController',
            'utilisateurs'=> $lesUtilisateurs,
            'patients'=> $lesPatients,
        ]);
    }
    /**
     * @Route("/demande", name="demande")
     */

    
    public function demande(): Response
    {
        $em=$this->getDoctrine()->getManager();
        $demande=new Demande();
        $form = $this->createFormBuilder($demande)
            ->add('datedemande',DateType::class,array('label'=>'Date de la demande :', 'data' => new \DateTime("now")))
            ->add('heuredemande',TimeType::class,array('label'=>'Heure de début :'))
            ->add('etat',TextType::class,array('label'=>'Etat de la demande : ','disabled' => true, 'data' =>'En attente'))
            ->add('save',SubmitType::class,array('label'=> 'Enregistrer la demande'))
            ->getForm();
        return $this->render('principal/demande.html.twig',array(
            'form' => $form->createView(), [
                
            ]
        ));
    }
    /**
     * @Route("/listedemandes", name="listedemandes")
     */
    public function getInfosPatient(): Response 
    {
        $repository=$this->getDoctrine()->getRepository(Demande::class);
        $lesDemandes=$repository->findAll();
        $repository2=$this->getDoctrine()->getRepository(Patient::class);
        $lesPatients=$repository2->findAll();
        $repository3=$this->getDoctrine()->getRepository(Utilisateur::class);
        $lesUtilisateurs=$repository3->findAll();
        return $this->render('principal/listedemandes.html.twig',[
            'controller_name' => 'PrincipalController',
            'demandes'=> $lesDemandes,
            'patients'=> $lesPatients,
            'utilisateurs'=> $lesUtilisateurs,
            ]);
    }
    

}
