<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Structure;
use Doctrine\ORM\EntityManagerInterface;
use AppBundle\Entity;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints\DateTime;


class StructureController extends Controller
{
		public $currentPath = '/a/b/c/d';

		public function _construct($path){
			$this->currentPath = $path;
		}

		public function cddAction($newPath){
			$currentPath = substr($this->currentPath, 1);
			$dir = null;
			$i = 0;
			$a = explode('/', $newPath);
			$b = explode('/', $currentPath);
			
			foreach ($a as $key) {
				if($key == '..'){
					$i++;
				}
			}

			$c = array_splice($b, -$i, $i, array_slice($a, $i));
			
			foreach ($b as $q) {
				$dir .= '/'.$q;
			}
		
			$currentPath = $dir;


			return $currentPath;
		}


		public function cdAction($newPath){
			$path = new StructureController();
			echo $path->cddAction('../../x/y')->currentPath;
		}



		public function showAction()
		{
			 $em = $this->getDoctrine()->getManager();
			 $workers = $this->getDoctrine()->getRepository(Structure::class)->findAll();
			
				//print_r($workers[0]->id);         echo $workers[0]->getId();
				//print_r($workers[0]);
				// foreach ($workers as $w) {
				// 	echo $w->getParentId().', ';
				// }
			 	for($i = 1; $i <= 5000; $i++){
					$structure[$i] = new Structure(); 
				}
			 
			// print_r($structure);
			echo '<br>';
				$n = 1;//2//3//4//5
				$m = 1;//1001//2001//3001//4001//
				foreach ($workers as $w) {
					$q = 1;
					 if($w->getId() >= 21 && $w->getId() <=25){// с 9 до 33 
							 for($i = $m; $i <= (1000 * $n); $i++){
								$structure[$i]->setName('Leader of the '.$w->getName().' group');	 		
						 		$structure[$i]->setPosition('Head of group '.$q);
						 		$structure[$i]->setDateEnter(new \DateTime('2001-02-06'));
						 		$structure[$i]->setSalary(mt_rand(7000, 8000));
						 		$structure[$i]->setParentId($w->getId());
						 		$structure[$i]->setDepth(3);
						 		$q++;
							 }
					 	$n++;
						$m = $m + 1000;
					 }
				}
				//die('1');
				for($i = 1; $i <= 5000; $i++){
					$em->persist($structure[$i]);
				}
				//$em->flush();
			////////////////////
				// foreach ($workers as $w) {
				// 	 if($w->getId() >= 16 && $w->getId() <=20){// с 9 до 33
				// 			 for($i = 1; $i <= 1000; $i++){
				// 			 		$structure = new Structure();
				// 					$structure->setName('Leader of the '.$w->getName().' group');	 		
				// 			 		$structure->setPosition('Head of group '.$i);
				// 			 		$structure->setDateEnter(new \DateTime('2001-02-06'));
				// 			 		$structure->setSalary(mt_rand(7000, 8000));
				// 			 		$structure->setParentId($w->getId());
				// 			 		$structure->setDepth(3);
				// 			 		$em->persist($structure);
				// 			 		$em->flush();
				// 			 }
				// 	 }
				// }


		   // for($i = 1; $i <= 1000; $i++){
		   //  	$structure = new Structure ();
			  //   $structure->setName('Head of group '.$i);
			  //   $structure->setPosition('Head of group '.$i);
			  //   $structure->setDateEnter(new \DateTime('2001-02-06'));
			  //   $structure->setSalary(st_rand(7000, 8000);
			  //   $structure->setParentId(///////////////////////////////);
			  //   $structure->setDepth(3);
			  //   //die("echo $i");
			  //   //$b[]=$i;

			// 	$em->persist($structure);
			// 	$em->flush();
			// }

				// foreach ($b as $a) {
				// 	echo $a;
				// }
				
			//Получить все записи из БД
					//Для каждого id от 9 до 33 исполнить цикл, который заполняет БД подставляя id в parent_id каждой записи в цикле и 	 	порядковые номера в name и position
					//
				echo 'Запрос выполнен';

				return $this->render('AppBundle:Structure:show.html.twig', array(
						// ...
				));
		}

}
