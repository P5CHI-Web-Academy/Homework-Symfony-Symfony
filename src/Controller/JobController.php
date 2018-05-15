<?php

namespace App\Controller;

use App\Entity\Job;
use App\Form\JobType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/jobs")
 */
class JobController extends AbstractController
{
    /**
     * @Route("/list", name="job.list")
     * @Method("GET")
     *
     * @return Response
     */
    public function index(): Response
    {
        $jobs = $this->getDoctrine()
            ->getRepository(Job::class)
            ->findActive();

        return $this->render('job/index.html.twig', compact('jobs'));
    }

    /**
     * @Route("/create", name="job.create")
     * @Method({"GET", "POST"})
     *
     * @param Request $request
     * @return Response
     */
    public function create(Request $request): Response
    {
        $job = new Job();
        $form = $this->createForm(JobType::class, $job);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($job);
            $em->flush();

            return $this->redirectToRoute('job.show', ['id' => $job->getId()]);
        }

        return $this->render('job/create.html.twig', [
            'job' => $job,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="job.show")
     * @Method("GET")
     * @Entity("job", expr="repository.findActiveJob(id)")
     *
     * @param Job $job
     * @return Response
     */
    public function show(Job $job): Response
    {
        return $this->render('job/show.html.twig', compact('job'));
    }

    /**
     * @Route("/{token}/edit", name="job.edit", requirements={"token" = "\w+"})
     * @Method({"GET", "POST"})
     *
     * @param Request $request
     * @param Job $job
     * @return RedirectResponse|Response
     */
    public function edit(Request $request, Job $job): Response
    {
        $form = $this->createForm(JobType::class, $job);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($job);
            $em->flush();

            return $this->redirectToRoute('job.show', ['id' => $job->getId()]);
        }

        return $this->render('job/edit.html.twig', [
            'job' => $job,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{token}", name="job.delete", requirements={"token" = "\w+"})
     * @Method("DELETE")
     *
     * @param Request $request
     * @param Job $job
     * @return RedirectResponse
     */
    public function delete(Request $request, Job $job): RedirectResponse
    {
        $csrfToken = $request->request->get('csrf_token');

        if ($this->isCsrfTokenValid('delete-token', $csrfToken)) {
            $em = $this->getDoctrine()->getManager();

            $em->remove($job);
            $em->flush();
        }

        return $this->redirectToRoute('job.list');
    }
}
