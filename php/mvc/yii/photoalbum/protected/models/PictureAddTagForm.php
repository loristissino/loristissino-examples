<?php

class PictureAddTagForm extends CFormModel
{
	public $picture_id;
	public $tag;

	public function rules()
	{
		return array(
			array('picture_id, tag', 'required'),
		);
	}
}
