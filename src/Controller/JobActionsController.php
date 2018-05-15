<?php

namespace App\Controller;

use App\Entity\Job;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/jobs")
 */
class JobActionsController extends AbstractController
{
    /**
     * @Route("/{token}/preview", name="job.preview", requirements={"token" = "\w+"})
     * @Method("GET")
     *
     * @param Job $job
     *
     * @return Response
     */
    public function preview(Job $job): Response
    {
        return $this->render('job/show.html.twig', [
            'job' => $job,
            'withActions' => true,
        ]);
    }

    /**
     * @Route("/{token}/publish", name="job.publish", requirements={"token" = "\w+"})
     * @Method("PATCH")
     *
     * @param Request $request
     * @param Job $job
     * @return RedirectResponse
     */
    public function publish(Request $request, Job $job): RedirectResponse
    {
        $csrfToken = $request->request->get('csrf_token');

        if ($this->isCsrfTokenValid('publish-token', $csrfToken)) {
            $em = $this->getDoctrine()->getManager();

            $job->setExpiresAt(new \DateTime('+30 days'));
            $job->setActivated(true);

            $em->flush();
        }

        return $this->redirectToRoute('job.show', [
            'id' => $job->getId(),
        ]);
    }
}
