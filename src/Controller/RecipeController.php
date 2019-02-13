<?php

namespace App\Controller;

use App\Entity\Opinion;
use App\Entity\Recipe;
use App\Entity\User;
use App\Form\OpinionType;
use App\Form\UserType;
use phpDocumentor\Reflection\Types\Integer;
use phpDocumentor\Reflection\Types\String_;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class RecipeController extends AbstractController
{
    /**
     * @Route("/", name="recipe")
     */
    public function index()
    {
        $recipes = $this->getDoctrine()->getRepository(Recipe::class)->findAll();
        return $this->render('recipe/list.html.twig', [
            'recipes' => $recipes,
        ]);
    }

    /**
     * @Route("/recipe/{id}", name="recipe_details")
     */
    public function getRecipeById($id, Request $request)
    {
        $recipe = $this->getDoctrine()->getRepository(Recipe::class)->find($id);

        $opinion = new Opinion();
        $user = new User();
        $opinion->setRecipe($recipe);
        $opinion->setUser($user);

        $form = $this->createForm(OpinionType::class, $opinion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $opinion = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($opinion);
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('recipe_details', ['id' => $id]);
        }


        return $this->render('recipe/details.html.twig', [
            'recipe' => $recipe, 'form' => $form->createView()
        ]);
    }

}
