<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Job;
use App\Form\JobType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use \Symfony\Component\Form\FormInterface;

/**
 * @Route(name="job.")
 */
class JobController extends AbstractController {

    /**
     * @Route("/", name="list")
     * @Method("GET")
     * @return Response
     * @throws \LogicException
     */
    public function list(): Response
    {
        $categories = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findCategoriesWithActiveJobs();

        return $this->render('job/list.html.twig', [
            'categories' => $categories,
        ]);
    }

    /**
     * @Route("job/{id}", name="show", requirements={"id" = "\d+"})
     * @Method("GET")
     * @Entity("job", expr="repository.findActiveJob(id)")
     * @param Job $job
     * @return Response
     */
    public function show(Job $job): Response
    {
        return $this->render('job/show.html.twig', [
            'job' => $job,
        ]);
    }

    /**
     * @Route("job/create", name="create")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function create(Request $request, EntityManagerInterface $em): Response
    {
        $job = new Job();
        $form = $this->createForm(JobType::class, $job);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($job);
            $em->flush();

            $this->addFlash('notice', 'Job has been created');

            return $this->redirectToRoute(
                'job.view',
                ['token' => $job->getToken(),]
            );
        }

        return $this->render('job/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("job/{token}", name="view", requirements={"token" = "\w+"})
     * @Method("GET")
     * @param Job $job
     * @return Response
     */
    public function view(Job $job): Response
    {
        $deleteForm = $this->createDeleteForm($job);
        $activateForm = $this->createActivateForm($job);

        return $this->render('job/show.html.twig', [
            'job' => $job,
            'deleteForm' => $deleteForm->createView(),
            'activateForm' => $activateForm->createView(),
            'isEditable' => true,
        ]);
    }

    /**
     * @Route("job/{token}/edit", name="edit", requirements={"token" = "\w+"})
     * @Method({"GET", "POST"})
     * @param Request $request
     * @param Job $job
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function edit(Request $request, Job $job, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(JobType::class, $job);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            $this->addFlash('notice', 'Job info has been updated');

            return $this->redirectToRoute(
                'job.view',
                ['token' => $job->getToken(),]
            );
        }

        return $this->render('job/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("job/{token}/delete", name="delete", requirements={"token" = "\w+"})
     * @Method("DELETE")
     * @param Request $request
     * @param Job $job
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function delete(Request $request, Job $job, EntityManagerInterface $em): Response
    {
        $form = $this->createDeleteForm($job);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->remove($job);
            $em->flush();

            $this->addFlash('notice', 'Job has been deleted');
        }

        return $this->redirectToRoute('job.list');
    }

    /**
     * @Route("job/{token}/activate", name="activate", requirements={"token" = "\w+"})
     * @Method("POST")
     * @param Request $request
     * @param Job $job
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function activate(Request $request, Job $job, EntityManagerInterface $em): Response
    {
        $form = $this->createActivateForm($job);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $job->setActivated(true);
            $em->flush();

            $this->addFlash('notice', 'Job has been activated');
        }

        return $this->redirectToRoute(
            'job.view',
            ['token' => $job->getToken(),]
        );
    }

    /**
     * @param Job $job
     * @return FormInterface
     */
    public function createDeleteForm(Job $job): FormInterface
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('job.delete', ['token' => $job->getToken()]))
            ->setMethod('DELETE')
            ->getForm();
    }

    /**
     * @param Job $job
     * @return FormInterface
     */
    public function createActivateForm(Job $job): FormInterface
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('job.activate', ['token' => $job->getToken()]))
            ->setMethod('POST')
            ->getForm();
    }
}
