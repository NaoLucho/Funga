<?php

namespace AppBundle\Entity\Planification;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * TaskCategory
 *
 * @ORM\Table(name="planification_task_category")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Planification\TaskCategoryRepository")
 */
class TaskCategory
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="category", type="string", length=255, unique=true)
     */
    private $category;

    /**
    * @ORM\OneToMany(targetEntity="Task", mappedBy="taskCategory")
    */
    private $tasks;

    public function __construct()
    {
        $this->tasks = new ArrayCollection();
    }


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set category
     *
     * @param string $category
     *
     * @return TaskCategory
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }


    public function getTasks()
    {
        return $this->tasks;
    }
}

