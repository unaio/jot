<?php defined('BX_DOL') or die('hack attempt');
/**
 * Copyright (c) UNA, Inc - https://una.io
 * MIT License - https://opensource.org/licenses/MIT
 *
 * @defgroup	Messenger Messenger
 * @ingroup		UnaModules
 *
 * @{
 */

/**
 * View block menu.
 */
class BxMessengerMainMenu extends BxTemplMenu
{
    private $_oModule = null;
    private $_aMenuStat = null;
    public function __construct ($aObject, $oTemplate = false)
    {
        parent::__construct ($aObject, $oTemplate);
        $this->MODULE = 'bx_messenger';
        $this->_oModule = BxDolModule::getInstance($this->MODULE);
        $this->_oTemplate = &$this->_oModule->_oTemplate;
        $this->_aMenuStat = $this->_oModule->_oDb->getUnreadMessagesStat(bx_get_logged_profile_id());
    }

    protected function _getMenuItem ($a){
        $aMenuItem = parent::_getMenuItem($a);
        $iAddon = isset($this->_aMenuStat[$aMenuItem['name']]) && is_array($this->_aMenuStat[$aMenuItem['name']])? count($this->_aMenuStat[$aMenuItem['name']]) : 0;

        $aMenuItem['bx_if:addon'] = array (
            'condition' => true,
            'content' => array(
                'addon' => $iAddon,
                'type' => $aMenuItem['name'],
                'hidden' => !$iAddon ? 'hidden' : ''
            )
        );

        return $aMenuItem;
    }
}

/** @} */
