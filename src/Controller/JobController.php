<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;
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
     * @Route("/job/update/{token}", name="app_job_update", requirements={"token"="\w+"})
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

            $this->addFlash('notice', 'Job has been saved');

            return $this->redirectToRoute(
                'app_job_preview',
                ['token' => $job->getToken()]
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

    /**
     * @Route("job/{token}", name="app_job_preview", requirements={"token"="\w+"})
     * @Method("GET")
     *
     * @param Job $job
     * @return Response
     */
    public function previewAction(Job $job): Response
    {
        $deleteForm = $this->createDeleteForm($job);
        $publishForm = $this->createPublishForm($job);

        return $this->render(
            'job/view.html.twig',
            [
                'job' => $job,
                'hasControlAccess' => true,
                'deleteForm' => $deleteForm->createView(),
                'publishForm' => $publishForm->createView(),
            ]
        );
    }

    /**
     * @Route("job/delete/{token}", name="app_job_delete", requirements={"token"="\w+"})
     * @Method("DELETE")
     *
     * @param Request $request
     * @param Job $job
     * @param EntityManagerInterface $em
     *
     * @return Response
     */
    public function deleteAction(Job $job, Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createDeleteForm($job);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->remove($job);
            $em->flush();
        }

        return $this->redirectToRoute('app_job_list');
    }

    /**
     * @Route("job/publish/{token}", name="app_job_publish", requirements={"token"="\w+"})
     * @Method("POST")
     *
     * @param Request $request
     * @param Job $job
     * @param EntityManagerInterface $em
     *
     * @return Response
     */
    public function publishAction(Job $job, Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createPublishForm($job);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $job->setActivated(true);
            $em->flush();

            $this->addFlash('notice', 'Job was published');
        }

        return $this->redirectToRoute('app_job_preview', ['token' => $job->getToken()]);
    }

    /**
     * @param Job $job
     * @return FormInterface
     */
    private function createDeleteForm(Job $job): FormInterface
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('app_job_delete', ['token' => $job->getToken()]))
            ->setMethod('DELETE')
            ->getForm();
    }

    /**
     * @param Job $job
     * @return FormInterface
     */
    private function createPublishForm(Job $job): FormInterface
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('app_job_publish', ['token' => $job->getToken()]))
            ->setMethod('POST')
            ->getForm();
    }

}
