<?php
namespace App\Controller;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\Annotations as FOSRest;
use App\Entity\Usuario;
use Symfony\Component\HttpFoundation\JsonResponse as JsonResponse;

/**
 * Brand controller.
 *
 * @Route("/")
 */
class UsuarioController extends Controller
{
    /**
     * @FOSRest\Get("/usuarios")
     *
     * @return array
     */
    public function query()
    {
        $repository = $this->getDoctrine()->getRepository(Usuario::class);
        $usuarios = $repository->findall();
        return new JsonResponse($usuarios);

       // return View::create($usuarios, Response::HTTP_OK , []);
    }

    /**
     * @FOSRest\Get("/usuarios/{id}")
     *
     * @return array
     */
    public function show($id)
    {
        $repository = $this->getDoctrine()->getRepository(Usuario::class);
        $usuario = $repository->find($id);
        return new JsonResponse($usuario);

       // return View::create($usuarios, Response::HTTP_OK , []);
    }

    /**
     * @FOSRest\Post("/usuarios")
     *
     * @return array
     */
    public function create(Request $request)
    {
        $usuario = new Usuario();
        $usuario->nome = $request->get('nome');
        $usuario->login = $request->get('login');
        $usuario->senha = $request->get('senha');
        $usuario->email = $request->get('email');
        $usuario->permissao = $request->get('permissao');
        $em = $this->getDoctrine()->getManager();
        $em->persist($usuario);
        $em->flush();
        return new JsonResponse($usuario);
        //return View::create($usuario, Response::HTTP_CREATED , []);
        
    }

    /**
     * @FOSRest\Put("/usuarios/{id}")
     *
     * @return array
     */
    public function update($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $usuario = $em->getRepository(Usuario::class)->find($id);

        $usuario->nome = $request->get('nome');
        $usuario->login = $request->get('login');
        $usuario->senha = $request->get('senha');
        $usuario->email = $request->get('email');
        $usuario->permissao = $request->get('permissao');
        $em->flush();
        return new JsonResponse($usuario);
        //return View::create($usuario, Response::HTTP_CREATED , []);
        
    }

    /**
     * @FOSRest\Delete("/usuarios/{id}")
     *
     * @return array
     */
    public function destroy($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $usuario = $em->getRepository(Usuario::class)->find($id);
        $em->remove($usuario);
        $em->flush();
        return new JsonResponse();
    }
}