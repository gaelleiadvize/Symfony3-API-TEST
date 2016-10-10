<?php
/**
 * Created by PhpStorm.
 * User: gacas
 * Date: 10/10/2016
 * Time: 23:57
 */

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Users
 * @ORM\Entity
 * @ORM\Table(name="genus")
 *
 * @package AppBundle\Entity
 */
class Users
{
    /**
     * @var int
     * @ORM\Column(name="`id`", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=30, nullable=false)
     */
    private $name = '';

    /**
     * Get property id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get property name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }


}