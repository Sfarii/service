<?php

namespace ServiceBundle\Datatables\UserCV;

use Sg\DatatablesBundle\Datatable\AbstractDatatable;
use Sg\DatatablesBundle\Datatable\Style;
use Sg\DatatablesBundle\Datatable\Column\Column;
use Sg\DatatablesBundle\Datatable\Column\BooleanColumn;
use Sg\DatatablesBundle\Datatable\Column\ActionColumn;
use Sg\DatatablesBundle\Datatable\Column\MultiselectColumn;
use Sg\DatatablesBundle\Datatable\Column\VirtualColumn;
use Sg\DatatablesBundle\Datatable\Column\DateTimeColumn;
use Sg\DatatablesBundle\Datatable\Column\ImageColumn;
use Sg\DatatablesBundle\Datatable\Filter\TextFilter;
use Sg\DatatablesBundle\Datatable\Filter\NumberFilter;
use Sg\DatatablesBundle\Datatable\Filter\SelectFilter;
use Sg\DatatablesBundle\Datatable\Filter\DateRangeFilter;
use Sg\DatatablesBundle\Datatable\Editable\CombodateEditable;
use Sg\DatatablesBundle\Datatable\Editable\SelectEditable;
use Sg\DatatablesBundle\Datatable\Editable\TextareaEditable;
use Sg\DatatablesBundle\Datatable\Editable\TextEditable;

use ServiceBundle\Entity\UserManagment\User as User;

/**
 * Class UserDatatable
 *
 * @package ServiceBundle\Datatables
 */
class UserDatatable extends AbstractDatatable
{
    /**
     * {@inheritdoc}
     */
    public function buildDatatable(array $options = array())
    {
        $this->language->set(array(
            'cdn_language_by_locale' => true
            //'language' => 'de'
        ));

        $this->ajax->set(array(
          // dont put any route here
        ));

        $this->callbacks->set(array(
            'row_callback' => array(
                'template' => 'datatables/callback.js.twig',
            ),
            'init_complete' => array(
                'template' => 'datatables/init.js.twig',
            )
        ));

        $this->options->set(array(
            'dom' => "<'dt-uikit-header'<'uk-grid'<'uk-width-medium-2-3'l><'uk-width-medium-1-3'f>>><'uk-overflow-container'tr><'dt-uikit-footer'<'uk-grid'<'uk-width-medium-3-10'i><'uk-width-medium-7-10'p>>>",
            'length_menu' => array(10, 25, 50, 100),
            'order_classes' => true,
            'order' => array(array(1, 'asc')),
            'order_multi' => true,
            'page_length' => 10,
            'paging_type' => Style::FULL_NUMBERS_PAGINATION,
            'renderer' =>  'uikit',
            'scroll_collapse' => false,
            'search_delay' => 0,
            'state_duration' => 7200,
            'classes' => "uk-table uk-table-nowrap table_check",
            'individual_filtering' => false,
            'individual_filtering_position' => 'head',
        ));

        $this->columnBuilder
              ->add(null, MultiselectColumn::class, array(
                'class_name' => 'uk-table-middle',
                'actions' => array(
                    array(
                        'route' => 'user_bulk_activate_deactivate',
                        'route_parameters' => array(
                            'isActive' => 1
                        ),
                        'icon' => 'uk-icon-check',
                        'label' => $this->translator->trans('action.activate'),
                        'attributes' => array(
                            'rel' => 'tooltip',
                            'title' => 'Delete',
                            'class' => 'sg-datatables-user_datatable-multiselect-action md-btn md-btn-success md-btn-wave-light md-btn-icon waves-effect waves-button waves-light',
                            'role' => 'button'
                        ),
                    ),
                    array(
                        'route' => 'user_bulk_activate_deactivate',
                        'route_parameters' => array(
                            'isActive' => 0
                        ),
                        'icon' => 'uk-icon-close',
                        'label' => $this->translator->trans('action.deactivate'),
                        'attributes' => array(
                            'rel' => 'tooltip',
                            'title' => 'Delete',
                            'class' => 'sg-datatables-user_datatable-multiselect-action md-btn md-btn-danger md-btn-wave-light md-btn-icon waves-effect waves-button waves-light',
                            'role' => 'button'
                        ),
                    ),
                )
              ))
            ->add('username', Column::class, array(
                'title' => $this->translator->trans('user.field.username'),
                'class_name' => 'uk-table-middle',
                ))
            ->add('email', Column::class, array(
                'title' => $this->translator->trans('user.field.email'),
                'class_name' => 'uk-table-middle',
                ))
            ->add('enabled', BooleanColumn::class, array(
                'class_name' => 'uk-table-middle',
                'title' => $this->translator->trans('user.field.enabled'),
                'true_icon' => 'uk-icon-check',
                'false_icon' => 'uk-icon-close',
                'true_label' => $this->translator->trans('user.enabled.active'),
                'false_label' => $this->translator->trans('user.enabled.not_active')
            ))
            ->add(null, ActionColumn::class, array(
                'title' => $this->translator->trans('sg.datatables.actions.title'),
                'actions' => array(
                    array(
                        'route' => 'user_show',
                        'route_parameters' => array(
                            'username' => 'username'
                        ),
                        'icon' => '&#xE417;',
                        'attributes' => array(
                            'rel' => 'tooltip',
                            'title' => $this->translator->trans('sg.datatables.actions.show'),
                            'class' => 'btn btn-primary btn-xs',
                            'role' => 'button'
                        ),
                    )
                )
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getEntity()
    {
        return User::class;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'user_datatable';
    }
}
