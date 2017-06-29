<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
// use FOS\RestBundle\Controller\Annotations as Rest; // alias pour toutes les annotations
use AppBundle\Entity\Planification\Task;


class PlanificationController extends Controller
{
    /**
     * @Route("/tasks", name="tasks")
     */
    public function getTasksAction(Request $request)
    {
        $tasks = $this->get('doctrine.orm.entity_manager')
                ->getRepository('AppBundle:Planification\Task')
                ->findAll();

        return $this->render('AppBundle:Planification:getTasks.html.twig', array(
            'tasks'           => $tasks
        ));
    }
}
