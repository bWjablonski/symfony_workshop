<?php

namespace App\Controller;

use App\Application\ValidateToolInsuranceStatusMessage;
use App\Entity\Tool;
use App\Form\ToolType;
use App\Repository\ToolRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/tool')]
class ToolController extends AbstractController
{
    #[Route('/', name: 'app_tool_index', methods: ['GET'])]
    public function index(ToolRepository $toolRepository): Response
    {
        return $this->render('tool/index.html.twig', [
            'tools' => $toolRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_tool_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ToolRepository $toolRepository): Response
    {
        $tool = new Tool();
        $form = $this->createForm(ToolType::class, $tool);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $toolRepository->add($tool);
            return $this->redirectToRoute('app_tool_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('tool/new.html.twig', [
            'tool' => $tool,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_tool_show', methods: ['GET'])]
    public function show(Tool $tool): Response
    {
        return $this->render('tool/show.html.twig', [
            'tool' => $tool,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_tool_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Tool $tool, ToolRepository $toolRepository): Response
    {
        $form = $this->createForm(ToolType::class, $tool);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $toolRepository->add($tool);
            return $this->redirectToRoute('app_tool_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('tool/edit.html.twig', [
            'tool' => $tool,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_tool_delete', methods: ['POST'])]
    public function delete(Request $request, Tool $tool, ToolRepository $toolRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $tool->getId(), $request->request->get('_token'))) {
            $toolRepository->remove($tool);
        }

        return $this->redirectToRoute('app_tool_index', [], Response::HTTP_SEE_OTHER);
    }


    #[Route('/{id}/validate-insurance', name: 'validate_insurance_status', methods: ['GET'])]
    public function validateInsuranceStatus(Tool $tool, MessageBusInterface $bus): Response
    {
        $envelope = $bus->dispatch(new ValidateToolInsuranceStatusMessage($tool->getId()));
        $handledStamp = $envelope->last(HandledStamp::class);
        $status = $handledStamp->getResult();

        return $this->render('tool/show_status.html.twig', [
            'tool' => $tool,
            'status' => $status
        ]);
    }
}
