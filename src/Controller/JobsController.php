<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Job;
use App\Form\JobFormType;
use Symfony\Component\HttpFoundation\Request;
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
     *@Route("/jobs/create", name="jobs.create")
     */
    public function create(Request $request)
    {
        $form = $this->createForm(JobFormType::class, new Job());

        return $this->render('jobs/create.html.twig', [
            'form' => $form->createView(),
        ]);

    }

    /**
     * @Route("/categories/{id}/jobs", name="jobs.by.category")
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
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function show($id)
    {
        $job = $this->getDoctrine()->getRepository(Job::class)->findOrFail($id);

        return $this->render('jobs/show.html.twig', [
            'job' => $job,
        ]);
    }
}
