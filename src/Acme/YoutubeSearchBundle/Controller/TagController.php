<?php

namespace Acme\YoutubeSearchBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Acme\YoutubeSearchBundle\Entity\Tag;
use Acme\YoutubeSearchBundle\Form\Type\TagType;

class TagController extends Controller
{
    /**
     * @Route("tag/create", name="tag_create")
     * @Template("AcmeYoutubeSearchBundle:Tag:create.html.twig")
     */
    public function createAction()
    {

        $tag = new Tag();
        $form = $this->createForm(new TagType(), $tag);
        $request = $this->getRequest();
        $form->handleRequest($request);
        if ($form->isValid()) {

            $tag = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($tag);
            $em->flush();

            return $this->redirect($this->generateUrl('tag_list'));
        }
        return array(
            'form' => $form->createView(),
        );


    }

    /**
     * @Route("tag/list", name = "tag_list")
     * @Template("AcmeYoutubeSearchBundle:Tag:list.html.twig")
     */
    public function fetchingAction()
    {
        $repository = $this->getDoctrine()
            ->getRepository('AcmeYoutubeSearchBundle:Tag');
        $tags = $repository->findAll();
        return array(
            'tags' => $tags,
        );
    }


}