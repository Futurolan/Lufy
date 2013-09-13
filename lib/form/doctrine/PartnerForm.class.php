<?php

/**
 * Partner form.
 *
 * @package    lufy
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PartnerForm extends BasePartnerForm
{
	public function configure()
	{
		unset($this['position']);
		$this->widgetSchema['status'] = new sfWidgetFormChoice(array('choices' => array('Cach&eacute;', 'Visible')));

		/*
		 $files = sfFinder::type('file')->maxdepth(0)->name('*.jpg')->relative()->in(sfConfig::get('sf_upload_dir').'/partenaires/100');
		 $logo[0] = '';
		 foreach($files as $file)
		 {
		 $logo[$file] = $file;
		 }

		 $this->widgetSchema['logourl'] = new sfWidgetFormChoice(array('choices' => $logo));

		 */
		
		$this->widgetSchema['logourl'] = new sfWidgetFormInputFileEditable(
			array(
				'file_src'     => Partner::getLogoPath('200'). $this->getObject()->getLogourl(),
				'is_image'     => true,
				'edit_mode'    => is_file (Partner::getLogoDir(200).$this->getObject()->getLogourl()),
				'delete_label' => "supprimer le logo existant",
				'template'     => '%input%<br/>%delete% %delete_label%<br/>%file%' ),
			array()
		);	
				
		$this->validatorSchema['logourl_delete']= new sfValidatorPass();
		$this->validatorSchema['logourl'] = new sfValidatorFile(	array(
													'required' =>  false, 
													'path' =>  Partner::getLogoDir('temp'), 
													'mime_types' => array('image/jpeg', 'image/pjpeg'), 
		)
		);

	}
}
