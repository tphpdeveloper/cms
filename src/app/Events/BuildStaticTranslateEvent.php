<?php
/**
 * @author    Igor <igorkutsan@ukr.net>
 * @copyright 2018
 * @license   https://opensource.org/licenses/MIT
 */

namespace Tphpdeveloper\Cms\Events;

use Illuminate\Queue\SerializesModels;

class BuildStaticTranslateEvent
{

    use SerializesModels;

    public $order;

    /**
     * Create a new event instance.
     *
     * @param  \App\Order  $order
     * @return void
     */
//    public function __construct(Order $order)
//    {
//        $this->order = $order;
//    }
}
