<?php
/**
 * Created by PhpStorm.
 * User: jdubec
 * Date: 19/04/16
 * Time: 13:35
 */

namespace TravelDiary\InterfaceBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class TripType extends AbstractType
{

	public function buildForm(FormBuilderInterface $builder, array $options) {

		$builder
			->add("id", HiddenType::class, [
				'label' 		=> 'ID',
			])
			->add("name", TextType::class, [
				'label' 		=> 'Name'
			])
			->add("destination", TextType::class, [
				'label' 		=> 'Destination'
			])
			->add("description", TextareaType::class, [
				'label' 		=> "Description"
			])
			->add("start_date", DateType::class, [
				'label' 		=> "Estimated start date"
			])
			->add("estimated_arrival_date", DateType::class, [
				'label' 		=> "Estimated arrival date"
			])
			->add("privacy", ChoiceType::class, [
				"choices" 		=> $options['privacy_fields'],
				"choice_label" 	=> "description",
				'label' 		=> "Privacy"
			])
			->add("status", ChoiceType::class, [
				"choices" 		=> $options['statuses'],
				"choice_label" 	=> "description",
				'label' 		=> "Status"
			])
			->add("users", ChoiceType::class, [
				"choices" 		=> $options['users'],
				"choice_label" 	=> "email",
				"label" 		=> "Users"
			])
		;

	}

}