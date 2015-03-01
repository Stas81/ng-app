<?php
namespace Nog\AppBundle\Utils;

class ProjectStatus 
{
    const PROJECT_CREATED = 0;
    const PROJECT_ONREWIEV = 1;
    const PROJECT_ACCEPTED = 2;
    const PROJECT_DECLINED = 3;
    
    public static $statusNames = [
        0 => 'New',
        1 => 'On review',
        2 => 'Accepted',
        3 => 'Declined',
    ];
}
