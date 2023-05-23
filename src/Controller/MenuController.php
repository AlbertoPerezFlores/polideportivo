<?php
// src/Controller/MenuController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Routing\Annotation\Route;

use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;


use App\Entity\Menu;
use App\Entity\user;
use App\Repository\MenuRepository;
use App\Repository\userRepository;

class MenuController extends AbstractController
{
	private $menuRepository;
    private $security;
	
	public function __construct ( MenuRepository $menuRepository , Security $security)
    {
			$this->menuRepository = $menuRepository;
            $this->security = $security;
	}
	/**
     * @Route("/menu_menu",  name="menu_menu")
     */
	public function menu(): Response
    {
		$menus = $this->menuRepository->findMenu();
        $user = $this->security->getUser();
        $userId = $user ? $user->getId() : null;
        
        /*$menus = $this->getDoctrine()
        ->getRepository(Menu::class)
        ->findAll();
        */
		
		/*   $repository = $this->getDoctrine()
                ->getRepository('Menu::class');
        $query = $repository->createQueryBuilder('m')
                ->orderBy('m.orden', 'ASC')
                ->getQuery();

        $menus = $query->getResult();
        */


        return $this->render('menu/index.html.twig',[
            "menus"=>$menus,
            'iduser' => $userId
        ]);
    }   
	 
	/**
     * @Route("/menu_test",  name="menu_test")
     */
	public function test(): Response
    {
        
        return $this->render('menu/test.html.twig');
    }   

        /**
     * @Route("/home", name="app_home")
     */
    public function home(): Response
    {
        return $this->render('home/User.html.twig', [
            'controller_name' => 'HomeController',
            'iduser' => $this->getUser()
        ]);
    }
  

}