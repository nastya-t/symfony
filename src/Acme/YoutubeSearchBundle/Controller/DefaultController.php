<?php

namespace Acme\YoutubeSearchBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Google_Client;
use Google_YouTubeService;

class DefaultController extends Controller
{

    /**
     * @Route("/", name="search_video")
     * @Template("AcmeYoutubeSearchBundle:Default:youtube-search.html.twig")
     */
    public function youtubeSearchAction()
    {
        $request = $this->getRequest();
        $form = $this->createFormBuilder()
            ->add('search', 'text', array('label' => 'Введите фразу для поиска:'))
            ->getForm();
        $videos = '';
        if ($request->isMethod('POST')) {
            $form->bind($request);

            if ($form->isValid()) {
                $postDate = $form->getData();

                $DEVELOPER_KEY = 'AIzaSyDUp-H7UwES0r4vXQojB-9xLlR4b8mbndA';

                $client = new Google_Client();
                $client->setDeveloperKey($DEVELOPER_KEY);

                $youtube = new Google_YouTubeService($client);
                $searchResponse = $youtube->search->listSearch('id,snippet', array(
                    'q' => $postDate['search'],
                    'maxResults' => 10,
                ));

                $videos = '';

                foreach ($searchResponse['items'] as $searchResult) {
                    switch ($searchResult['id']['kind']) {
                        case 'youtube#video':
                            $videos .= sprintf('<li><a target="_blank" href="http://youtube.com/watch?v=' .'%s' .'">%s</a></li>', $searchResult['id']['videoId'],$searchResult['snippet']['title']
                                );
                            break;
                    }
                }

            }
        }

        return array(
            'name' => 'sads',
            'form' => $form->createView(),
            'videos' => $videos,
        );
    }

}
