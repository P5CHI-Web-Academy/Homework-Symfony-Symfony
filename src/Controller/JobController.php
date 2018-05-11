<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use App\Entity\Job;
use App\Entity\Category;
use App\Form\Type\JobType;

class JobController extends AbstractController
{
    /**
     * @Route("/", name="app_job_list")
     * @Method("GET")
     */
    public function listAction(): Response
    {
        $categories = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findWithActiveJobs();

        return $this->render(
            'job/list.html.twig',
            [
                'categories' => $categories,
            ]
        );
    }

    /**
     * @Route("job/{id}", name="app_job_view", requirements={"id" = "\d+"})
     * @Method("GET")
     * @Entity("job", expr="repository.findActiveJob(id)")
     *
     * @param Job $job
     * @return Response
     */
    public function viewAction(Job $job): Response
    {
        return $this->render(
            'job/view.html.twig',
            [
                'job' => $job,
            ]
        );

    }

    /**
     *
     * @Route("/job/create", name="app_job_create")
     * @Method({"GET", "POST"})
     *
     * @param Request $request
     *
     * @return RedirectResponse|Response
     */
    public function createAction(Request $request): Response
    {
        $job = new Job();

        return $this->update($job, $request);
    }

    /**
     *
     * @Route("/job/update/{id}", name="app_job_update")
     * @Method({"GET", "POST"})
     *
     * @param Job $job
     * @param Request $request
     *
     * @return RedirectResponse|Response
     */
    public function updateAction(Job $job, Request $request): Response
    {
        return $this->update($job, $request);
    }

    /**
     * @param Job $job
     * @param Request $request
     * @return Response
     */
    private function update(Job $job, Request $request): Response
    {
        $form = $this->createForm(JobType::class, $job);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($job);
            $em->flush();

            return $this->redirectToRoute(
                'app_job_view',
                ['id' => $job->getId()]
            );
        }

        return $this->render(
            'job/update.html.twig',
            [
                'job' => $job,
                'form' => $form->createView(),
            ]
        );
    }
}
