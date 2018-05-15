<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Job;
use App\Form\JobType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class JobsController extends Controller
{
    /**
     * @Route("/jobs", name="jobs.index")
     */
    public function index()
    {
        $categories = $this->getDoctrine()->getRepository(Category::class)->findCategoriesWithJobs();

        return $this->render('jobs/index.html.twig', [
            'categories' => $categories,
        ]);
    }

    /**
     * @Route("/jobs/create", name="jobs.create")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(Request $request, EntityManagerInterface $em) : Response
    {
        $job = new Job();

        $form = $this->createForm(JobType::class, $job);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($job);
            $em->flush();

            return $this->redirectToRoute('jobs.index');
        }

        return $this->render('jobs/create.html.twig', [
            'form' => $form->createView(),
        ]);

    }

    /**
     * @Route("/categories/{id}/jobs", name="jobs.by.category")
     * @Method("GET")
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function jobsByCategory($id)
    {
        $jobs = $this->getDoctrine()->getRepository(Job::class)->findByCategory($id);

        return $this->render('jobs/index.html.twig', [
            'jobs' => $jobs,
        ]);
    }

    /**
     * @Route("/jobs/{id}", name="jobs.show")
     * @param $job
     * @return \Symfony\Component\HttpFoundation\Response
     * @Entity(name="job", expr="repository.findOrNull(id)")
     */
    public function show(Job $job)
    {
        return $this->render('jobs/show.html.twig', [
            'job' => $job,
        ]);
    }
}
