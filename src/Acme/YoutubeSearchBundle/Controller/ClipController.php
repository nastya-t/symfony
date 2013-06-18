<?php

namespace Acme\YoutubeSearchBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Acme\YoutubeSearchBundle\Entity\Clip;
use Acme\YoutubeSearchBundle\Form\Type\ClipType;
use Doctrine\Common\Collections\ArrayCollection;

class ClipController extends Controller
{
    /**
     * @Route("clip/create", name="clip_create")
     * @Template("AcmeYoutubeSearchBundle:Clip:create.html.twig")
     */
    public function createAction()
    {
        $clip = new Clip();
        $form = $this->createForm(new ClipType(), $clip);
        $request = $this->getRequest();
        $form->handleRequest($request);
        if ($form->isValid()) {

            $clip = $form->getData();
            $em = $this->getDoctrine()->getManager();
            /* @var $arrTags \Doctrine\Common\Collections\ArrayCollection */
            $arrTags = $clip->getTags();
            foreach ($arrTags->toArray() as $objTag) {
                $tagId = $objTag->getId();
                if (empty($tagId)) {
                    $em->persist($objTag);
                }
            }

            $em->persist($clip);
            $em->flush();

            return $this->redirect($this->generateUrl('clip_list'));
        }
        return array(
            'form' => $form->createView(),
        );
    }

    /**
     * @Route("clip/list", name = "clip_list")
     * @Template("AcmeYoutubeSearchBundle:Clip:list.html.twig")
     */
    public function fetchingAction()
    {
        $repository = $this->getDoctrine()
            ->getRepository('AcmeYoutubeSearchBundle:Clip');
        $clips = $repository->findAll();
        return array(
            'clips' => $clips,
        );
    }


}