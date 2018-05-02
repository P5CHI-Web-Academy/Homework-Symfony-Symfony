<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Job;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class JobsController extends Controller
{
    /**
     * @Route("/jobs", name="jobs.index")
     */
    public function index()
    {
        $categories = $this->getDoctrine()->getRepository(Category::class)->findAll();

        $jobs = $this->getDoctrine()->getRepository(Job::class)->findAll();

        return $this->render('jobs/index.html.twig', compact('jobs', 'categories'));
    }

    /**
     * @Route("/categories/{id}/jobs", name="jobs.by.category")
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function jobsByCategory($id)
    {
        $categories = $this->getDoctrine()->getRepository(Category::class)->findAll();

        $jobs = $this->getDoctrine()->getRepository(Job::class)->findByCategory($id);

        return $this->render('jobs/index.html.twig', compact('jobs', 'categories'));
    }

    /**
     * @Route("/jobs/{id}", name="jobs.show")
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function show($id)
    {
        $categories = $this->getDoctrine()->getRepository(Category::class)->findAll();

        $job = $this->getDoctrine()->getRepository(Job::class)->find($id);

        return $this->render('jobs/show.html.twig', compact('job', 'categories'));
    }
}
