<?php


namespace Sassy\Helper;

use Leafo\ScssPhp\Compiler;
use Zend\View\Helper\HeadStyle;
use Zend\View\Helper\Placeholder\Container\AbstractContainer;

/**
 * Helper for setting and retrieving stylesheets
 *
 * Allows the following method calls:
 * @method HeadStyle appendStyle($content, $attributes = array())
 * @method HeadStyle offsetSetStyle($index, $content, $attributes = array())
 * @method HeadStyle prependStyle($content, $attributes = array())
 * @method HeadStyle setStyle($content, $attributes = array())
 */
class HeadSass extends HeadStyle
{
    /**
     * Registry key for placeholder
     *
     * @var string
     */
//    protected $regKey = 'Zend_View_Helper_HeadSass';
    
    /**
     *
     * @var Leafo\sessPhp\Compiler
     */
    protected $compiler = null;

    /**
     * Constructor
     *
     * Set separator to PHP_EOL.
     */
    public function __construct()
    {
        parent::__construct();

        $this->setSeparator(PHP_EOL);
    }
    
    /**
     * End capture action and store
     *
     * @return void
     */
    public function captureEnd()
    {
        $content             = ob_get_clean();
        $attrs               = $this->captureAttrs;
        $this->captureAttrs = null;
        $this->captureLock  = false;

        switch ($this->captureType) {
            case AbstractContainer::SET:
                $this->setStyle($this->getSass()->compile($content), $attrs);
                break;
            case AbstractContainer::PREPEND:
                $this->prependStyle($this->getSass()->compile($content), $attrs);
                break;
            case AbstractContainer::APPEND:
            default:
                $this->appendStyle($this->getSass()->compile($content), $attrs);
                break;
        }
    }
    
    private function getSass() {
        if (!$this->compiler) {
            $this->compiler = new Compiler();
        }
        
        return $this->compiler;
    }
}
