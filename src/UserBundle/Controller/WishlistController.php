<?php

namespace UserBundle\Controller;

use UserBundle\Entity\Produits;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\Wishlist;


/**
 * Wishlist controller.
 *
 * @Route("wishlist")
 */
class WishlistController extends Controller
{
    /**
     * Lists all produit entities.
     *
     * @Route("/", name="wishlist_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $wishlists = $em->getRepository('UserBundle:Wishlist')
            ->findBy(array('idUser' => $this->get('security.token_storage')->getToken()->getUser()));

        return $this->render('wishlist/index.html.twig', array(
            'wishlists' => $wishlists,
        ));
    }
    /**
     * Lists all produit entities.
     *
     * @Route("/{id}/remove", name="wishlist_remove")
     * @Method("GET")
     */
    public function removeFromWishlist(Wishlist $wishlist)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($wishlist);
        $em->flush();
        return $this->redirectToRoute('wishlist_index');
    }




}
