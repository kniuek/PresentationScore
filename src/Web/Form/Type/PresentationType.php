<?php
namespace Web\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionResolver\OptionResolverInterface;

class PresentationType extends AbstractType
{

	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('title', 'text')
			->add('description', 'text')
			->add('file', 'file'
                                //, array(
                            //"attr" => array("multiple" => "multiple"))
                        )
		;
	}

	public function getName()
	{
		return "kni_presentation";
	}
}