<?php
/**
 * Created by PhpStorm.
 * User: gacas
 * Date: 10/10/2016
 * Time: 22:47
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Users;
use Monolog\Logger;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class GenusController extends Controller
{

    /**
     * @Route("/genus/{genusName}")
     */
    public function showAction($genusName)
    {

        return $this->render(
            'genus/show.html.twig',
            [
                'name' => $genusName
            ]
        );

    }

    /**
     * @Route("genus/{genusName}/notes")
     * @Method("GET")
     */
    public function getNotesAction($genusName)
    {
        $notes = [
            ['id'        => 1,
             'username'  => 'AquaPelham',
             'avatarUri' => '/images/leanna.jpeg',
             'note'      => 'Octopus asked me a riddle, outsmarted me',
             'date'      => 'Dec. 10, 2015'
            ],
            ['id'        => 2,
             'username'  => 'AquaWeaver',
             'avatarUri' => '/images/ryan.jpeg',
             'note'      => 'I counted 8 legs... as they wrapped around me',
             'date'      => 'Dec. 1, 2015'
            ],
            ['id'        => 3,
             'username'  => 'AquaPelham',
             'avatarUri' => '/images/leanna.jpeg',
             'note'      => 'Inked!',
             'date'      => 'Aug. 20, 2015'
            ],
        ];
        $data  = [
            'notes' => $notes,
        ];

        return new JsonResponse($data);
    }

    /**
     * @Route("/users/{userId}", name="get_user")
     * @Method("GET")
     * @param int $userId
     * @ApiDoc(
     *     section="Users",
     *     description="Get user.",
     *     requirements={
     *          {
     *              "name"="userId",
     *              "dataType"="integer",
     *              "requirement"="\d+",
     *              "description"="The user unique identifier."
     *          }
     *      },
     * )
     *
     * @return JsonResponse
     */
    public function getUsers($userId)
    {

        $serializer = $this->get('nil_portugues.serializer.json_api_serializer');
        /** @var Logger $logger */
        $logger = $this->get('logger');

        $user = $this->getDoctrine()
                     ->getRepository(Users::class)
                     ->find($userId);

        /** @var \NilPortugues\Api\JsonApi\JsonApiTransformer $transformer */
        $transformer = $serializer->getTransformer();

        $transformer->setSelfUrl($this->generateUrl('get_user', ['userId' => $userId], true));

        $data = $serializer->serialize($user);

        return new Response($data);
    }
}
