<?php

namespace App\Controller;

use App\Entity\Event;
use App\Form\EventType;
use App\Repository\EventRepository;
use App\Entity\PropertySearch;
use App\Form\PropertySearchType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Dompdf\Dompdf;
use Dompdf\Options;

use Knp\Component\Pager\PaginatorInterface;

use Mediumart\Orange\SMS\SMS;
use Mediumart\Orange\SMS\Http\SMSClient;

/**
 * @Route("/evt")
 */
class EvtController extends AbstractController
{



    
    /**
     * @Route("/", name="evt_index", methods={"GET"})
     */
    public function index(PaginatorInterface $paginator , Request
    $request)
    {
        $donnees= [];
        $donnees= $this->getDoctrine()->getRepository(Event::class)->findBy([],['date' => 'desc']);

        $propertySearch = new PropertySearch();
        $form = $this->createForm(PropertySearchType::class,$propertySearch,[
            'action' => $this->generateUrl('evt_index'),
            'method' => 'GET',
        ]);
        
        $form->handleRequest($request);
       //initialement le tableau des articles est vide, 
       //c.a.d on affiche les articles que lorsque l'utilisateur clique sur le bouton rechercher
        
        
       if($form->isSubmitted() && $form->isValid()) {
       //on récupère le nom d'article tapé dans le formulaire
        $nom = $propertySearch->getNom();   
        if ($nom!="") 
          //si on a fourni un nom d'article on affiche tous les articles ayant ce nom
          $donnees= $this->getDoctrine()->getRepository(Event::class)->findBy(['nom' => $nom] );
        else   
          //si si aucun nom n'est fourni on affiche tous les articles
          $donnees= $this->getDoctrine()->getRepository(Event::class)->findAll();
       }

       $events = $paginator->paginate(
        $donnees, // Requête contenant les données à paginer (ici nos articles)
        $request->query->getInt('page', 1),4 // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
         // Nombre de résultats par page
    );
        return $this->render('evt/index.html.twig',[
            'events' => $events,'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/listevt", name="evt_list", methods={"GET"})
     */
    public function listevt(EventRepository $eventRepository): Response
    {


        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
        
        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
        $events = $eventRepository->findAll();
        return $this->render('evt/listevt.html.twig', [
            'events' => $events,
        ]);
        
        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('evt/listevt.html.twig', [
            'events' => $eventRepository->findAll(),
        ]);
        
        // Load HTML to Dompdf
        $dompdf->loadHtml($html);
        
        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        $dompdf->stream("mypdf.pdf", [
            "Attachment" => false
        ]);
    }
       
    

    /**
     * @Route("/new", name="evt_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $event = new Event();
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $uploadedFile = $form['image']->getData();
            $filename = md5(uniqid()).'.'.$uploadedFile->guessExtension();
            $uploadedFile->move($this->getParameter('upload_directory'),$filename);
            $event->setImage($filename);

            $entityManager->persist($event);
            $entityManager->flush();
            $client = SMSClient::getInstance('2Yf3CBy0mWhiS0TcVCWonAOkEUXs6cLF', 'Bgflgfsi6lEN1e2V');
            $sms = new SMS($client);
            $sms->message('Salut '.',
        puisque vous etes l administrateur  nous vous informons que qu un post s est ajoute ')
        ->from('+21694733258')
        ->to('+21694733258')
        ->send();

            return $this->redirectToRoute('evt_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('evt/new.html.twig', [
            'event' => $event,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="evt_show", methods={"GET"})
     */
    public function show(Event $event): Response
    {
        return $this->render('evt/show.html.twig', [
            'event' => $event,
        ]);
    }



    /**
     * @Route("/{id}/edit", name="evt_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Event $event, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $uploadedFile = $form['image']->getData();
            $filename = md5(uniqid()).'.'.$uploadedFile->guessExtension();
            $uploadedFile->move($this->getParameter('upload_directory'),$filename);
            $event->setImage($filename);




            $entityManager->flush();
            $this->addFlash(
                'info',
              'votre evenement est modifier  !!',  
          );
           
    

            return $this->redirectToRoute('evt_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('evt/edit.html.twig', [
            'event' => $event,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="evt_delete", methods={"POST"})
     */
    public function delete(Request $request, Event $event, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$event->getId(), $request->request->get('_token'))) {
            $entityManager->remove($event);
            $entityManager->flush();
            $this->addFlash(
                'info',
              'votre evenement est supprimer  !!',  
          );
        }

        return $this->redirectToRoute('evt_index', [], Response::HTTP_SEE_OTHER);
    }
}
