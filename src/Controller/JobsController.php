<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Job;
use App\Repository\CategoryRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class JobsController extends Controller
{
    /**
     * @Route("/jobs", name="jobs.index")
     */
    public function index()
    {
        $jobs = $this->getDoctrine()->getRepository(Job::class)->findAll();

        return $this->render('jobs/index.html.twig', compact('jobs', 'categories'));
    }

    /**
     * @Route("/categories/{id}/jobs", name="jobs.by.categorie")
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function jobsByCategorie($id)
    {
        $categorie = $this->getDoctrine()->getRepository(Category::class)->findOneBy(['id' => $id]);

        $jobs = $categorie->getJobs();

        return $this->render('jobs/index.html.twig', compact('jobs', 'categories'));
    }

    /**
     * @Route("/jobs/{id}", name="jobs.show")
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function show($id)
    {
        $job = $this->getDoctrine()->getRepository(Job::class)->findOneBy(['id' => $id]);

        return $this->render('jobs/show.html.twig', compact('job', 'categories'));
    }
}
