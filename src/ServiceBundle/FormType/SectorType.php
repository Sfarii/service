<?php

namespace ServiceBundle\FormType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class SectorType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
          'choices' => array(
              'sector.consumer_industrial_products' => array(
                  'sector.aviation_transportation' => 'aviation_transportation',
                  'sector.chemicals_and_speciality_materials' => 'chemicals_and_speciality_materials',
                  'sector.consumer_business' => 'consumer_business',
                  'sector.consumer_products'  => 'consumer_products',
                  'sector.hotels' => 'hotels',
                  'sector.gaming' => 'gaming',
                  'sector.sports' => 'sports',
                  'sector.restaurants_food_service' => 'restaurants_food_service',
                  'sector.retail_wholesale_and_distribution'  => 'retail_wholesale_and_distribution',
                  'sector.travel_hospitality_and_services'  => 'travel_hospitality_and_services'
              ),
              'sector.energy_resources' => array(
                  'sector.mining' => 'mining',
                  'sector.oil_gas' => 'oil_gas',
                  'sector.power' => 'power',
                  'sector.shipping_ports' => 'shipping_ports',
                  'sector.water'  => 'water'
              ),
              'sector.financial_services' => array(
                  'sector.banking_securities' => 'banking_securities',
                  'sector.insurance' => 'insurance',
                  'sector.investment_management' => 'investment_management',
                  'sector.center_for_financial_services' => 'center_for_financial_services'
              ),
              'sector.life_sciences_health_care' => array(
                  'sector.health_care_providers' => 'health_care_providers',
                  'sector.life_sciences' => 'life_sciences',
                  'sector.health_plans' => 'health_plans',
                  'sector.center_for_health_solutions' => 'center_for_health_solutions'
              ),
              'sector.manufacturing' => array(
                  'sector.industrial_products_and_services' => 'industrial_products_and_services',
                  'sector.automotive' => 'automotive',
                  'sector.aerospace_defense' => 'aerospace_defense',
                  'sector.chemicals_specialty_materials' => 'chemicals_specialty_materials'
              ),
              'sector.private_public_sector' => array(
                  'sector.civil_government' => 'civil_government',
                  'sector.defense' => 'defense',
                  'sector.education' => 'education',
                  'sector.higher_education' => 'higher_education',
                  'sector.international_donor_organizations' => 'international_donor_organizations',
                  'sector.public_health_and_social_services' => 'public_health_and_social_services',
                  'sector.public_transportation' => 'public_transportation',
                  'sector.security_and_justice' => 'security_and_justice'
              ),
              'sector.real_estate' => array(
                  'sector.sector.engineering_and_construction_industry' => 'engineering_and_construction_industry',
                  'sector.real_estate_fund_and_investor' => 'real_estate_fund_and_investor',
                  'sector.REIT_and_property_company' => 'REIT_and_property_company',
                  'sector.real_estate_Management_Brokerage_and_service_provider' => 'real_estate_Management_Brokerage_and_service_provider',
                  'sector.tenants_and_occupiers' => 'tenants_and_occupiers'
              ),
              'sector.technology_media_telecommunications' => array(
                  'sector.technology' => 'technology',
                  'sector.media_entertainment' => 'media_entertainment',
                  'sector.telecommunications' => 'telecommunications'
              ),
            ),
          'choice_translation_domain' => false
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return ChoiceType::class;
    }
}
