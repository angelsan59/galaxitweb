<?php

namespace San\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class SanUserBundle extends Bundle
{
    public function getParent()
  {
    return 'FOSUserBundle';
  }
}
