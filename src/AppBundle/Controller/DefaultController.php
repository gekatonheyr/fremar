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
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

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
        $headerForm = $this->createFormBuilder()
            ->add('createNewEntry', SubmitType::class, array('label'=>'Create new contact'))
            ->getForm();
        $headerForm->handleRequest($request);
        if($headerForm->isSubmitted() && $headerForm->isValid()) {
            return $this->redirectToRoute('createContactPage');
        }

        $repo = $this->getDoctrine()->getManager()->getRepository('AppBundle:Contacts');
        $allContacts = $repo->findAll();
        $formsCollection = array();
        $formsViews = array();
        if(isset($_POST['show_contact']['editEntry']) || isset($_POST['show_contact']['deleteEntry'])){
            $formFlag = $_POST['show_contact']['editEntry']?$_POST['show_contact']['editEntry']:$_POST['show_contact']['deleteEntry'];
        }
        foreach($allContacts as $contact){
            $currentForm = $this->createForm(showContactType::class, $contact,array('attr'=>['id'=>$contact->getId()],));
            $currentForm->handleRequest($request);
            if($currentForm->isSubmitted() && $currentForm->isValid() && $contact->getId()==$formFlag){
                $clickedButton = $currentForm->getClickedButton()->getName();
                switch($clickedButton){
                    case'editEntry':
                        return $this->redirectToRoute('editContactPage', array('id' => $currentForm->getData()->getId()));
                    case'deleteEntry':
                        return $this->redirectToRoute('deleteContactPage', array('id' => $currentForm->getData()->getId()));;
                    default:
                        throw new Exception('Something is wrong with buttons. Please contact our administrator.');
                }
            }
            $formsCollection[] = $currentForm;
            $formsViews[] = $currentForm->createView();
        }

        return $this->render('showContact.html.twig', array('headerForm'=>$headerForm->createView(),
            'formsCollection'=>$formsViews));
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
     * @Route("/editContact", name="editContactPage")
     */
    public function editContactAction(Request $request)
    {
        $contactId = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $contactsRepo = $em->getRepository('AppBundle:Contacts');
        $contact = $contactsRepo->findOneById($contactId);
        $contactDistrict = $contact->getResPlaceDistrict();
        $districtsRepo = $em->getRepository('AppBundle:Districts');
        $district = $districtsRepo->findOneBy(array('districtName'=>$contactDistrict));
        $streets = $district->getStreets();
        $streetsList = array();
        foreach($streets as $street){
            $streetsList[$street->getStreetName()] = $street->getStreetName();
        }

        $form = $this->createForm(newContactType::class, $contact, array(
            'entity_manager' => $this->getDoctrine()->getManager(),
        ))->add('resPlaceStreet', ChoiceType::class, array('disabled'=>false,
            'placeholder'=>$contact->getResPlaceStreet(),
            'choices' => $streetsList,
        ));
        $form->handleRequest($request);
        if(isset($_POST['new_contact']['resPlaceStreet'])) {
            $contact->setResPlaceStreet($_POST['new_contact']['resPlaceStreet']);
        }
        if($form->isSubmitted()){
            $clickedButton = $form->getClickedButton()->getName();
            switch($clickedButton) {
                case 'saveAndRet2Cat':
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($contact);
                    $em->flush();
                    return $this->redirectToRoute('allContactsPage');
                case 'saveAndAddAnother':
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($contact);
                    $em->flush();
                    return $this->redirectToRoute('createContactPage');
                case 'clearData':
                    $contact = null;
                    return $this->redirectToRoute('createContactPage');
                default:
                    throw new Exception('Something is wrong with buttons. Please contact our administrator.');
            }
        }
        return $this->render('newContact.html.twig', array('form'=>$form->createView()));
    }

    /**
     * @Route("/deleteContact", name="deleteContactPage")
     */
    public function deleteContactAction(Request $request)
    {
        $contactId = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $contact = $em->find('AppBundle:Contacts', $contactId);
        $em->remove($contact);
        $em->flush();
        return $this->redirectToRoute('allContactsPage');
        /*return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
        ]);*/
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
