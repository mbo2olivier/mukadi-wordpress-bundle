<?php
/*
 * This file is part of the Ekino Wordpress package.
 *
 * (c) 2013 Ekino
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mukadi\WordpressBundle\Controller;

use Mukadi\WordpressBundle\Wordpress\Wordpress;

/**
 * Class WordpressController.
 *
 * This is the controller to render Wordpress content
 *
 * @author Vincent Composieux <composieux@ekino.com>
 * @author Olivier M. Mukadi <mbo2olivier@gmail.com>
 */
class WordpressController
{
    /**
     * Wordpress init route action.
     * @param \Mukadi\WordpressBundle\Wordpress\Wordpress $wp
     * @return \Mukadi\WordpressBundle\Wordpress\WordpressResponse
     */
    public function wpAction(Wordpress $wp)
    {
        return $wp->initialize()->getResponse();
    }

}
