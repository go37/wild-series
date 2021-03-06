<?php
// src/Controller/ProgramController.php

namespace App\Controller;

use App\Entity\Program;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/program", name="program_")
 */

class ProgramController extends AbstractController
{
    /**
     * Show all rows from Program’s entity
     *
     * @Route("/", name="index")
     * @return Response A response instance
     */
    public function index(): Response
    {
        $programs = $this->getDoctrine()
            ->getRepository(Program::class)
            ->findAll();

        return $this->render("program/index.html.twig", ["programs" => $programs]);
    }

    /**
     * Getting a program by id
     *
     * @Route("/show/{id}", name="show", requirements={"id"="\d+"})
     * @return Response
     */
    public function show(int $id): Response
    {
        $program = $this->getDoctrine()
            ->getRepository(Program::class)
            ->find($id);

        if (null === $program) {
            throw $this->createNotFoundException(
                "No program with id : " . $id . " found in program\'s table."
            );
        }
        return $this->render("program/show.html.twig", ["program" => $program]);
    }
}
