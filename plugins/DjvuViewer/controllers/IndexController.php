<?php
/**
 * @version $Id$
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 * @copyright Gjergj Sheldija, 2013
 * @package Contribution
 */

/**
 * Controller for djvu viewer plugin
 */
class DjVuViewer_IndexController extends Omeka_Controller_Action {

    public function init()
    {
        $this->_modelClass = 'File';
    }

	public function showAction() {
		$this->view->filename = $this->getRequest()->getParam('filename');
		//echo $this->getRequest()->getParam('archive_filename');
	}

}
