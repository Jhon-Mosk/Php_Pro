<?php

namespace app\models\repositories;

use app\models\entities\Feedback;
use app\models\Repository;

class FeedbackRepository extends Repository
{
    public function getTableName()
    {
        return 'feedbacks';
    }

    protected function getEntityClass()
    {
        return Feedback::class;
    }
}
