<?php

// src/AppBundle/Admin/Planification/TaskAdmin.php
namespace AppBundle\Admin\Planification;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper; //pour configureDatagridFilters

class TaskAdmin extends AbstractAdmin
{
    //Structure des blocks et définition des champs pour la création, l'affichage de l'element et son édition.
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Content', array('class' => 'col-md-9'))
                ->add('title', 'text')
                ->add('body', 'textarea')
            ->end()
            ->with('TaskCategory', array('class' => 'col-md-9'))
                ->add('taskCategory', 'entity', array(
                    'class' => 'AppBundle\Entity\Planification\TaskCategory',
                    'choice_label' => 'category',
                ))
                ->add('color', 'sonata_type_color_selector')
            ->end()
            ->with('Owner', array('class' => 'col-md-9'))
                ->add('assignedTo')
            ->end()
            ->with('Metadata', array('class' => 'col-md-9'))
                ->add('toDo')
                ->add('createdAt', 'sonata_type_date_picker')
                ->add('done')
                ->add('doneAt', 'sonata_type_date_picker')
                // or sonata_type_date_picker if you need the time
                // ->add('createdAt', 'sonata_type_datetime_picker')
            ->end()
        ;
    }

    //Données définies pour l'affichage de la liste des éléments
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title')
            ->add('taskCategory.category')
            ->add('color')
            ->add('assignedTo')
            ->add('createdAt')
            ->add('toDo')
            ->add('done')
            ->add('doneAt')
        ;
    }

    //Ajout de filtre dans l'affichage de la liste des éléments
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('title')
            ->add('taskCategory', null, array(), 'entity', array(
                'class'    => 'AppBundle\Entity\Planification\TaskCategory',
                'choice_label' => 'category', // In Symfony2: 'property' => 'name'
            ));
    }

    // Pour information, la fonction add utilisé dans l'admin reçoit 5 arguments:
    // public function add(
    //     $name,

    //     // filter
    //     $type = null,
    //     array $filterOptions = array(),

    //     // field
    //     $fieldType = null,
    //     $fieldOptions = null
    // )

    //Override du message de création par un texte souhaité (plus lisible: Item "Blog Post" has been successfully created.)
    public function toString($object)
    {
        return $object instanceof BlogPost
            ? $object->getTitle()
            : 'Task'; // shown in the breadcrumb on the create view
    }


}
