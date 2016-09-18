<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Contacts;
use AppBundle\Entity\Districts;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AppBundle\Form\newContactType;
use AppBundle\Form\showContactType;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/info", name="infopage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
        ]);
    }

    /**
     * @Route("/", name="homepage")
     */
    public function catalogAction(Request $request)
    {
        /* replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
        ]);*/
        $mgr = $this->getDoctrine()->getManager();
        $repo = $mgr->getRepository('AppBundle:Districts');
        $list = $repo->findAll();
        $form = $this->createFormBuilder()->
            add('getContactsList', SubmitType::class, array('label'=>'See the list of all contacts'))->
            add('addNewContact', SubmitType::class, array('label'=>'Add new contact'))->
            getForm();
        $form ->handleRequest($request);
        if($form->isSubmitted()){
            $nextAction = $form->get('addNewContact')->isClicked()?
                'createContactPage'
                :'allContactsPage';
            return $this->redirectToRoute($nextAction);
        }
        return $this->render('contacts.html.twig', array('form'=>$form->createView()));
    }

    /**
     * @Route("/showAllContacts", name="allContactsPage")
     */
    public function showAllContactsAction(Request $request)
    {
        $repo = $this->getDoctrine()->getManager()->getRepository('AppBundle:Contacts');
        $allContacts = $repo->findOneById(1);
        $headerForm = $this->createFormBuilder()
            ->add('createNewEntry', SubmitType::class, array('label'=>'Create new contact'))
            ->getForm();

        $contactForm = $this->createForm(showContactType::class, $allContacts);

        return $this->render('showContact.html.twig', array('headerForm'=>$headerForm->createView(),
            'form'=>$contactForm->createView()));
        /*return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
        ]);*/
    }

    /**
     * @Route("/addNewContact", name="createContactPage")
     */
    public function addNewContactAction(Request $request)
    {
        $newContact = new Contacts();
        $form = $this->createForm(newContactType::class, $newContact, array(
            'entity_manager' => $this->getDoctrine()->getManager(),
        ));
        $form->handleRequest($request);
        if(isset($_POST['new_contact']['resPlaceStreet'])) {
            $newContact->setResPlaceStreet($_POST['new_contact']['resPlaceStreet']);
        }
        if($form->isSubmitted()){
            $clickedButton = $form->getClickedButton()->getName();
            switch($clickedButton) {
                case 'saveAndRet2Cat':
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($newContact);
                    $em->flush();
                    return $this->redirectToRoute('allContactsPage');
                case 'saveAndAddAnother':
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($newContact);
                    $em->flush();
                    return $this->redirectToRoute('createContactPage');
                case 'clearData':
                    $newContact = null;
                    return $this->redirectToRoute('createContactPage');
                default:
                    throw new Exception('Something is wrong with buttons. Please contact our administrator.');
            }
        }


        return $this->render('newContact.html.twig', array('form'=>$form->createView()));
    }

    /**
     * @Route("/getStreetsList", name="AJAX_getStreets")
     */
    public function getStreetsListAction(Request $request)
    {
        $district = $request->get('district');
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('AppBundle:Districts');
        $list = $repo->findOneBy(array('districtName'=>$district));
        $streets = $list->getStreets();
        $html = '';//'<option selected="selected">Please select your choice</option>';
        foreach($streets as $street){
            $html = $html.$street->getStreetName().';';//$html.'<option value="'.$street->getStreetName().'">'.$street->getStreetName().'</option>';
        }
        return new Response($html);
    }
}
