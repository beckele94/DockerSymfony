<?php

namespace App\Controller;

use App\Entity\Ticket;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


#[Route('/tickets')]
class TicketController extends AbstractController
{
    #[Route('/', name: "tickets_list")]
    public function index(ManagerRegistry $doctrine): Response{

        $tickets = $doctrine->getRepository(Ticket::class)->findAll();
        // dd($tickets);
        
        return $this->render ('tickets/list.html.twig', [
            'tickets' => $tickets,
        ]);

    }

    #[Route('/{ticketId}', name: "tickets_show")]
    public function show(int $ticketId, ManagerRegistry $doctrine): Response
    {
        $ticket = $doctrine->getRepository(Ticket::class)->find($ticketId);

        if (!$ticket){
            throw $this->createNotFoundException(

            );
        }
        
        return $this->render ('tickets/show.html.twig', [
            'ticket' => $ticket
        ]);
    }
}